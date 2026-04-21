<?php

namespace Database\Seeders\EmmyPhoto;

use App\Models\Categorie\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public static function getJsonPath(): string
    {
        return database_path('seeders/EmmyPhoto/categories.json');
    }

    public static function resolveBasePath(): ?string
    {
        $configured = env('EMMY_PHOTO_PATH');
        $userProfile = getenv('USERPROFILE') ?: null;
        $home = getenv('HOME') ?: null;
        $downloadCandidates = [];

        if ($userProfile) {
            $downloadCandidates[] = $userProfile . DIRECTORY_SEPARATOR . 'Downloads' . DIRECTORY_SEPARATOR . 'Emmy photo';
            $downloadCandidates[] = $userProfile . DIRECTORY_SEPARATOR . 'Downloads' . DIRECTORY_SEPARATOR . 'Emmy_photo';
        }

        if ($home) {
            $downloadCandidates[] = $home . DIRECTORY_SEPARATOR . 'Downloads' . DIRECTORY_SEPARATOR . 'Emmy photo';
            $downloadCandidates[] = $home . DIRECTORY_SEPARATOR . 'Downloads' . DIRECTORY_SEPARATOR . 'Emmy_photo';
        }

        $candidates = [
            $configured,
            'Emmy photo',
            'Emmy_photo',
            'storage/app/Emmy photo',
            'storage/app/Emmy_photo',
            ...$downloadCandidates,
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

    private static function loadCategoryNamesFromJson(): array
    {
        $jsonPath = self::getJsonPath();
        if (!File::exists($jsonPath)) {
            return [];
        }

        $raw = File::get($jsonPath);
        $decoded = json_decode($raw, true);
        if (!is_array($decoded)) {
            return [];
        }

        $names = [];
        foreach ($decoded as $item) {
            if (!is_string($item)) {
                continue;
            }

            $name = trim($item);
            if ($name !== '') {
                $names[] = $name;
            }
        }

        return array_values(array_unique($names));
    }

    private static function saveCategoryNamesToJson(array $names): void
    {
        $jsonPath = self::getJsonPath();
        $dir = dirname($jsonPath);
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        File::put(
            $jsonPath,
            json_encode(array_values($names), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }

    private static function loadCategoryNamesFromDirectory(string $basePath): array
    {
        $names = [];
        foreach (File::directories($basePath) as $dir) {
            $name = trim((string) basename($dir));
            if ($name === '' || in_array($name, ['.', '..'], true)) {
                continue;
            }

            $names[] = $name;
        }

        return array_values(array_unique($names));
    }

    public function run(): void
    {
        $categoryNames = self::loadCategoryNamesFromJson();
        $source = 'JSON';

        if ($categoryNames === []) {
            $basePath = self::resolveBasePath();
            if ($basePath) {
                $categoryNames = self::loadCategoryNamesFromDirectory($basePath);
                if ($categoryNames !== []) {
                    self::saveCategoryNamesToJson($categoryNames);
                    $source = 'папки Emmy Photo (сохранено в JSON)';
                }
            }
        }

        if ($categoryNames === []) {
            $this->command?->line('Категории не найдены: нет данных ни в JSON, ни в папке Emmy Photo.');
            return;
        }

        $created = 0;
        foreach ($categoryNames as $name) {
            Categorie::firstOrCreate(
                ['name' => $name],
                ['description' => 'Категория: ' . $name]
            );
            $created++;
        }

        $this->command?->info("Категории: {$created} обработано (источник: {$source}).");
    }
}
