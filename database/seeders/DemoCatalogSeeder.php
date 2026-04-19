<?php

namespace Database\Seeders;

use App\Models\Categorie\Categorie;
use App\Models\Product\Product;
use App\Models\ProductSize\ProductSize;
use Illuminate\Database\Seeder;

/**
 * Демо-каталог без папки «Emmy photo» и без файлов изображений.
 * Идемпотентно: повторный запуск обновляет те же SKU.
 */
class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            [
                'category' => [
                    'name' => 'Зеркала',
                    'description' => 'Премиальные зеркала для ванной комнаты',
                ],
                'products' => [
                    [
                        'sku' => 'DEMO-ZRK-001',
                        'name' => 'Зеркало с подсветкой Emmy Line',
                        'description' => 'Премиальное зеркало для ванной. Подсветка, влагостойкое исполнение. Демо-позиция без фото.',
                        'sizes' => [
                            ['size' => '600×800', 'price' => 18900],
                            ['size' => '700×900', 'price' => 22900],
                        ],
                    ],
                    [
                        'sku' => 'DEMO-ZRK-002',
                        'name' => 'Зеркало округлое Emmy Soft',
                        'description' => 'Овальное зеркало в мягком дизайне. Демо-позиция без фото.',
                        'sizes' => [
                            ['size' => '550×750', 'price' => 15900],
                        ],
                    ],
                ],
            ],
            [
                'category' => [
                    'name' => 'Зеркальные шкафы',
                    'description' => 'Шкафы с зеркалом для хранения в ванной',
                ],
                'products' => [
                    [
                        'sku' => 'DEMO-SHK-001',
                        'name' => 'Зеркальный шкаф Emmy Storage 60',
                        'description' => 'Шкаф 60 см, продуманное хранение. Демо-позиция без фото.',
                        'sizes' => [
                            ['size' => '60 см', 'price' => 24900],
                            ['size' => '80 см', 'price' => 28900],
                        ],
                    ],
                    [
                        'sku' => 'DEMO-SHK-002',
                        'name' => 'Зеркальный шкаф Emmy Storage 100',
                        'description' => 'Широкий шкаф для семьи. Демо-позиция без фото.',
                        'sizes' => [
                            ['size' => '100 см', 'price' => 34900],
                        ],
                    ],
                ],
            ],
            [
                'category' => [
                    'name' => 'Тумбы и комплекты',
                    'description' => 'Тумбы и готовые комплекты для ванной',
                ],
                'products' => [
                    [
                        'sku' => 'DEMO-TMB-001',
                        'name' => 'Тумба под раковину Emmy Base 80',
                        'description' => 'Тумба 80 см под раковину. Демо-позиция без фото.',
                        'sizes' => [
                            ['size' => '80×45', 'price' => 31900],
                            ['size' => '100×45', 'price' => 37900],
                        ],
                    ],
                ],
            ],
        ];

        $createdProducts = 0;

        foreach ($catalog as $block) {
            $category = Categorie::firstOrCreate(
                ['name' => $block['category']['name']],
                ['description' => $block['category']['description']]
            );

            foreach ($block['products'] as $row) {
                $firstPrice = (float) ($row['sizes'][0]['price'] ?? 1);
                if ($firstPrice <= 0) {
                    $firstPrice = 1;
                }

                $product = Product::updateOrCreate(
                    ['SKU' => $row['sku']],
                    [
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'price' => $firstPrice,
                        'category_id' => $category->id,
                        'quantity' => 0,
                        'discount' => null,
                    ]
                );

                foreach ($row['sizes'] as $sizeRow) {
                    ProductSize::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'size' => $sizeRow['size'],
                        ],
                        [
                            'price' => (float) $sizeRow['price'],
                            'image' => null,
                            'image_shema' => null,
                        ]
                    );
                }

                $createdProducts++;
            }
        }

        $this->command?->info("Демо-каталог: категорий и товаров обработано (SKU-привязка), позиций товаров: {$createdProducts}. Фото не используются.");
    }
}
