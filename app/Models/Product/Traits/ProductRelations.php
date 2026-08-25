<?php

namespace App\Models\Product\Traits;

use App\Models\Categorie\Categorie;
use App\Models\File\File;
use App\Models\ProductSize\ProductSize;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ProductRelations
{
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class, 'product_id')->orderBy('id');
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable')
            ->where('field_name', 'photos')
            ->orderBy('product_size_id')
            ->orderBy('sort_order');
    }

    /**
     * The main/thumbnail photo shown in listings - the first photo (by sort_order)
     * of the first size (by product_size_id, i.e. creation order), so it stays
     * deterministic even though several sizes each have their own sort_order 0.
     */
    public function photo1(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')
            ->where('field_name', 'photos')
            ->orderBy('product_size_id')
            ->orderBy('sort_order');
    }
}
