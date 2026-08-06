<?php

namespace App\Models\BasketItem;

use App\Models\Base\BaseModel;
use App\Models\Base\Traits\HasFileData;
use App\Models\BasketItem\Traits\BasketItemRelations;

class BasketItem extends BaseModel
{
    use HasFileData;
    use BasketItemRelations;

    protected $fillable = [
        'basket_id',
        'product_id',
        'product_size_id',
        'quantity',
    ];

    public function getUnitPriceAttribute(): float
    {
        return (float) ($this->productSize?->price ?? $this->product->price);
    }

    public function getLineTotalAttribute(): float
    {
        return $this->unit_price * $this->quantity;
    }
}
