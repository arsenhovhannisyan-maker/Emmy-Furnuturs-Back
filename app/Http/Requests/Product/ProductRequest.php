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
            'sizes.*.size' => 'required|string_with_max',
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
            'sizes.*.price' => 'size price',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
