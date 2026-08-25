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
     * that were removed in the UI (or moved to a different size - see below), persist
     * the drag-and-drop order for the ones kept, and attach newly uploaded ones after
     * them.
     *
     * Deletion is decided ONCE up front from the union of every group's existing_photos,
     * not per group: a photo that's absent from its current group's list but present in
     * a DIFFERENT group's list is being moved (dragged to another size), not removed, and
     * must survive. Deciding deletion per group instead would destroy it - the group it's
     * leaving sees it missing from its own keepIds and deletes it before the group it's
     * moving to is ever processed. This also incidentally makes a duplicate `sizes[].id`
     * in the submitted data harmless: since no group's pass can delete anything anymore,
     * a stale/duplicate row for the same size just re-applies (or no-ops) its own
     * ordering instead of erasing what an earlier row for that same id had just kept.
     *
     * @param array<int, array{id?: int|null, existing_photos?: array, new_photos?: array}> $sizesData
     */
    public function sync(Product $product, array $sizesData): void
    {
        $keptEverywhere = [];
        foreach ($sizesData as $sizeData) {
            $keptEverywhere = array_merge($keptEverywhere, array_filter($sizeData['existing_photos'] ?? []));
        }
        $keptEverywhere = array_values(array_unique($keptEverywhere));

        $product->photos()->whereNotIn('id', $keptEverywhere ?: [''])->get()
            ->each(fn ($file) => $this->fileService->deleteFile($file->id));

        foreach ($sizesData as $sizeData) {
            $this->reorderAndAppend(
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

    private function reorderAndAppend(Product $product, ?int $productSizeId, array $keepIds, array $newTokens): void
    {
        foreach ($keepIds as $index => $fileId) {
            // Scoped through $product->photos() (fileable-scoped to this product), so a
            // stray/foreign id here just matches zero rows and no-ops - see the mass
            // -assignment audit note on why a cross-product id can't land here anyway.
            $product->photos()->where('id', $fileId)
                ->update(['sort_order' => $index, 'product_size_id' => $productSizeId]);
        }

        $nextOrder = count($keepIds);
        foreach ($newTokens as $token) {
            if ($this->fileService->createProductPhoto($product, $productSizeId, $nextOrder, $token)) {
                $nextOrder++;
            }
        }
    }
}
