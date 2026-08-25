<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use App\Services\File\FileTempService;

class ProductPhotoService
{
    public function __construct(private readonly FileTempService $fileService)
    {
    }

    /**
     * Sync each size's photo gallery against what the admin submitted: delete photos
     * that were removed in the UI, persist the drag-and-drop order for the ones kept,
     * and attach newly uploaded ones after them.
     *
     * @param array<int, array{id?: int|null, existing_photos?: array, new_photos?: array}> $sizesData
     */
    public function sync(Product $product, array $sizesData): void
    {
        foreach ($sizesData as $sizeData) {
            $this->syncGroup(
                product: $product,
                productSizeId: $sizeData['id'] ?? null,
                keepIds: array_values(array_filter($sizeData['existing_photos'] ?? [])),
                newTokens: array_values(array_filter($sizeData['new_photos'] ?? [])),
            );
        }
    }

    /**
     * Delete every photo attached to sizes that no longer exist, both the DB row and
     * the physical file, before the size rows themselves are deleted.
     *
     * @param int[] $sizeIds
     */
    public function deletePhotosForSizes(Product $product, array $sizeIds): void
    {
        if (empty($sizeIds)) {
            return;
        }

        $product->photos()->whereIn('product_size_id', $sizeIds)->get()
            ->each(fn ($file) => $this->fileService->deleteFile($file->id));
    }

    public function deleteAllPhotos(Product $product): void
    {
        $product->photos()->get()->each(fn ($file) => $this->fileService->deleteFile($file->id));
    }

    private function syncGroup(Product $product, ?int $productSizeId, array $keepIds, array $newTokens): void
    {
        $query = $product->photos();
        $productSizeId === null ? $query->whereNull('product_size_id') : $query->where('product_size_id', $productSizeId);
        $current = $query->get()->keyBy('id');

        foreach ($current as $fileId => $file) {
            if (!in_array($fileId, $keepIds, true)) {
                $this->fileService->deleteFile($fileId);
            }
        }

        foreach ($keepIds as $index => $fileId) {
            $file = $current->get($fileId);
            if ($file) {
                $file->update(['sort_order' => $index, 'product_size_id' => $productSizeId]);
            }
        }

        $nextOrder = count($keepIds);
        foreach ($newTokens as $token) {
            if ($this->fileService->createProductPhoto($product, $productSizeId, $nextOrder, $token)) {
                $nextOrder++;
            }
        }
    }
}
