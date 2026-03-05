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
        $sizeHeaderSeen = false;

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
                $sizeHeaderSeen = true;
                continue;
            }

            // Line ending with price (digits): "500х800    5800" or "760х600х160    5500"
            if ($inSizeBlock && preg_match('/^(.+?)\s+(\d+)\s*$/u', $trimmed, $m)) {
                $sizePart = trim($m[1]);
                $price = (float) $m[2];
                if ($sizePart !== '' && $price > 0) {
                    $sizes[] = ['size' => $sizePart, 'price' => $price];
                }
                continue;
            }

            // End size block only when we hit non-empty line that is NOT a size/price line (start of description)
            if ($inSizeBlock && $trimmed !== '' && !preg_match('/^(.+?)\s+(\d+)\s*$/u', $trimmed)) {
                $inSizeBlock = false;
            }

            // Non-empty line that is not size/price -> description (including text before and after size block)
            if ($trimmed !== ''
                && !preg_match('/^Артикул:/ui', $trimmed)
                && !preg_match('/^Размер|^Размер изделия/ui', $trimmed)
                && !preg_match('/^\d+$/u', $trimmed)
            ) {
                $isSizePriceLine = (bool) preg_match('/^(.+?)\s+(\d+)\s*$/u', $trimmed);
                if (!$inSizeBlock || !$isSizePriceLine) {
                    $descriptionParts[] = $trimmed;
                }
            }
        }

        $description = implode("\n\n", array_filter($descriptionParts));
        if ($description === '') {
            $description = $name;
        }

        return [
            'name' => $name,
            'sku' => $sku,
            'description' => $description,
            'sizes' => $sizes,
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
