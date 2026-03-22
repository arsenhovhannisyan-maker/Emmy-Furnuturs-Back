<?php

namespace App\Repositories\Product;

use App\Contracts\Product\IProductRepository;
use App\Models\Product\Product;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getPaginationProducts(int $perPage = 6): LengthAwarePaginator
    {
        return $this->model
            ->with(['photo1'])
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function browseForShop(float $minPrice, float $maxPrice, array $categoryIds, int $perPage = 6): LengthAwarePaginator
    {
        return $this->model->query()
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->when($categoryIds !== [], function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->with(['photo1'])
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getEightWithPhoto(): Collection
    {
        return $this->model
            ->with(['photo1'])
            ->take(8)
            ->get();
    }

    public function getTargetProducts(int $categoryId): Collection
    {
        return $this->model
            ->where('category_id', $categoryId)
            ->latest()
            ->take(8)
            ->get();
    }

    public function getFeaturedProducts(int $productId): Collection
    {
        $product = $this->model->findOrFail($productId);

        $with = ['photo1', 'sizes'];

        $fromCategory = $this->model->query()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with($with)
            ->orderByDesc('discount')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        if ($fromCategory->count() >= 4) {
            return $fromCategory;
        }

        $needed = 4 - $fromCategory->count();
        $excludeIds = $fromCategory->pluck('id')->push($product->id)->all();

        $more = $this->model->query()
            ->whereNotIn('id', $excludeIds)
            ->with($with)
            ->orderByDesc('discount')
            ->orderByDesc('created_at')
            ->take($needed)
            ->get();

        return $fromCategory->concat($more)->values();
    }
}
