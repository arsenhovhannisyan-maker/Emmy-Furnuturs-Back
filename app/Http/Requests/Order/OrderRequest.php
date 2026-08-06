<?php

namespace App\Http\Requests\Order;

use App\Models\Order\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        $orderId = $this->route('order') ? $this->route('order')->id : null;

        return [
            // Order Information
            'status' => ['required', Rule::enum(OrderStatus::class)],
            'order_number' => 'sometimes|string|max:50|unique:orders,order_number,' . $orderId,
            'payment_method' => 'required|string|in:bank_transfer,cash',

            // Pricing
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'shipping_cost' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',

            // Shipping Information
            'shipping_first_name' => 'required|string|max:255',
            'shipping_last_name' => 'required|string|max:255',
            'shipping_company' => 'nullable|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'nullable|string|max:255',
            'shipping_country' => 'nullable|string|max:255',
            'shipping_zip_code' => 'nullable|string|max:20',

            // Additional
            'notes' => 'nullable|string|max:1000',
            'user_id' => 'sometimes|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Order status is required.',
            'payment_method.required' => 'Payment method is required.',

            'shipping_first_name.required' => 'First name is required.',
            'shipping_last_name.required' => 'Last name is required.',
            'shipping_email.required' => 'Email is required.',
            'shipping_phone.required' => 'Phone number is required.',
            'shipping_address.required' => 'Address is required.',
            'shipping_city.required' => 'City is required.',
        ];
    }

    public function prepareForValidation()
    {
        // Auto-generate order number if not provided
        if (!$this->route('order') && empty($this->order_number)) {
            $this->merge([
                'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid()),
            ]);
        }

        // Set default status if not provided
        if (empty($this->status)) {
            $this->merge([
                'status' => OrderStatus::Pending->value,
            ]);
        }

        // Ensure numeric values
        $this->merge([
            'subtotal' => (float)($this->subtotal ?? 0),
            'tax' => (float)($this->tax ?? 0),
            'shipping_cost' => (float)($this->shipping_cost ?? 0),
            'total' => (float)($this->total ?? 0),
        ]);
    }
}
