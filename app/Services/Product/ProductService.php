<?php

namespace App\Services\Product;

use App\Contracts\Product\IProductRepository;
use App\Services\BaseService;
use App\Services\File\FileTempService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{
    public function __construct(
        IProductRepository $repository,
        FileTempService $fileService,
        private readonly ProductPhotoService $photoService,
    ) {
        $this->repository = $repository;
        $this->fileService = $fileService;
    }

    public function update(array $data, ?int $id = null): Model
    {
        return DB::transaction(function () use ($id, $data) {
            $product = $this->repository->update($id, $data);
            $this->fileService->storeFile($product, $data);

            return $product;
        });
    }

    public function createOrUpdate(array $data, ?int $id = null): Model
    {
        return DB::transaction(function () use ($data, $id) {

            if (empty($data['price']) && !empty($data['sizes'])) {
                $data['price'] = $data['sizes'][0]['price'];
            }

            $model = $this->createOrUpdateWithoutTransaction($data, $id);

            if (!empty($data['sizes']) && method_exists($model, 'sizes')) {
                $resolvedSizes = $this->upsertSizes($model, $data['sizes']);
                $this->photoService->sync($model, $resolvedSizes);
            }

            return $model;
        });
    }

    /**
     * Update sizes in place by id and create the new ones, instead of wiping every
     * size row and recreating it on each save - photos are attached to a size by its
     * id, so recycling ids here is what keeps a size's photo gallery attached to it
     * across saves.
     */
    private function upsertSizes(Model $product, array $sizesData): array
    {
        $existingSizes = $product->sizes()->get()->keyBy('id');
        $submittedIds = [];
        $resolved = [];

        foreach ($sizesData as $sizeRow) {
            $sizeId = $sizeRow['id'] ?? null;
            $size = $sizeId ? $existingSizes->get((int) $sizeId) : null;
            $mode = ($sizeRow['mode'] ?? 'text') === 'dimensions' ? 'dimensions' : 'text';

            $attributes = [
                'size' => $this->composeSizeLabel($sizeRow, $mode),
                'price' => $sizeRow['price'],
                'mode' => $mode,
                // Only meaningful in dimensions mode - null them out here rather than
                // trusting the submitted row, so a stray/replayed value for the other
                // mode's fields (the client normally clears these on toggle, but that's
                // a UI nicety, not something the DB should have to rely on) can't get
                // persisted and then resurface as a wrong mode next time this loads.
                'height' => $mode === 'dimensions' ? ($sizeRow['height'] ?? null) : null,
                'width' => $mode === 'dimensions' ? ($sizeRow['width'] ?? null) : null,
                'depth' => $mode === 'dimensions' ? ($sizeRow['depth'] ?? null) : null,
                'orientation' => $sizeRow['orientation'] ?? null,
            ];

            if ($size) {
                $size->update($attributes);
            } else {
                $size = $product->sizes()->create($attributes);
            }

            $submittedIds[] = $size->id;
            $resolved[] = array_merge($sizeRow, ['id' => $size->id]);
        }

        $removedIds = array_diff($existingSizes->keys()->all(), $submittedIds);
        if ($removedIds) {
            $this->photoService->deletePhotosForSizes($product, $removedIds);
            $product->sizes()->whereIn('id', $removedIds)->delete();
        }

        return $resolved;
    }

    /**
     * The admin can describe a size as one free-text line (mode=text, unchanged
     * behavior) or as height/width/depth (mode=dimensions), matching the "В..хШ..хГ.."
     * convention already used by hand in this catalog. Either way the result lands in
     * the same `size` column every other part of the app already reads, so nothing
     * downstream (storefront selector, cart, checkout, orders) needs to change.
     *
     * Text mode is the one case where the stored `size` column is BOTH the display
     * string and the value that gets fed back into the admin's editable text field on
     * the next edit (dimensions mode always rebuilds fresh from height/width/depth,
     * which never carry a suffix). Without stripping a previously-applied suffix first,
     * re-saving an oriented text-mode size unchanged would append " (Слева)" again on
     * every save - this makes composing idempotent instead.
     */
    private function composeSizeLabel(array $sizeRow, string $mode): string
    {
        $label = $mode === 'dimensions'
            ? 'В' . ($sizeRow['height'] ?? '') . 'хШ' . ($sizeRow['width'] ?? '') . 'хГ' . ($sizeRow['depth'] ?? '')
            : $this->stripOrientationSuffix(trim($sizeRow['size'] ?? ''));

        return match ($sizeRow['orientation'] ?? null) {
            'left' => $label . ' (Слева)',
            'right' => $label . ' (Справа)',
            default => $label,
        };
    }

    private function stripOrientationSuffix(string $label): string
    {
        return preg_replace('/ \((?:Слева|Справа)\)$/u', '', $label);
    }

    public function getViewData(?int $id = null): array
    {
        // Create Mode
        if ($id === null) {
            $model = $this->repository->getInstance();

            return [
                $model::getClassNameCamelCase() => $model,
                'sizes' => [],
            ];
        }

        // Edit Mode
        $model = $this->repository->find($id);
        $variableKey = $model::getClassNameCamelCase();

        $photosBySize = $model->photos()->get()->groupBy('product_size_id');
        $toPhotoArray = fn ($files) => $files->map(fn ($file) => ['id' => $file->id, 'url' => $file->file_url])->values()->toArray();
        // Photos with no size (product_size_id null) shouldn't happen for a product that
        // has sizes, but can exist on a legacy product edited before it ever had any, or
        // on one where a historical size was removed out from under its photos. Surface
        // them somewhere editable rather than letting them silently vanish from the form.
        $unassignedPhotos = $toPhotoArray($photosBySize->get(null) ?? collect());

        if ($model->sizes->isEmpty()) {
            $sizes = $unassignedPhotos
                ? [['id' => null, 'size' => '', 'price' => '', 'height' => null, 'width' => null, 'depth' => null, 'orientation' => null, 'mode' => 'text', 'photos' => $unassignedPhotos]]
                : [];
        } else {
            $sizes = $model->sizes->values()->map(function ($size, $index) use ($photosBySize, $toPhotoArray, $unassignedPhotos) {
                $photos = $toPhotoArray($photosBySize->get($size->id) ?? collect());

                return [
                    'id' => $size->id,
                    'size' => $size->size,
                    'price' => $size->price,
                    'height' => $size->height,
                    'width' => $size->width,
                    'depth' => $size->depth,
                    'orientation' => $size->orientation,
                    'mode' => $size->mode ?? 'text',
                    'photos' => $index === 0 ? array_merge($unassignedPhotos, $photos) : $photos,
                ];
            })->toArray();
        }

        $data = [
            $variableKey => $model,
            'sizes' => $sizes,
        ];

        if ($model->mls) {
            $data["{$variableKey}Ml"] = $model->mls->keyBy('lng_code');
        }

        return $data;
    }
}
