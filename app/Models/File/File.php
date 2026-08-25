<?php

namespace App\Models\File;

use App\Models\Base\BaseModel;
use App\Models\File\Traits\FileAccessors;
use App\Models\ProductSize\ProductSize;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends BaseModel
{
    use FileAccessors;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'file_type',
        'field_name',
        'file_name',
        'dir_prefix',
        'product_size_id',
        'sort_order',
    ];

    public function productSize(): BelongsTo
    {
        return $this->belongsTo(ProductSize::class);
    }

    /**
     * @var string[]
     */
    protected $appends = [
        'file_path',
        'file_url',
        'file_original_name',
    ];
}
