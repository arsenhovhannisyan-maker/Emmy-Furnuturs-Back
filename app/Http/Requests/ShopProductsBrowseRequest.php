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

        $min = $this->parsePrice($this->input('min_price'), 0);
        $max = $this->parsePrice($this->input('max_price'), 999999);

        if ($max < $min) {
            [$min, $max] = [$max, $min];
        }

        $this->merge([
            'min_price' => $min,
            'max_price' => $max,
            'category_ids' => $categoryIds,
        ]);
    }

    private function parsePrice(mixed $value, float $default): float
    {
        if ($value === null || $value === '') {
            return $default;
        }

        if (is_numeric($value)) {
            return max(0, (float) $value);
        }

        $normalized = preg_replace('/[^\d,.\-]/u', '', (string) $value);
        if ($normalized === null || $normalized === '') {
            return $default;
        }

        $normalized = str_replace(',', '.', $normalized);
        if (!is_numeric($normalized)) {
            return $default;
        }

        return max(0, (float) $normalized);
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
