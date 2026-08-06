<?php

namespace App\Models\BasketItem\Traits;


use App\Models\Basket\Basket;
use App\Models\Product\Product;
use App\Models\ProductSize\ProductSize;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BasketItemRelations
{
    public function basket(): BelongsTo
    {
        return $this->belongsTo(Basket::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productSize(): BelongsTo
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }
}

