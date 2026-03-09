<x-web-layout>
    <div class="page">
        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.cart_page')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ route('web.home') }}">@lang('messages.home')</a></li>
                        <li><a href="{{ route('web.shop') }}">@lang('messages.shop')</a></li>
                        <li class="active">@lang('messages.cart_page')</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Shopping Cart-->
        <section class="section section-md bg-default">
            <div class="container">
                <!-- shopping-cart-->
                <div class="table-custom-responsive">
                    <table class="table-custom table-cart">
                        <thead>
                        <tr>
                            <th>@lang('messages.product_name')</th>
                            <th>@lang('messages.price')</th>
                            <th>@lang('messages.quantity')</th>
                            <th>@lang('messages.total')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>
                                    <a class="table-cart-figure" href="{{ route('web.product', $item->product->id) }}">
                                        <img src="{{ $item->product->photo1->file_url ?? asset('images/shop/product-placeholder.png') }}" alt="{{ $item->product->name }}" width="146" height="132"/>
                                    </a>
                                    <a class="table-cart-link" href="{{ route('web.product', $item->product->id) }}">{{ $item->product->name }}</a>
                                </td>
                                <td>{{ number_format($item->product->price, 2) }} @lang('messages.currency_rub')</td>
                                <td>
                                    <div class="table-cart-stepper" data-item-id="{{ $item->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="button" class="cart-qty-btn cart-qty-minus" aria-label="-">−</button>
                                        <input class="form-input form-control cart-qty-input" type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="1000" style="text-align: center;">
                                        <button type="button" class="cart-qty-btn cart-qty-plus" aria-label="+">+</button>
                                    </div>
                                </td>
                                <td class="cart-row-total" data-item-id="{{ $item->id }}">{{ number_format($item->quantity * $item->product->price, 2) }} @lang('messages.currency_rub')</td>
                                <td>
                                    <button type="button" class="btn-delete" data-item-id="{{ $item->id }}" data-item-name="{{ $item->product->name }}">
                                        <span class="mdi mdi-trash-can-outline" aria-hidden="true"></span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="empty-cart">
                                        <i class="mdi mdi-cart-off" style="font-size: 48px; color: #ccc; margin-bottom: 16px;"></i>
                                        <p class="text-muted">@lang('messages.cart_empty')</p>
                                        <a href="{{ route('web.products') }}" class="button button-primary button-zakaria">
                                            Покупать товары
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if($items->count() > 0)
                    <div class="group-xl group-justify justify-content-center justify-content-md-between mt-4">
                        <div>
                            <div class="group-xl group-middle">
                                <div>
                                    <div class="group-md group-middle">
                                        <div class="heading-5 font-weight-medium text-gray-500">@lang('messages.total')</div>
                                        <div class="heading-3 font-weight-normal" id="cart-total-amount">{{ number_format($total, 2) }} @lang('messages.currency_rub')</div>
                                    </div>
                                </div>
                                <a class="button button-lg button-primary button-zakaria" href="{{ route('order.checkout') }}">@lang('messages.proceed_to_checkout')</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        @include('web.components.our-brand')
        @include('SEO.cart-seo')

    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">@lang('messages.confirm_removal')</h3>
                <button type="button" class="modal-close" id="closeModal">
                    <span class="mdi mdi-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-icon">
                    <span class="mdi mdi-alert-circle-outline"></span>
                </div>
                <p>@lang('messages.confirm_remove_item') <strong id="itemName"></strong> @lang('messages.from_your_cart')</p>
                <p class="modal-warning">@lang('messages.action_cannot_undone')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" id="cancelDelete">@lang('messages.cancel')</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-confirm">@lang('messages.yes_remove')</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced Delete Button Styles */
        .btn-delete {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            color: #dc3545;
            cursor: pointer;
            padding: 8px 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .btn-delete:hover {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }

        .btn-delete:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
        }

        .btn-delete .mdi {
            font-size: 18px;
        }

        /* Quantity stepper (- / +) */
        .table-cart-stepper {
            display: inline-flex;
            align-items: center;
            gap: 0;
            max-width: 150px;
        }
        .cart-qty-btn {
            width: 36px;
            height: 36px;
            border: 1px solid #e0e0e0;
            background: #f8f9fa;
            font-size: 18px;
            line-height: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            transition: all 0.2s ease;
        }
        .cart-qty-btn:hover {
            background: #e9ecef;
            border-color: #dee2e6;
        }
        .cart-qty-input {
            width: 56px;
            height: 36px;
            margin: 0 -1px;
            border-radius: 0;
        }

        /* Empty Cart Styles */
        .empty-cart {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-cart .mdi {
            display: block;
            margin: 0 auto 16px;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            padding: 20px;
        }

        .modal-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            animation: modalSlideIn 0.3s ease-out;
            overflow: hidden;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: #6c757d;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: #f8f9fa;
            color: #495057;
        }

        .modal-body {
            padding: 24px;
            text-align: center;
        }

        .modal-icon {
            font-size: 48px;
            color: #e74c3c;
            margin-bottom: 16px;
        }

        .modal-body p {
            font-size: 16px;
            color: #495057;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .modal-warning {
            font-size: 14px;
            color: #6c757d;
            font-style: italic;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 20px 24px;
            border-top: 1px solid #e9ecef;
            background: #f8f9fa;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        .btn-confirm {
            background: #e74c3c;
            color: white;
        }

        .btn-confirm:hover {
            background: #c0392b;
            transform: translateY(-1px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .btn-delete {
                width: 36px;
                height: 36px;
                padding: 6px 10px;
            }

            .btn-delete .mdi {
                font-size: 16px;
            }

            .modal-container {
                margin: 0 15px;
            }

            .modal-footer {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .table-cart-stepper .input-group {
                flex-direction: column;
                gap: 8px;
            }

            .table-cart-stepper .button {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            const modal = document.getElementById('deleteModal');
            const closeModal = document.getElementById('closeModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const itemName = document.getElementById('itemName');
            const deleteForm = document.getElementById('deleteForm');

            // Open modal when delete button is clicked
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const productName = this.getAttribute('data-item-name');

                    itemName.textContent = productName;

                    // Правильное формирование URL для маршрута с параметром
                    const baseUrl = "{{ route('basket.remove', ['id' => '__ID__']) }}";
                    deleteForm.action = baseUrl.replace('__ID__', itemId);

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });

            // Close modal functions
            function closeModalFunc() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            closeModal.addEventListener('click', closeModalFunc);
            cancelDelete.addEventListener('click', closeModalFunc);

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModalFunc();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'flex') {
                    closeModalFunc();
                }
            });

            // Обновление количества по +/- без перезагрузки
            const updateUrl = "{{ route('basket.update') }}";
            const currencyLabel = " @lang('messages.currency_rub')";

            function sendQuantityUpdate(itemId, quantity) {
                const formData = new FormData();
                formData.append('_token', document.querySelector('input[name="_token"]').value);
                formData.append('item_id', itemId);
                formData.append('quantity', String(quantity));

                return fetch(updateUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                }).then(r => r.json());
            }

            function updateCartDisplay(itemId, lineTotal, cartTotal) {
                const rowTotalEl = document.querySelector('.cart-row-total[data-item-id="' + itemId + '"]');
                if (rowTotalEl) {
                    rowTotalEl.textContent = Number(lineTotal).toLocaleString('ru-RU', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + currencyLabel;
                }
                const cartTotalEl = document.getElementById('cart-total-amount');
                if (cartTotalEl) {
                    cartTotalEl.textContent = Number(cartTotal).toLocaleString('ru-RU', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + currencyLabel;
                }
            }

            document.querySelectorAll('.table-cart-stepper').forEach(stepper => {
                const itemId = stepper.getAttribute('data-item-id');
                const input = stepper.querySelector('.cart-qty-input');
                const minusBtn = stepper.querySelector('.cart-qty-minus');
                const plusBtn = stepper.querySelector('.cart-qty-plus');

                function applyQuantity(newQty) {
                    newQty = Math.max(1, Math.min(1000, parseInt(newQty, 10) || 1));
                    input.value = newQty;
                    sendQuantityUpdate(itemId, newQty)
                        .then(data => {
                            if (data.success) {
                                updateCartDisplay(itemId, data.line_total, data.cart_total);
                            }
                        })
                        .catch(err => console.error(err));
                }

                minusBtn.addEventListener('click', function() {
                    const q = parseInt(input.value, 10) || 1;
                    if (q > 1) applyQuantity(q - 1);
                });

                plusBtn.addEventListener('click', function() {
                    const q = parseInt(input.value, 10) || 1;
                    if (q < 1000) applyQuantity(q + 1);
                });

                input.addEventListener('change', function() {
                    let q = parseInt(this.value, 10);
                    if (isNaN(q) || q < 1) q = 1;
                    if (q > 1000) q = 1000;
                    this.value = q;
                    applyQuantity(q);
                });
            });
        });
    </script>
</x-web-layout>
