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
        $existingIds = $product->sizes()->pluck('id')->all();
        $submittedIds = [];
        $resolved = [];

        foreach ($sizesData as $sizeRow) {
            $sizeId = $sizeRow['id'] ?? null;

            if ($sizeId && in_array((int) $sizeId, $existingIds, true)) {
                $size = $product->sizes()->whereKey($sizeId)->first();
                $size->update(['size' => $sizeRow['size'], 'price' => $sizeRow['price']]);
            } else {
                $size = $product->sizes()->create(['size' => $sizeRow['size'], 'price' => $sizeRow['price']]);
            }

            $submittedIds[] = $size->id;
            $resolved[] = array_merge($sizeRow, ['id' => $size->id]);
        }

        $removedIds = array_diff($existingIds, $submittedIds);
        if ($removedIds) {
            $this->photoService->deletePhotosForSizes($product, $removedIds);
            $product->sizes()->whereIn('id', $removedIds)->delete();
        }

        return $resolved;
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

        $data = [
            $variableKey => $model,
            'sizes' => $model->sizes->map(function ($size) use ($photosBySize) {
                return [
                    'id' => $size->id,
                    'size' => $size->size,
                    'price' => $size->price,
                    'photos' => ($photosBySize->get($size->id) ?? collect())
                        ->map(fn ($file) => ['id' => $file->id, 'url' => $file->file_url])
                        ->values()
                        ->toArray(),
                ];
            })->toArray(),
        ];

        if ($model->mls) {
            $data["{$variableKey}Ml"] = $model->mls->keyBy('lng_code');
        }

        return $data;
    }
}
