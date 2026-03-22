<?php

namespace App\Contracts\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IProductRepository
{
    public function getEightWithPhoto(): Collection;

    public function getTargetProducts(int $categoryId): Collection;

    public function getPaginationProducts(int $count): LengthAwarePaginator;

    public function browseForShop(float $minPrice, float $maxPrice, array $categoryIds, int $perPage = 6): LengthAwarePaginator;

    public function getFeaturedProducts(int $productId): Collection;
}
