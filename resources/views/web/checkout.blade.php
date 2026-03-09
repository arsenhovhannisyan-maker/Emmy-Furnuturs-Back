<x-web-layout>
    <div class="page">
        <!-- Единая форма для всего заказа -->
        <form class="ch-form ch-mailform form-checkout" id="order-form" method="POST">
            @csrf

            <!-- Section checkout form-->
            <section class="section section-sm section-first bg-default text-md-left">
                <div class="container">
                    <div class="row row-50 justify-content-center">
                        <div class="col-md-10 col-lg-6" id="shipping-address-section">
                            <h3 class="font-weight-medium">@lang('messages.delivery_address')</h3>
                            <div class="row row-30">
                                <div class="col-sm-6">
                                    <div class="form-wrap">
                                        <input class="form-input" id="checkout-first-name-2" type="text" name="shipping_first_name" value="{{ auth()->user()->first_name ?? '' }}" required/>
                                        <label class="form-label" for="checkout-first-name-2">@lang('messages.first_name')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-wrap">
                                        <input class="form-input" id="checkout-last-name-2" type="text" name="shipping_last_name" value="{{ auth()->user()->last_name ?? '' }}" required/>
                                        <label class="form-label" for="checkout-last-name-2">@lang('messages.last_name')</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-wrap">
                                        <input class="form-input" id="checkout-company-2" type="text" name="shipping_company"/>
                                        <label class="form-label" for="checkout-company-2">@lang('messages.company')</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-wrap">
                                        <input class="form-input" id="checkout-address-2" type="text" name="shipping_address" required/>
                                        <label class="form-label" for="checkout-address-2">@lang('messages.address1')</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-wrap">
                                        <input class="form-input" id="checkout-city-2" type="text" name="shipping_city" required/>
                                        <label class="form-label" for="checkout-city-2">@lang('messages.city_town')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-wrap">
                                        <input class="form-input" id="checkout-email-2" type="email" name="shipping_email" value="{{ auth()->user()->email ?? '' }}" required/>
                                        <label class="form-label" for="checkout-email-2">@lang('messages.email')</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-wrap">
                                        <input class="form-input" id="checkout-phone-2" type="text" name="shipping_phone" required/>
                                        <label class="form-label" for="checkout-phone-2">@lang('messages.phone')</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-wrap">
                                        <textarea class="form-input" id="checkout-notes" name="notes" placeholder="@lang('messages.notes')"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Shopping Cart Section -->
            <section class="section section-sm bg-default text-md-left">
                <div class="container">
                    <h3 class="font-weight-medium">@lang('messages.your_shopping_cart')</h3>
                    <div class="table-custom-responsive">
                        <table class="table-custom table-cart">
                            <thead>
                            <tr>
                                <th>@lang('messages.product_name')</th>
                                <th>@lang('messages.price')</th>
                                <th>@lang('messages.quantity')</th>
                                <th>@lang('messages.total')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>
                                        <a class="table-cart-figure" href="{{ route('web.product', $item->product->id) }}">
                                            <img src="{{ $item->product->photo1->file_url ?? 'images/shop/product-placeholder.png' }}" alt="" width="146" height="132"/>
                                        </a>
                                        <a class="table-cart-link" href="#">{{ $item->product->name }}</a>
                                    </td>
                                    <td>${{ number_format($item->product->price, 2) }}</td>
                                    <td>
                                        <div class="table-cart-stepper">
                                            {{$item->quantity}}
                                        </div>
                                    </td>
                                    <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">@lang('messages.cart_empty')</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Payment Methods Section -->
            <section class="section section-sm section-last bg-default text-md-left">
                <div class="container">
                    <div class="row row-50 justify-content-center">
                        <div class="col-md-10 col-lg-6">
                            <h3 class="font-weight-medium">@lang('messages.payment_methods')</h3>
                            <div class="box-radio">
                                <!-- Bank Transfer -->
                                <div class="radio-panel">
                                    <label class="radio-inline active">
                                        <input name="payment_method" value="bank_transfer" type="radio" checked>
                                        <i class="fas fa-university me-2"></i> @lang('messages.bank_transfer')
                                    </label>
                                    <div class="radio-panel-content">
                                        <p>@lang('messages.bank_transfer_description')</p>
                                    </div>
                                </div>

                                <!-- PayPal -->
                                <div class="radio-panel">
                                    <label class="radio-inline">
                                        <input name="payment_method" value="paypal" type="radio">
                                        <i class="fab fa-paypal me-2"></i> PayPal
                                    </label>
                                    <div class="radio-panel-content">
                                        <p>@lang('messages.paypal_description')</p>
                                    </div>
                                </div>

                                <!-- Credit Card -->
                                <div class="radio-panel">
                                    <label class="radio-inline">
                                        <input name="payment_method" value="credit_card" type="radio">
                                        <i class="far fa-credit-card me-2"></i> @lang('messages.credit_card')
                                    </label>
                                    <div class="radio-panel-content">
                                        <p>@lang('messages.credit_card_description')</p>
                                        <div class="mt-3" id="credit-card-fields" style="display: none;">
                                            <div class="form-wrap">
                                                <input class="form-input" type="text" name="card_number" placeholder="@lang('messages.card_number')" />
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <div class="form-wrap">
                                                        <input class="form-input" type="text" name="expiry_date" placeholder="MM/YY" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-wrap">
                                                        <input class="form-input" type="text" name="cvv" placeholder="CVV" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-wrap mt-2">
                                                <input class="form-input" type="text" name="card_holder" placeholder="@lang('messages.card_holder_name')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10 col-lg-6">
                            <h3 class="font-weight-medium">@lang('messages.cart_total')</h3>
                            <div class="order-summary">
                                @php
                                    $subtotal = 0;
                                    foreach($items as $item) {
                                        $subtotal += $item->quantity * $item->product->price;
                                    }
                                    $shippingCost = 10.00;
                                    $tax = $subtotal * 0.08;
                                    $total = $subtotal + $shippingCost + $tax;
                                @endphp

                                <div class="summary-item">
                                    <span>@lang('messages.subtotal')</span>
                                    <span>${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="summary-item">
                                    <span>@lang('messages.shipping_cost')</span>
                                    <span>${{ number_format($shippingCost, 2) }}</span>
                                </div>
                                <div class="summary-item">
                                    <span>@lang('messages.tax')</span>
                                    <span>${{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="summary-item summary-total">
                                    <span>@lang('messages.total')</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>

                                <!-- Скрытые поля с ценами -->
                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                <input type="hidden" name="shipping_cost" value="{{ $shippingCost }}">
                                <input type="hidden" name="tax" value="{{ $tax }}">
                                <input type="hidden" name="total" value="{{ $total }}">
                            </div>

                            <!-- ЕДИНСТВЕННАЯ кнопка отправки -->
                            <div class="text-center mt-4">
                                <button type="submit" id="create-order-btn" class="button button-lg button-primary button-zakaria">
                                    @lang('messages.create_order')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>

    <!-- Добавьте эти элементы для уведомлений -->
    <div id="notification-container"></div>
    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <div>@lang('messages.processing_order')...</div>
        </div>
    </div>

    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 10000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            max-width: 400px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: #10b981;
            border-left: 4px solid #059669;
        }

        .notification.error {
            background: #ef4444;
            border-left: 4px solid #dc2626;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-overlay.show {
            display: flex;
        }

        .loading-spinner {
            background: white;
            padding: 30px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('order-form');
            const submitBtn = document.getElementById('create-order-btn');
            const creditCardFields = document.getElementById('credit-card-fields');
            const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
            const loadingOverlay = document.getElementById('loading-overlay');

            // Функция для показа уведомлений
            function showNotification(message, type = 'info') {
                const container = document.getElementById('notification-container');
                const notification = document.createElement('div');
                notification.className = `notification ${type}`;

                const icons = {
                    success: '✅',
                    error: '❌',
                    warning: '⚠️',
                    info: 'ℹ️'
                };

                notification.innerHTML = `
                    <div class="notification-content">
                        <span class="notification-icon">${icons[type]}</span>
                        <span>${message}</span>
                    </div>
                `;

                container.appendChild(notification);

                setTimeout(() => notification.classList.add('show'), 100);

                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 5000);
            }

            // Показ/скрытие полей кредитной карты
            paymentMethods.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'credit_card') {
                        creditCardFields.style.display = 'block';
                        creditCardFields.querySelectorAll('input').forEach(input => {
                            input.required = true;
                        });
                    } else {
                        creditCardFields.style.display = 'none';
                        creditCardFields.querySelectorAll('input').forEach(input => {
                            input.required = false;
                        });
                    }
                });
            });

            // Валидация формы
            function validateForm() {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#ef4444';
                    } else {
                        field.style.borderColor = '';
                    }
                });

                if (!isValid) {
                    showNotification('@lang("messages.please_fill_all_required_fields")', 'warning');
                    return false;
                }

                return true;
            }

            // Обработка отправки формы
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return;
                }

                const originalText = submitBtn.textContent;

                // Показываем лоадер
                loadingOverlay.classList.add('show');
                submitBtn.disabled = true;
                submitBtn.textContent = '@lang("messages.processing")...';

                // Get form data
                const formData = new FormData(this);

                // Send AJAX request - ИСПРАВЛЕННЫЙ ROUTE!
                fetch('{{ route("dashboard.web.order.create") }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('@lang("messages.order_created_successfully")', 'success');

                            // Редирект через 2 секунды
                            setTimeout(() => {
                                window.location.href = '/';
                            }, 2000);
                        } else {
                            showNotification(data.message || '@lang("messages.error_creating_order")', 'error');
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalText;
                            loadingOverlay.classList.remove('show');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('@lang("messages.network_error_try_again")', 'error');
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                        loadingOverlay.classList.remove('show');
                    });
            });

            // Убираем красную обводку при вводе
            form.querySelectorAll('input, textarea').forEach(field => {
                field.addEventListener('input', function() {
                    if (this.style.borderColor === 'rgb(239, 68, 68)') {
                        this.style.borderColor = '';
                    }
                });
            });
        });
    </script>
    @include('SEO.checkout-seo')

</x-web-layout>
