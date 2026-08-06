<x-dashboard.layouts.app>
    <div class="container-fluid">
        <div class="card mb-4">
            <x-dashboard.form._form
                :action="$viewMode === 'add' ? route('dashboard.orders.store') : route('dashboard.orders.update', $order->id)"
                :method="$viewMode === 'add' ? 'post' : 'put'"
                :indexUrl="route('dashboard.orders.index')"
                :viewMode="$viewMode"
            >
                <div class="row">
                    <!-- Order Status -->
                    <div class="col-lg-6">
                        <div class="form-group required">
                            <label for="status">Статус заказа</label>
                            <select class="form-control" name="status" id="status" required>
                                @foreach(\App\Models\Order\Enums\OrderStatus::cases() as $status)
                                    <option value="{{ $status->value }}" {{ ($order->status->value ?? '') == $status->value ? 'selected' : '' }}>
                                        {{ $status->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Order Number -->
                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="order_number"
                                :value="$order->order_number ?? ''"
                                required
                            />
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="col-lg-6">
                        <div class="form-group required">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control" name="payment_method" id="payment_method" required>
                                <option value="bank_transfer" {{ ($order->payment_method ?? '') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="cash" {{ ($order->payment_method ?? '') == 'cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Customer Selection (если нужно) -->
                @if($viewMode === 'add')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="user_id">Клиент</label>
                                <select class="form-control select2" name="user_id" id="user_id">
                                    <option value="">-- Выберите клиента --</option>
                                    @foreach($customers ?? [] as $customer)
                                        <option value="{{ $customer->id }}" {{ ($order->user_id ?? '') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->full_name }} ({{ $customer->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Pricing Section -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">Стоимость заказа</h5>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="subtotal"
                                :value="$order->subtotal ?? 0"
                                type="number"
                                step="0.01"
                                min="0"
                                required
                            />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <x-dashboard.form._input
                                name="tax"
                                :value="$order->tax ?? 0"
                                type="number"
                                step="0.01"
                                min="0"
                            />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <x-dashboard.form._input
                                name="shipping_cost"
                                :value="$order->shipping_cost ?? 0"
                                type="number"
                                step="0.01"
                                min="0"
                            />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="total"
                                :value="$order->total ?? 0"
                                type="number"
                                step="0.01"
                                min="0"
                                required
                                readonly
                                class="bg-light"
                            />
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3">Информация о доставке</h5>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="shipping_first_name"
                                :value="$order->shipping_first_name ?? ''"
                                required
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="shipping_last_name"
                                :value="$order->shipping_last_name ?? ''"
                                required
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-dashboard.form._input
                                name="shipping_company"
                                :value="$order->shipping_company ?? ''"
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="shipping_email"
                                type="email"
                                :value="$order->shipping_email ?? ''"
                                required
                            />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="shipping_address"
                                :value="$order->shipping_address ?? ''"
                                required
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="shipping_city"
                                :value="$order->shipping_city ?? ''"
                                required
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <x-dashboard.form._input
                                name="shipping_state"
                                :value="$order->shipping_state ?? ''"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <x-dashboard.form._input
                                name="shipping_country"
                                :value="$order->shipping_country ?? ''"
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-dashboard.form._input
                                name="shipping_zip_code"
                                :value="$order->shipping_zip_code ?? ''"
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group required">
                            <x-dashboard.form._input
                                name="shipping_phone"
                                :value="$order->shipping_phone ?? ''"
                                required
                            />
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="notes">Примечания к заказу</label>
                            <textarea
                                class="form-control"
                                name="notes"
                                id="notes"
                                rows="4"
                                placeholder="Любые дополнительные примечания к заказу..."
                            >{{ $order->notes ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

            </x-dashboard.form._form>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('/js/dashboard/order/main.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-calculate total
                const subtotalInput = document.querySelector('input[name="subtotal"]');
                const taxInput = document.querySelector('input[name="tax"]');
                const shippingInput = document.querySelector('input[name="shipping_cost"]');
                const totalInput = document.querySelector('input[name="total"]');

                function calculateTotal() {
                    const subtotal = parseFloat(subtotalInput?.value) || 0;
                    const tax = parseFloat(taxInput?.value) || 0;
                    const shipping = parseFloat(shippingInput?.value) || 0;
                    const total = subtotal + tax + shipping;

                    if (totalInput) {
                        totalInput.value = total.toFixed(2);
                    }
                }

                [subtotalInput, taxInput, shippingInput].forEach(input => {
                    if (input) {
                        input.addEventListener('input', calculateTotal);
                        input.addEventListener('change', calculateTotal);
                    }
                });

                // Auto-generate order number if empty
                const orderNumberInput = document.querySelector('input[name="order_number"]');
                if (orderNumberInput && !orderNumberInput.value) {
                    orderNumberInput.value = 'ORD-' + Math.random().toString(36).substr(2, 9).toUpperCase();
                }

                // Initialize calculation on page load
                calculateTotal();

                // Select2 initialization if needed
                if (typeof $ !== 'undefined' && $().select2) {
                    $('.select2').select2({
                        placeholder: "Выберите клиента",
                        allowClear: true
                    });
                }
            });
        </script>
    </x-slot>
</x-dashboard.layouts.app>
