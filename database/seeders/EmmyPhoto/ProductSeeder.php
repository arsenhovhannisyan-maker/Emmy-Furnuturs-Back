<?php

namespace Database\Seeders\EmmyPhoto;

use App\Models\Categorie\Categorie;
use App\Models\Product\Product;
use App\Models\ProductSize\ProductSize;
use Database\Seeders\DemoCatalogSeeder;
use Database\Seeders\EmmyPhotoParser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $basePath = CategorySeeder::resolveBasePath();
        if (!$basePath) {
            $this->command?->info('Источник Emmy Photo не найден — загружается демо-каталог без фотографий.');
            $this->call(DemoCatalogSeeder::class);

            return;
        }

        $categories = Categorie::all()->keyBy('name');
        $usedSkus = [];
        $productIndex = 0;
        $created = 0;

        foreach (File::directories($basePath) as $categoryDir) {
            $categoryName = basename($categoryDir);
            $category = $categories->get($categoryName);
            if (!$category) {
                continue;
            }

            $productDirs = File::directories($categoryDir);
            foreach ($productDirs as $productDir) {
                $folderName = basename($productDir);
                $txtPath = $productDir . DIRECTORY_SEPARATOR . 'Text Document.txt';

                if (!File::exists($txtPath)) {
                    $this->command->warn("Нет Text Document.txt: {$categoryName}/{$folderName}");
                    continue;
                }

                $content = File::get($txtPath);
                $data = EmmyPhotoParser::parse($content, $folderName);

                $sku = EmmyPhotoParser::resolveSku($data['sku'], (int) $category->id, $productIndex);
                $originalSku = $sku;
                $suffix = 0;
                while (isset($usedSkus[$sku])) {
                    $suffix++;
                    $sku = Str::limit($originalSku, 45) . '-' . $suffix;
                }
                $usedSkus[$sku] = true;

                $prices = $data['sizes'];
                $firstPrice = 0.0;
                if ($prices !== []) {
                    $firstPrice = (float) $prices[0]['price'];
                }
                if ($firstPrice <= 0) {
                    $firstPrice = 1.0;
                }

                $product = Product::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $firstPrice,
                    'category_id' => $category->id,
                    'quantity' => 0,
                    'SKU' => $sku,
                    'discount' => null,
                ]);

                $imageFiles = self::getImageFilesInFolder($productDir);
                foreach ($data['sizes'] as $row) {
                    $images = self::findImagesForSize($row['size'], $imageFiles);
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $row['size'],
                        'price' => $row['price'],
                        'image' => $images['image'],
                        'image_shema' => $images['image_shema'],
                    ]);
                }

                $created++;
                $productIndex++;
            }
        }

        $this->command->info("Создано продуктов: {$created}");
    }

    /**
     * Список изображений в папке продукта (jpg, jpeg, png).
     */
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
