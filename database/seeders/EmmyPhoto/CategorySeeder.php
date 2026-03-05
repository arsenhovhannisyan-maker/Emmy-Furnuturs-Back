<?php

namespace Database\Seeders\EmmyPhoto;

use App\Models\Categorie\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $basePath = base_path('Emmy photo');
        if (!File::isDirectory($basePath)) {
            $this->command->warn('Папка "Emmy photo" не найдена в корне проекта. Пропуск CategorySeeder.');
            return;
        }

        $directories = File::directories($basePath);
        $created = 0;

        foreach ($directories as $dir) {
            $name = basename($dir);
            if ($name === '' || in_array($name, ['.', '..'], true)) {
                continue;
            }
            Categorie::firstOrCreate(
                ['name' => $name],
                ['description' => 'Категория: ' . $name]
            );
            $created++;
        }

        $this->command->info('Категории из "Emmy photo": ' . count($directories) . ' обработано.');
    }
}
