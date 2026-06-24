<?php

namespace Database\Seeders\EmmyPhoto;

use App\Models\Categorie\Categorie;
use App\Models\File\Enums\FileType;
use App\Models\Product\Product;
use App\Models\ProductSize\ProductSize;
use Database\Seeders\EmmyPhotoParser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProductSeeder extends Seeder
{
    public static function getJsonPath(): string
    {
        return database_path('seeders/EmmyPhoto/products.json');
    }

    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $products = self::loadProductsFromJson();
        $source = 'JSON';

        if ($products === []) {
            $basePath = CategorySeeder::resolveBasePath();
            if ($basePath) {
                $products = self::loadProductsFromDirectory($basePath);
                if ($products !== []) {
                    self::saveProductsToJson($products);
                    $source = 'папки Emmy Photo (сохранено в JSON)';
                }
            }
        }

        if ($products === []) {
            $this->command?->line('Продукты не найдены: нет данных ни в JSON, ни в папке Emmy Photo.');
            return;
        }

        $usedSkus = [];
        $created = 0;
        $categoryMap = self::buildCategoryMap();
        $basePath = CategorySeeder::resolveBasePath();

        foreach ($products as $item) {
            $categoryName = trim((string) ($item['category'] ?? ''));
            $rawName = trim((string) ($item['name'] ?? ''));
            $name = self::normalizeProductName($rawName);
            $description = trim((string) ($item['description'] ?? ''));
            $sizes = self::normalizeSizeRows($item['sizes'] ?? []);

            if ($categoryName === '' || $rawName === '' || $name === '' || $sizes === []) {
                continue;
            }

            $categoryId = self::resolveCategoryId($categoryName, $name, $categoryMap);
            if ($categoryId === null) {
                $fallbackCategory = Categorie::firstOrCreate(
                    ['name' => $categoryName],
                    ['description' => 'Категория: ' . $categoryName]
                );
                $categoryId = (int) $fallbackCategory->id;
                $categoryMap[self::normalizeCategoryName($categoryName)] = $categoryId;
            }

            // SKU должен быть стабильным между сидами (по исходному имени),
            // чтобы updateOrCreate обновлял товар, а не создавал дубли.
            $baseSku = self::buildSkuFromName($rawName);
            $sku = $baseSku;
            $suffix = 1;
            while (isset($usedSkus[$sku])) {
                $sku = $baseSku . '_' . $suffix;
                $suffix++;
            }
            $usedSkus[$sku] = true;

            $product = Product::updateOrCreate(
                ['SKU' => $sku],
                [
                    'name' => $name,
                    'description' => $description !== '' ? $description : $name,
                    'price' => (float) $sizes[0]['price'],
                    'category_id' => $categoryId,
                    'quantity' => 1000,
                    'discount' => 0,
                ]
            );

            ProductSize::where('product_id', $product->id)->delete();
            foreach ($sizes as $row) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $row['size'],
                    'price' => $row['price'],
                    'image' => $row['image'] ?? null,
                    'image_shema' => $row['image_shema'] ?? null,
                ]);
            }

            self::seedProductFiles($product, $sizes, $basePath);

            $created++;
        }

        $this->command?->info("Создано продуктов: {$created} (источник: {$source}).");
    }

    private static function loadProductsFromJson(): array
    {
        $path = self::getJsonPath();
        if (!File::exists($path)) {
            return [];
        }

        $decoded = json_decode(File::get($path), true);
        if (!is_array($decoded)) {
            return [];
        }

        $products = [];
        foreach ($decoded as $item) {
            if (!is_array($item)) {
                continue;
            }

            $sizes = self::normalizeSizeRows($item['sizes'] ?? []);
            $name = trim((string) ($item['name'] ?? ''));
            $category = trim((string) ($item['category'] ?? ''));

            if ($name === '' || $category === '' || $sizes === []) {
                continue;
            }

            $products[] = [
                'category' => $category,
                'name' => $name,
                'description' => trim((string) ($item['description'] ?? '')),
                'sizes' => $sizes,
            ];
        }

        return $products;
    }

    private static function saveProductsToJson(array $products): void
    {
        $path = self::getJsonPath();
        $dir = dirname($path);

        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        File::put(
            $path,
            json_encode(array_values($products), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }

    private static function loadProductsFromDirectory(string $basePath): array
    {
        $products = [];

        foreach (File::directories($basePath) as $categoryDir) {
            $categoryName = basename($categoryDir);

            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($categoryDir, \FilesystemIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if (!$file->isFile() || strtolower($file->getFilename()) !== 'text document.txt') {
                    continue;
                }

                $productDir = $file->getPath();
                $folderName = basename($productDir);
                $txtPath = $file->getPathname();
                $content = File::get($txtPath);
                $data = EmmyPhotoParser::parse($content, $folderName);
                $sizes = self::normalizeSizeRows($data['sizes'] ?? []);

                if ($sizes === []) {
                    $sizes = [[
                        'size' => 'Стандарт',
                        'price' => 1.0,
                        'image' => null,
                        'image_shema' => null,
                    ]];
                }

                $images = self::getImageFilesInFolder($productDir);
                foreach ($sizes as &$row) {
                    $match = self::findImagesForSize($row['size'], $images);
                    $row['image'] = $row['image'] ?? $match['image'];
                    $row['image_shema'] = $row['image_shema'] ?? $match['image_shema'];
                }
                unset($row);

                $products[] = [
                    'category' => $categoryName,
                    'name' => $folderName,
                    'description' => trim((string) ($data['description'] ?? '')),
                    'sizes' => $sizes,
                ];
            }
        }

        return $products;
    }

    private static function normalizeSizeRows(array $rows): array
    {
        $normalized = [];
        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $size = trim((string) ($row['size'] ?? ''));
            $price = (float) ($row['price'] ?? 0);
            if ($size === '' || $price <= 0) {
                continue;
            }

            $normalized[] = [
                'size' => $size,
                'price' => $price,
                'image' => isset($row['image']) && is_string($row['image']) ? $row['image'] : null,
                'image_shema' => isset($row['image_shema']) && is_string($row['image_shema']) ? $row['image_shema'] : null,
            ];
        }

        return $normalized;
    }

    private static function buildSkuFromName(string $name): string
    {
        $sku = trim($name);
        $sku = preg_replace('/\s+/u', '_', $sku) ?? '';
        $sku = preg_replace('/[^\pL\pN_]+/u', '_', $sku) ?? '';
        $sku = preg_replace('/_+/u', '_', $sku) ?? '';
        $sku = trim($sku, '_');

        return $sku !== '' ? $sku : 'product';
    }

    private static function getImageFilesInFolder(string $productDir): array
    {
        $files = [];
        if (!File::isDirectory($productDir)) {
            return $files;
        }
        foreach (File::files($productDir) as $file) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
                $files[] = $file->getFilename();
            }
        }
        return $files;
    }

   
    private static function getSizeKeys(string $size): array
    {
        if (preg_match_all('/\d+/u', $size, $m)) {
            $nums = array_map('intval', $m[0]);
            $keys = [];
            foreach ($nums as $n) {
                $keys[] = (string) $n;
                if ($n >= 10) {
                    $keys[] = (string) (int) ($n / 10);
                }
            }
            return array_unique($keys);
        }
        return [];
    }

    private static function findImagesForSize(string $size, array $imageFiles): array
    {
        $result = ['image' => null, 'image_shema' => null];
        $keys = self::getSizeKeys($size);
        if ($keys === []) {
            return $result;
        }
        $withoutShema = [];
        $withShema = [];
        foreach ($imageFiles as $filename) {
            $base = pathinfo($filename, PATHINFO_FILENAME);
            foreach ($keys as $key) {
                if (preg_match('/[_\-\s]' . preg_quote($key, '/') . '([_\-\s]|$)/u', $base) || preg_match('/^' . preg_quote($key, '/') . '([_\-\s]|$)/u', $base)) {
                    if (stripos($base, 'shema') !== false) {
                        $withShema[] = $filename;
                    } else {
                        $withoutShema[] = $filename;
                    }
                    break;
                }
            }
        }
        $result['image_shema'] = $withShema[0] ?? null;
        $result['image'] = $withoutShema[0] ?? $result['image_shema'];
        return $result;
    }

    private static function buildCategoryMap(): array
    {
        $map = [];
        foreach (Categorie::query()->get(['id', 'name']) as $category) {
            $map[self::normalizeCategoryName((string) $category->name)] = (int) $category->id;
        }

        return $map;
    }

    private static function normalizeCategoryName(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $value = preg_replace('/\s+/u', ' ', $value) ?? $value;

        return $value;
    }

    private static function resolveCategoryId(string $categoryName, string $productName, array $categoryMap): ?int
    {
        $normalizedCategoryName = self::normalizeCategoryName($categoryName);
        if (isset($categoryMap[$normalizedCategoryName])) {
            return $categoryMap[$normalizedCategoryName];
        }

        $keywordToCategory = [
            'зеркал' => 'зеркала',
            'mirror' => 'зеркала',
            'зеркальн шкаф' => 'зеркальные шкафы',
            'навесн шкаф' => 'навесные шкафы',
            'пенал' => 'пеналы',
            'тумб' => 'тумбы с раковинами',
            'унитаз' => 'унитазы',
            'экран' => 'экраны',
        ];

        $searchSpace = self::normalizeCategoryName($categoryName . ' ' . $productName);
        foreach ($keywordToCategory as $keyword => $targetCategoryName) {
            if (!str_contains($searchSpace, $keyword)) {
                continue;
            }

            $targetNormalized = self::normalizeCategoryName($targetCategoryName);
            if (isset($categoryMap[$targetNormalized])) {
                return $categoryMap[$targetNormalized];
            }
        }

        return null;
    }

    private static function seedProductFiles(Product $product, array $sizes, ?string $basePath): void
    {
        $uploadsDisk = Storage::disk('uploads');
        $dirPrefix = Product::getClassName();

        // Delete existing File records for this product to avoid duplicates
        $product->files()->delete();

        $photoIndex = 1;

        foreach ($sizes as $sizeRow) {
            $imageFilename = $sizeRow['image'] ?? null;

            if (!$imageFilename || !$basePath) {
                $photoIndex += 6;
                continue;
            }

            // Try to find the image file in the Emmy Photo directory tree
            $sourcePath = self::findImageInBasePath($imageFilename, $basePath);

            if (!$sourcePath || !File::exists($sourcePath)) {
                $photoIndex += 6;
                continue;
            }

            $fieldName = 'photo' . $photoIndex;
            $uniqueFileName = uniqid() . '_' . preg_replace('/[^\w\-.]/', '_', $imageFilename);
            $destRelative = $dirPrefix . '/' . $fieldName . '/' . $uniqueFileName;
            $destAbsolute = $uploadsDisk->path($destRelative);

            $destDir = dirname($destAbsolute);
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir, 0755, true);
            }

            if (File::copy($sourcePath, $destAbsolute)) {
                $product->files()->create([
                    'id'         => Uuid::uuid4()->toString(),
                    'field_name' => $fieldName,
                    'file_name'  => $uniqueFileName,
                    'file_type'  => FileType::IMAGE,
                    'dir_prefix' => $dirPrefix,
                ]);
            }

            $photoIndex += 6; // Each size occupies 6 photo slots (photo1-6, photo7-12, etc.)
        }
    }

    private static function findImageInBasePath(string $filename, string $basePath): ?string
    {
        if (!File::isDirectory($basePath)) {
            return null;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($basePath, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === $filename) {
                return $file->getPathname();
            }
        }

        return null;
    }

    private static function normalizeProductName(string $name): string
    {
        $name = trim($name);
        if ($name === '') {
            return '';
        }

        $name = preg_replace('/\s+/u', ' ', $name) ?? $name;
        $name = preg_replace('/\s*,\s*/u', ', ', $name) ?? $name;
        $name = preg_replace('/\s*\(\s*/u', ' (', $name) ?? $name;
        $name = preg_replace('/\s*\)\s*/u', ') ', $name) ?? $name;
        $name = preg_replace('/\s{2,}/u', ' ', $name) ?? $name;
        $name = trim($name, " \t\n\r\0\x0B,");

        $name = preg_replace('/(?<=[\p{Ll}])(?=[\p{Lu}])/u', ' ', $name) ?? $name;
        $name = preg_replace('/\s{2,}/u', ' ', $name) ?? $name;
        $name = trim($name);

        $maxLength = 60;
        if (mb_strlen($name) > $maxLength) {
            $cut = mb_substr($name, 0, $maxLength); 
            $lastSpacePos = mb_strrpos($cut, ' ');
            if ($lastSpacePos !== false && $lastSpacePos >= 35) {
                $cut = mb_substr($cut, 0, $lastSpacePos);
            }
            $name = rtrim($cut, ",.-/ ") . '...';
        }

        return $name;
    }
}
