<?php

namespace Database\Seeders\EmmyPhoto;

use App\Models\Categorie\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public static function resolveBasePath(): ?string
    {
        $configured = env('EMMY_PHOTO_PATH');
        $candidates = [
            $configured,
            'Emmy photo',
            'Emmy_photo',
            'storage/app/Emmy photo',
            'storage/app/Emmy_photo',
        ];

        foreach ($candidates as $candidate) {
            if (!$candidate || trim((string) $candidate) === '') {
                continue;
            }

            $candidate = trim((string) $candidate);
            $isAbsolute = str_starts_with($candidate, DIRECTORY_SEPARATOR)
                || preg_match('/^[A-Za-z]:\\\\/', $candidate) === 1;
            $path = $isAbsolute ? $candidate : base_path($candidate);

            if (File::isDirectory($path)) {
                return $path;
            }
        }

        return null;
    }

    public function run(): void
    {
        $basePath = self::resolveBasePath();
        if (!$basePath) {
            $this->command?->line('Источник Emmy Photo не найден. CategorySeeder пропущен.');
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

        $this->command->info('Категории из Emmy Photo: ' . count($directories) . ' обработано.');
    }
}
