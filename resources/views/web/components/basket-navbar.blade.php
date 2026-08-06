<!-- RD Navbar Basket -->
<div class="ch-navbar-basket-wrap" style="font-size: 0.85rem;">
    <button class="ch-navbar-basket fas fa-shopping-cart" data-ch-navbar-toggle=".cart-inline" aria-label="@lang('messages.cart_page')" style="font-size: 1.2rem; padding: 6px 8px;">
        <span class="cart-badge-count">0</span>
    </button>

    <div class="cart-inline" style="width: 250px; font-size: 0.85rem;">
        <div class="cart-inline-header" style="padding: 8px 12px;">
            <h5 class="cart-inline-title">@lang('messages.in_cart'):<span id="cart-inline-count"> 0</span> @lang('messages.products')</h5>
            <h6 class="cart-inline-title">@lang('messages.total_price'):<span id="cart-inline-total"> 0 @lang('messages.currency_rub')</span></h6>
        </div>

        <div class="cart-inline-body" style="max-height: 200px; overflow-y: auto; padding: 8px 12px;">
            <!-- Items will load dynamically -->
            <div class="text-center py-2" id="basket-loading">
                <span>@lang('messages.loading')</span>
            </div>
        </div>

        <div class="cart-inline-footer" style="padding: 8px 12px;">
            <div class="group-sm" style="display: flex; gap: 4px; flex-wrap: wrap;">
                <a class="button button-default-outline-2 button-zakaria" href="{{ route('web.cart') }}" style="padding: 4px 8px; font-size: 0.8rem;">
                    @lang('messages.go_to_cart')
                </a>
                <a class="button button-primary button-zakaria" href="{{ route('order.checkout') }}" style="padding: 4px 8px; font-size: 0.8rem;">
                    @lang('messages.checkout')
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var currencyLabel = ' @lang('messages.currency_rub')';

        function formatMoney(value) {
            return Number(value || 0).toLocaleString('ru-RU', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function renderItems(items) {
            var basketBody = document.querySelector('.cart-inline-body');
            if (!basketBody) return;

            basketBody.innerHTML = '';

            if (!items || items.length === 0) {
                basketBody.innerHTML = '<div class="text-center py-2">@lang("messages.basket_empty")</div>';
                return;
            }

            items.forEach(function (item) {
                var imageUrl = (item.image && item.image.file_url) ? item.image.file_url : '{{ asset("images/shop/product-placeholder.png") }}';
                var sizeLine = item.size ? ('<div style="font-size: 0.7rem; color: #888;">' + item.size + '</div>') : '';
                var el = '' +
                    '<div class="cart-inline-item" style="margin-bottom: 6px;">' +
                        '<div class="unit unit-spacing-sm align-items-center" style="gap: 6px;">' +
                            '<div class="unit-left">' +
                                '<a class="cart-inline-figure" href="/products/' + item.product_id + '">' +
                                    '<img src="' + imageUrl + '" alt="' + item.name + '" width="60" height="55"/>' +
                                '</a>' +
                            '</div>' +
                            '<div class="unit-body">' +
                                '<h6 class="cart-inline-name" style="font-size: 0.8rem;">' +
                                    '<a href="/products/' + item.product_id + '">' + item.name + '</a>' +
                                '</h6>' +
                                sizeLine +
                                '<div class="group-xs group-middle" style="display: flex; gap: 4px; align-items: center;">' +
                                    '<span style="font-size: 0.75rem;">' + item.quantity + ' &times;</span>' +
                                    '<h6 class="cart-inline-title" style="font-size: 0.8rem;">' + formatMoney(item.price) + currencyLabel + '</h6>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
                basketBody.insertAdjacentHTML('beforeend', el);
            });
        }

        function applyData(data) {
            var badges = document.querySelectorAll('.cart-badge-count');
            var headerCount = document.getElementById('cart-inline-count');
            var headerTotal = document.getElementById('cart-inline-total');

            badges.forEach(function (badge) { badge.textContent = data.count; });
            if (headerCount) headerCount.textContent = ' ' + data.count;
            if (headerTotal) headerTotal.textContent = ' ' + formatMoney(data.total) + currencyLabel;

            renderItems(data.items);
        }

        window.refreshCartBadge = function () {
            return fetch('{{ route("basket.data") }}', {
                headers: { 'Accept': 'application/json' }
            })
                .then(function (response) { return response.json(); })
                .then(applyData)
                .catch(function (err) {
                    console.error('@lang('messages.basket_load_error'):', err);
                    var basketBody = document.querySelector('.cart-inline-body');
                    if (basketBody) basketBody.innerHTML = '<div class="text-center py-2 text-danger">@lang("messages.basket_error_message")</div>';
                });
        };

        document.addEventListener('DOMContentLoaded', function () {
            var loading = document.getElementById('basket-loading');
            if (loading) loading.remove();
            window.refreshCartBadge();
        });

        document.addEventListener('cart:updated', function () {
            window.refreshCartBadge();
        });
    })();
</script>
