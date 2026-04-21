<?php

namespace Database\Seeders\EmmyPhoto;

use App\Models\Categorie\Categorie;
use App\Models\Product\Product;
use App\Models\ProductSize\ProductSize;
use Database\Seeders\EmmyPhotoParser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public static function getJsonPath(): string
    {
        return database_path('seeders/EmmyPhoto/products.json');
    }

    public function run(): void
    {
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

        foreach ($products as $item) {
            $categoryName = trim((string) ($item['category'] ?? ''));
            $name = trim((string) ($item['name'] ?? ''));
            $description = trim((string) ($item['description'] ?? ''));
            $sizes = self::normalizeSizeRows($item['sizes'] ?? []);

            if ($categoryName === '' || $name === '' || $sizes === []) {
                continue;
            }

            $category = Categorie::firstOrCreate(
                ['name' => $categoryName],
                ['description' => 'Категория: ' . $categoryName]
            );

            $baseSku = self::buildSkuFromName($name);
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
                    'category_id' => $category->id,
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
                    // Для пустых/нестандартных TXT не теряем товар полностью.
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

    /**
     * Из размера "500х800" извлекаем числа для поиска в имени файла (50, 500, 80, 800 — см и мм).
     */
    private static function getSizeKeys(string $size): array
    {
        if (preg_match_all('/\d+/u', $size, $m)) {
            $nums = array_map('intval', $m[0]);
            $keys = [];
            foreach ($nums as $n) {
                $keys[] = (string) $n;
                if ($n >= 10) {
                    $keys[] = (string) (int) ($n / 10); // 500 -> 50
                }
            }
            return array_unique($keys);
        }
        return [];
    }

    /**
     * Подбираем фото для размера: основное (avrora_60.jpg) и схема (avrora_60_shema.jpg).
     * Например: 500х800 -> image=avrora_50_shema.jpg (если нет без shema), image_shema=avrora_50_shema.jpg
     *            600х800 -> image=avrora_60.jpg, image_shema=avrora_60_shema.jpg
     */
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
}
