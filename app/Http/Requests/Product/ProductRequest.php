<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge(
            $this->baseRules(),
            $this->sizeRules()
        );
    }

    private function baseRules(): array
    {
        return [
            'name' => 'required|string_with_max',
            'quantity' => 'required|numeric|min:0',
            'SKU' => 'nullable|string_with_max',
            'description' => 'nullable',
            'category_id' => 'nullable|integer|exists:categories,id',
            'discount' => 'nullable|numeric|min:0',
        ];
    }

    private function sizeRules(): array
    {
        return [
            'sizes' => 'nullable|array|max:8',
            'sizes.*.id' => 'nullable|integer',
            'sizes.*.mode' => 'nullable|in:text,dimensions',
            // "text" mode needs `size`; "dimensions" mode needs all three of
            // height/width/depth instead - required_if/required_unless resolve the
            // wildcard `sizes.*.mode` against the SAME row index, not just row 0.
            'sizes.*.size' => 'required_unless:sizes.*.mode,dimensions|nullable|string_with_max',
            'sizes.*.height' => 'required_if:sizes.*.mode,dimensions|nullable|string_with_max',
            'sizes.*.width' => 'required_if:sizes.*.mode,dimensions|nullable|string_with_max',
            'sizes.*.depth' => 'required_if:sizes.*.mode,dimensions|nullable|string_with_max',
            'sizes.*.orientation' => 'nullable|in:left,right',
            'sizes.*.price' => 'required|numeric|min:0',
            'sizes.*.existing_photos' => 'nullable|array|max:20',
            'sizes.*.existing_photos.*' => 'nullable|string_with_max',
            'sizes.*.new_photos' => 'nullable|array|max:20',
            'sizes.*.new_photos.*' => 'nullable|string_with_max',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'name',
            'price' => 'price',
            'quantity' => 'quantity',
            'SKU' => 'SKU',
            'description' => 'description',
            'category_id' => 'category',
            'discount' => 'discount',
            'sizes' => 'sizes',
            'sizes.*.size' => 'size',
            'sizes.*.height' => 'height',
            'sizes.*.width' => 'width',
            'sizes.*.depth' => 'depth',
            'sizes.*.orientation' => 'orientation',
            'sizes.*.price' => 'size price',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
