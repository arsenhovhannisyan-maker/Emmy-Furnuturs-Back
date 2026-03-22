<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopProductsBrowseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $raw = $this->input('category_ids', $this->input('categories'));

        if (is_string($raw)) {
            $categoryIds = array_values(array_unique(array_filter(array_map('intval', explode(',', $raw)))));
        } elseif (is_array($raw)) {
            $categoryIds = array_values(array_unique(array_filter(array_map('intval', $raw))));
        } else {
            $categoryIds = [];
        }

        $min = $this->input('min_price');
        $max = $this->input('max_price');

        $this->merge([
            'min_price' => ($min === '' || $min === null) ? 0 : $min,
            'max_price' => ($max === '' || $max === null) ? 999999 : $max,
            'category_ids' => $categoryIds,
        ]);
    }

    public function rules(): array
    {
        return [
            'min_price' => ['required', 'numeric', 'min:0'],
            'max_price' => ['required', 'numeric', 'gte:min_price'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:48'],
        ];
    }
}
