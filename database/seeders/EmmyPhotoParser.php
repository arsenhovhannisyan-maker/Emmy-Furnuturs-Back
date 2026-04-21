<?php

namespace Database\Seeders;

use Illuminate\Support\Str;

class EmmyPhotoParser
{
    /**
     * Parse "Text Document.txt" content from Emmy photo product folder.
     * Returns ['name' => string, 'sku' => string, 'description' => string, 'sizes' => [['size' => string, 'price' => float], ...]]
     */
    public static function parse(string $content, string $folderName): array
    {
        $lines = preg_split('/\r\n|\r|\n/', $content);
        $name = trim($lines[0] ?? $folderName);
        $sku = 'нет';
        $descriptionParts = [];
        $sizes = [];
        $inSizeBlock = false;

        for ($i = 1; $i < count($lines); $i++) {
            $line = $lines[$i];
            $trimmed = trim($line);

            // Артикул: XXX
            if (preg_match('/^Артикул:\s*(.+)$/ui', $trimmed, $m)) {
                $sku = trim($m[1]);
                continue;
            }

            // Headers that start size block
            if (preg_match('/^Размер|^Размер изделия/ui', $trimmed)) {
                $inSizeBlock = true;
                continue;
            }

            // Находим строку "размер + цена" в блоке размеров.
            $sizeRow = self::extractSizePrice($trimmed);
            if ($inSizeBlock && $sizeRow !== null) {
                $sizes[] = $sizeRow;
                continue;
            }

            // Встречаются карточки, где блока "Размер" нет — но строки размера/цены есть.
            if (!$inSizeBlock && $sizeRow !== null) {
                $sizes[] = $sizeRow;
                continue;
            }

            // End size block only when we hit non-empty line that is NOT a size/price line (start of description)
            if ($inSizeBlock && $trimmed !== '' && $sizeRow === null) {
                $inSizeBlock = false;
            }

            // Non-empty line that is not size/price -> description (including text before and after size block)
            if ($trimmed !== ''
                && !preg_match('/^Артикул:/ui', $trimmed)
                && !preg_match('/^Размер|^Размер изделия/ui', $trimmed)
                && !preg_match('/^\d+$/u', $trimmed)
            ) {
                $isSizePriceLine = $sizeRow !== null;
                if (!$inSizeBlock || !$isSizePriceLine) {
                    $descriptionParts[] = $trimmed;
                }
            }
        }

        if ($name === '') {
            $name = $folderName;
        }

        $description = implode("\n\n", array_filter($descriptionParts));
        if ($description === '') {
            $description = $name;
        }

        return [
            'name' => $name,
            'sku' => $sku,
            'description' => $description,
            'sizes' => self::uniqueSizes($sizes),
        ];
    }

    private static function uniqueSizes(array $sizes): array
    {
        $result = [];
        $seen = [];
        foreach ($sizes as $row) {
            if (!is_array($row) || !isset($row['size'], $row['price'])) {
                continue;
            }

            $key = mb_strtolower(trim((string) $row['size'])) . '|' . (string) ((float) $row['price']);
            if (isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;
            $result[] = [
                'size' => (string) $row['size'],
                'price' => (float) $row['price'],
            ];
        }

        return $result;
    }

    private static function extractSizePrice(string $line): ?array
    {
        $line = trim(preg_replace('/\x{00A0}/u', ' ', $line) ?? $line);
        if ($line === '') {
            return null;
        }

        // Пример: "500х800   5800", "В1900ХШ350ХГ320    10 400", "1195*520 5000"
        if (!preg_match('/^(.+?)\s+([\d\s]+(?:[.,]\d{1,2})?)\s*$/u', $line, $m)) {
            return null;
        }

        $size = trim($m[1]);
        $rawPrice = trim($m[2]);
        $normalizedPrice = preg_replace('/[^\d.,]/u', '', $rawPrice) ?? '';
        $normalizedPrice = str_replace(',', '.', $normalizedPrice);

        if ($size === '' || !preg_match('/\d/u', $size)) {
            return null;
        }

        if ($normalizedPrice === '') {
            return null;
        }

        $price = (float) $normalizedPrice;
        if ($price <= 0) {
            return null;
        }

        return [
            'size' => $size,
            'price' => $price,
        ];
    }

    /**
     * Generate unique SKU when source is "нет" or empty.
     */
    public static function resolveSku(string $sku, int $categoryId, int $productIndex): string
    {
        if ($sku !== '' && strtolower($sku) !== 'нет') {
            return Str::limit($sku, 50);
        }
        return 'EM-' . $categoryId . '-' . ($productIndex + 1) . '-' . Str::random(4);
    }
}
