<!-- "Покупать одним кликом" — quick buy modal -->
<div class="qb-overlay" id="qb-modal" role="dialog" aria-modal="true" aria-labelledby="qb-modal-title">
    <div class="qb-dialog" tabindex="-1">
        <h2 id="qb-modal-title" class="qb-visually-hidden">@lang('messages.buy_one_click')</h2>
        <button type="button" class="qb-close" id="qb-close" aria-label="@lang('messages.close')">&times;</button>
        <div class="qb-toast" id="qb-toast" role="status" aria-live="polite"></div>

        <div class="qb-step qb-step-auth" id="qb-step-auth" @guest @else hidden @endguest>
            <div class="qb-auth-icon mdi mdi-lock-outline" aria-hidden="true"></div>
            <h3 id="qb-step-auth-title" tabindex="-1">@lang('messages.quick_buy_login_required_title')</h3>
            <p>@lang('messages.quick_buy_login_required_text')</p>
            <a href="{{ route('web.quick-buy.start') }}" class="qb-btn qb-btn-primary">@lang('messages.quick_buy_login_button')</a>
        </div>

        <div class="qb-step qb-step-categories" id="qb-step-categories" @guest hidden @endguest>
            <div class="qb-header">
                <h3 id="qb-modal-title-categories" tabindex="-1">@lang('messages.buy_one_click')</h3>
                <p class="qb-subtitle">@lang('messages.quick_buy_select_category')</p>
            </div>
            <div class="qb-body">
                <div class="qb-categories-grid" id="qb-categories-grid">
                    <div class="qb-loading">@lang('messages.loading')</div>
                </div>
            </div>
        </div>

        <div class="qb-step qb-step-products" id="qb-step-products" hidden>
            <div class="qb-header qb-header-with-back">
                <button type="button" class="qb-back" id="qb-back-to-categories">
                    <span class="mdi mdi-arrow-left" aria-hidden="true"></span>
                    @lang('messages.quick_buy_back_to_categories')
                </button>
                <h3 id="qb-category-name" tabindex="-1"></h3>
            </div>
            <div class="qb-body">
                <div class="qb-products-grid" id="qb-products-grid">
                    <div class="qb-loading">@lang('messages.loading')</div>
                </div>
            </div>
        </div>

        <div class="qb-footer" id="qb-footer" @guest hidden @endguest>
            <div class="qb-footer-summary">
                <span class="qb-footer-count"><span id="qb-cart-count">0</span> @lang('messages.products')</span>
                <span class="qb-footer-total" id="qb-cart-total">0 @lang('messages.currency_rub')</span>
            </div>
            <a href="{{ route('order.checkout') }}" class="qb-btn qb-btn-checkout qb-btn-disabled" id="qb-checkout-btn" aria-disabled="true">
                @lang('messages.checkout')
            </a>
        </div>
    </div>
</div>

<style>
    .qb-visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .qb-trigger {
        position: absolute;
        z-index: 30;
        right: 24px;
        bottom: 28px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 19px 38px;
        border: none;
        border-radius: 60px;
        background: linear-gradient(135deg, #5ccedf 0%, #39b3b8 100%);
        color: #123138;
        font-weight: 800;
        font-size: 17px;
        letter-spacing: .03em;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow: 0 14px 30px rgba(57, 179, 184, .45), 0 6px 16px rgba(15, 23, 42, .2);
        transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
        text-decoration: none;
        line-height: 1.2;
    }

    .qb-trigger:hover,
    .qb-trigger:focus {
        transform: translateY(-3px);
        box-shadow: 0 18px 38px rgba(57, 179, 184, .55), 0 8px 20px rgba(15, 23, 42, .24);
        filter: brightness(1.05);
        color: #123138;
        text-decoration: none;
    }

    .qb-trigger-icon {
        font-size: 26px;
        line-height: 1;
    }

    @media (max-width: 991px) {
        .qb-trigger {
            right: 16px;
            bottom: 20px;
            padding: 16px 30px;
            font-size: 15px;
        }

        .qb-trigger-icon {
            font-size: 22px;
        }
    }

    @media (max-width: 575px) {
        .qb-trigger {
            left: 50%;
            right: auto;
            transform: translateX(-50%);
            bottom: 14px;
            padding: 14px 26px;
            font-size: 14px;
            white-space: nowrap;
            max-width: calc(100% - 24px);
        }

        .qb-trigger:hover,
        .qb-trigger:focus {
            transform: translateX(-50%) translateY(-2px);
        }

        .qb-trigger-text {
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }

    .qb-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 10010;
        background: rgba(15, 23, 42, .62);
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .qb-overlay.is-open {
        display: flex;
    }

    .qb-dialog {
        position: relative;
        width: 100%;
        max-width: 960px;
        max-height: 85vh;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 24px 70px rgba(0, 0, 0, .35);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .qb-close {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 5;
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 50%;
        background: #f1f5f9;
        color: #334155;
        font-size: 22px;
        line-height: 1;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }

    .qb-close:hover {
        background: #e2e8f0;
        transform: scale(1.06);
    }

    .qb-toast {
        position: absolute;
        top: 14px;
        left: 50%;
        transform: translateX(-50%) translateY(-12px);
        background: #1f2937;
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        max-width: 85%;
        text-align: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity .25s ease, transform .25s ease;
        z-index: 6;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .25);
    }

    .qb-toast.is-visible {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    .qb-toast.qb-toast-error {
        background: #dc2626;
    }

    .qb-step {
        flex: 1 1 auto;
        min-height: 0;
        display: flex;
        flex-direction: column;
    }

    .qb-step-auth {
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 56px 32px;
        gap: 6px;
    }

    .qb-auth-icon {
        font-size: 46px;
        color: #50BECF;
        margin-bottom: 10px;
    }

    .qb-step-auth h3 {
        margin: 0 0 4px;
        font-size: 22px;
        font-weight: 700;
        color: #1f2937;
    }

    .qb-step-auth p {
        margin: 0 0 22px;
        color: #64748b;
        max-width: 420px;
    }

    .qb-header {
        padding: 24px 56px 16px 24px;
        border-bottom: 1px solid #eef1f5;
        flex: 0 0 auto;
    }

    .qb-header h3 {
        margin: 0 0 4px;
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
    }

    .qb-subtitle {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .qb-header-with-back {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .qb-back {
        align-self: flex-start;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        background: none;
        color: #1f7a89;
        font-weight: 600;
        font-size: 14px;
        padding: 10px 0;
        min-height: 40px;
        cursor: pointer;
    }

    .qb-back:hover {
        color: #145b68;
        text-decoration: underline;
    }

    .qb-body {
        flex: 1 1 auto;
        min-height: 0;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        padding: 20px 24px;
    }

    .qb-loading,
    .qb-empty {
        padding: 40px 10px;
        text-align: center;
        color: #64748b;
        font-size: 15px;
        grid-column: 1 / -1;
    }

    .qb-empty.qb-error-text {
        color: #dc2626;
    }

    .qb-categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 14px;
    }

    .qb-category-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-align: center;
        padding: 22px 12px;
        border: 1px solid #e5e9f0;
        border-radius: 12px;
        background: #f8fafc;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease, background .2s ease;
        min-height: 108px;
    }

    .qb-category-card:hover,
    .qb-category-card:focus {
        transform: translateY(-3px);
        box-shadow: 0 10px 26px rgba(15, 23, 42, .12);
        border-color: #1f7a89;
        background: #fff;
        outline: none;
    }

    .qb-category-card:focus-visible {
        outline: 3px solid #1f2937;
        outline-offset: 2px;
    }

    .qb-category-icon {
        font-size: 26px;
        color: #1f7a89;
    }

    .qb-category-name {
        font-weight: 700;
        font-size: 14px;
        color: #1f2937;
        line-height: 1.3;
        word-break: break-word;
    }

    .qb-category-count {
        font-size: 12px;
        color: #64748b;
    }

    .qb-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }

    .qb-product-card {
        display: flex;
        flex-direction: column;
        border: 1px solid #eef1f5;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: box-shadow .2s ease, border-color .2s ease;
    }

    .qb-product-card:hover {
        box-shadow: 0 10px 26px rgba(15, 23, 42, .1);
        border-color: #dfe6ee;
    }

    .qb-product-figure {
        display: block;
        aspect-ratio: 4 / 5;
        overflow: hidden;
        background: #f5f7fa;
    }

    .qb-product-figure img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .qb-product-body {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 12px;
        flex: 1 1 auto;
    }

    .qb-product-title {
        margin: 0;
        font-size: 13.5px;
        font-weight: 600;
        line-height: 1.35;
        color: #1f2937;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.6em;
    }

    .qb-product-title a {
        color: inherit;
    }

    .qb-price {
        font-size: 15px;
        font-weight: 700;
        color: #1f2937;
    }

    .qb-price-old {
        font-size: 12px;
        font-weight: 500;
        color: #64748b;
        text-decoration: line-through;
        margin-right: 6px;
    }

    .qb-size-select {
        width: 100%;
        box-sizing: border-box;
        min-height: 40px;
        padding: 8px 26px 8px 10px;
        font-size: 12.5px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        background-color: #fff;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 6px center;
        background-size: 12px;
    }

    .qb-size-select:focus-visible {
        outline: 3px solid #1f2937;
        outline-offset: 1px;
    }

    .qb-size-select.qb-error {
        border-color: #dc2626;
    }

    .qb-size-error {
        font-size: 11.5px;
        color: #dc2626;
        margin-top: -4px;
    }

    .qb-add-btn {
        margin-top: auto;
        width: 100%;
        min-height: 40px;
        padding: 10px 8px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #18798d 0%, #0f5f6d 100%);
        color: #fff;
        font-weight: 700;
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: .02em;
        cursor: pointer;
        transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease;
    }

    .qb-add-btn:hover:not(:disabled) {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(15, 95, 109, .35);
    }

    .qb-add-btn:focus-visible {
        outline: 3px solid #1f2937;
        outline-offset: 2px;
    }

    .qb-add-btn:disabled {
        cursor: default;
        opacity: .85;
    }

    .qb-add-btn.qb-added {
        background: linear-gradient(135deg, #15803d 0%, #166534 100%);
    }

    .qb-footer {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 24px;
        border-top: 1px solid #eef1f5;
        background: #f8fafc;
    }

    .qb-footer-summary {
        display: flex;
        flex-direction: column;
        gap: 2px;
        font-size: 13px;
        color: #64748b;
    }

    .qb-footer-total {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
    }

    .qb-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 13px 28px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: .02em;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        white-space: nowrap;
    }

    .qb-btn-primary,
    .qb-btn-checkout {
        background: linear-gradient(135deg, #18798d 0%, #0f5f6d 100%);
        color: #fff;
        box-shadow: 0 8px 20px rgba(15, 95, 109, .3);
    }

    .qb-btn-primary:hover,
    .qb-btn-checkout:hover {
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
    }

    .qb-btn:focus-visible {
        outline: 3px solid #1f2937;
        outline-offset: 2px;
    }

    .qb-btn-disabled {
        opacity: .45;
        pointer-events: none;
        box-shadow: none;
    }

    @media (max-width: 767.98px) {
        .qb-overlay {
            padding: 0;
        }

        .qb-dialog {
            max-width: 100%;
            width: 100%;
            height: 100%;
            max-height: 100vh;
            max-height: 100dvh;
            border-radius: 0;
        }

        .qb-header {
            padding: 18px 50px 14px 16px;
        }

        .qb-body {
            padding: 16px;
        }

        .qb-footer {
            padding: 12px 16px;
            flex-wrap: wrap;
        }

        .qb-btn-checkout {
            flex: 1 1 100%;
            order: 2;
        }

        .qb-footer-summary {
            order: 1;
        }
    }

    @media (max-width: 480px) {
        .qb-categories-grid {
            grid-template-columns: repeat(auto-fill, minmax(128px, 1fr));
        }

        .qb-products-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        }

        .qb-product-title {
            font-size: 12.5px;
        }

        .qb-size-select {
            padding: 8px 20px 8px 8px;
            font-size: 11.5px;
            background-position: right 4px center;
            background-size: 10px;
        }
    }
</style>

<script>
    (function () {
        var overlay = document.getElementById('qb-modal');
        if (!overlay) {
            return;
        }

        var trigger = document.getElementById('quick-buy-trigger');
        var stepAuth = document.getElementById('qb-step-auth');
        var stepCategories = document.getElementById('qb-step-categories');
        var stepProducts = document.getElementById('qb-step-products');
        var footer = document.getElementById('qb-footer');
        var closeBtn = document.getElementById('qb-close');
        var backBtn = document.getElementById('qb-back-to-categories');
        var categoriesGrid = document.getElementById('qb-categories-grid');
        var productsGrid = document.getElementById('qb-products-grid');
        var categoryNameEl = document.getElementById('qb-category-name');
        var checkoutBtn = document.getElementById('qb-checkout-btn');
        var cartCountEl = document.getElementById('qb-cart-count');
        var cartTotalEl = document.getElementById('qb-cart-total');

        var dialog = overlay.querySelector('.qb-dialog');
        var stepAuthTitle = document.getElementById('qb-step-auth-title');
        var categoriesTitle = document.getElementById('qb-modal-title-categories');

        var isGuest = {{ auth()->guest() ? 'true' : 'false' }};
        var qbLocale = @json(app()->getLocale());
        var productsRequestToken = 0;

        var qbAddToCartUrl = @json(route('basket.add'));
        var qbCategoriesUrl = @json(route('web.quick-buy.categories'));
        var qbProductsBaseUrl = @json(url('/quick-buy/categories'));
        var qbBasketDataUrl = @json(route('basket.data'));
        var qbQuickBuyStartUrl = @json(route('web.quick-buy.start'));
        var qbCsrfToken = @json(csrf_token());
        var qbNoImage = @json(asset('img/web/farnitur.png'));

        var i18n = {
            currency: @json(__('messages.currency_rub')),
            loading: @json(__('messages.loading')),
            loadingError: @json(__('messages.loading_error')),
            noCategories: @json(__('messages.no_categories_found')),
            noProductsInCategory: @json(__('messages.quick_buy_no_products_in_category')),
            chooseSize: @json(__('messages.choose_size')),
            pleaseSelectSize: @json(__('messages.please_select_size')),
            addToCart: @json(__('messages.add_to_cart')),
            adding: @json(__('messages.quick_buy_adding')),
            added: @json(__('messages.quick_buy_added_short')),
            genericError: @json(__('messages.error_creating_order')),
            networkError: @json(__('messages.network_error_try_again')),
            priceFrom: @json(__('messages.price_from')),
            productsOne: @json(__('messages.quick_buy_products_one')),
            productsFew: @json(__('messages.quick_buy_products_few')),
            productsMany: @json(__('messages.quick_buy_products_many'))
        };

        function escapeHtml(value) {
            return String(value === null || value === undefined ? '' : value).replace(/[&<>"']/g, function (c) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
            });
        }

        function pluralizeRu(count, one, few, many) {
            var n = Math.abs(count) % 100;
            var n1 = n % 10;
            if (n > 10 && n < 20) return many;
            if (n1 === 1) return one;
            if (n1 >= 2 && n1 <= 4) return few;
            return many;
        }

        function pluralizeCount(count, one, few, many) {
            if (qbLocale !== 'ru') {
                return Math.abs(count) === 1 ? one : many;
            }
            return pluralizeRu(count, one, few, many);
        }

        function formatMoney(value) {
            return Number(value || 0).toLocaleString('ru-RU', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
        }

        var toastTimer = null;
        function showToast(message, isError) {
            var toast = document.getElementById('qb-toast');
            if (!toast) return;
            toast.textContent = message;
            toast.classList.toggle('qb-toast-error', !!isError);
            toast.classList.add('is-visible');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(function () {
                toast.classList.remove('is-visible');
            }, 2500);
        }

        function lockScroll(lock) {
            document.body.style.overflow = lock ? 'hidden' : '';
        }

        function showStep(step) {
            [stepAuth, stepCategories, stepProducts].forEach(function (el) {
                if (el) el.hidden = (el !== step);
            });
        }

        function focusEl(el) {
            if (el && typeof el.focus === 'function') {
                el.focus();
            }
        }

        function getFocusable(container) {
            if (!container) return [];
            var selector = 'a[href], button:not([disabled]), select:not([disabled]), input:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';
            return Array.prototype.slice.call(container.querySelectorAll(selector)).filter(function (el) {
                return !el.closest('[hidden]');
            });
        }

        var lastFocusedBeforeOpen = null;

        function refreshCartSummary() {
            return fetch(qbBasketDataUrl, { headers: { 'Accept': 'application/json' } })
                .then(function (response) { return response.json(); })
                .then(function (data) {
                    var count = data.count || 0;
                    if (cartCountEl) cartCountEl.textContent = count;
                    if (cartTotalEl) cartTotalEl.textContent = formatMoney(data.total) + ' ' + i18n.currency;
                    if (checkoutBtn) {
                        checkoutBtn.classList.toggle('qb-btn-disabled', !count);
                        if (count) {
                            checkoutBtn.removeAttribute('aria-disabled');
                        } else {
                            checkoutBtn.setAttribute('aria-disabled', 'true');
                        }
                    }
                })
                .catch(function () {});
        }

        function openModal() {
            lastFocusedBeforeOpen = document.activeElement;
            overlay.classList.add('is-open');
            lockScroll(true);

            if (isGuest) {
                showStep(stepAuth);
                if (footer) footer.hidden = true;
                focusEl(stepAuthTitle);
                return;
            }

            if (footer) footer.hidden = false;
            showStep(stepCategories);
            focusEl(categoriesTitle);
            refreshCartSummary();
            // Re-fetch every time the modal is (re)opened so category tiles never show stale
            // names/counts from an earlier point in a long-lived tab session.
            loadCategories();
        }

        function closeModal() {
            overlay.classList.remove('is-open');
            lockScroll(false);
            if (lastFocusedBeforeOpen && document.body.contains(lastFocusedBeforeOpen)) {
                focusEl(lastFocusedBeforeOpen);
            } else {
                focusEl(trigger);
            }
            lastFocusedBeforeOpen = null;
        }

        window.openQuickBuyModal = openModal;

        if (trigger) {
            trigger.addEventListener('click', function (e) {
                if (isGuest) {
                    return;
                }
                e.preventDefault();
                openModal();
            });
        }

        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (!overlay.classList.contains('is-open')) return;

            if (e.key === 'Escape') {
                closeModal();
                return;
            }

            if (e.key === 'Tab') {
                var focusable = getFocusable(dialog);
                if (!focusable.length) return;
                var first = focusable[0];
                var last = focusable[focusable.length - 1];

                if (e.shiftKey && document.activeElement === first) {
                    e.preventDefault();
                    focusEl(last);
                } else if (!e.shiftKey && document.activeElement === last) {
                    e.preventDefault();
                    focusEl(first);
                } else if (!dialog.contains(document.activeElement)) {
                    // Focus somehow ended up outside the dialog (e.g. programmatic focus
                    // elsewhere) - pull it back in rather than letting Tab escape to the page.
                    e.preventDefault();
                    focusEl(first);
                }
            }
        });

        if (backBtn) {
            backBtn.addEventListener('click', function () {
                showStep(stepCategories);
                focusEl(categoriesTitle);
            });
        }

        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function (e) {
                if (checkoutBtn.classList.contains('qb-btn-disabled')) {
                    e.preventDefault();
                }
            });
        }

        function renderCategoryCard(category) {
            var count = category.products_count || 0;
            var word = pluralizeCount(count, i18n.productsOne, i18n.productsFew, i18n.productsMany);
            return '' +
                '<button type="button" class="qb-category-card" data-category-id="' + category.id + '" data-category-name="' + escapeHtml(category.name) + '">' +
                    '<span class="qb-category-icon mdi mdi-shape-outline" aria-hidden="true"></span>' +
                    '<span class="qb-category-name">' + escapeHtml(category.name) + '</span>' +
                    '<span class="qb-category-count">' + count + ' ' + escapeHtml(word) + '</span>' +
                '</button>';
        }

        function loadCategories() {
            categoriesGrid.innerHTML = '<div class="qb-loading">' + escapeHtml(i18n.loading) + '</div>';

            fetch(qbCategoriesUrl, { headers: { 'Accept': 'application/json' } })
                .then(function (response) {
                    if (!response.ok) throw new Error('bad-status');
                    return response.json();
                })
                .then(function (categories) {
                    if (!Array.isArray(categories) || categories.length === 0) {
                        categoriesGrid.innerHTML = '<div class="qb-empty">' + escapeHtml(i18n.noCategories) + '</div>';
                        return;
                    }
                    categoriesGrid.innerHTML = categories.map(renderCategoryCard).join('');
                })
                .catch(function () {
                    categoriesGrid.innerHTML = '<div class="qb-empty qb-error-text">' + escapeHtml(i18n.loadingError) + '</div>';
                });
        }

        if (categoriesGrid) {
            categoriesGrid.addEventListener('click', function (e) {
                var card = e.target.closest('.qb-category-card');
                if (!card) return;
                loadProducts(card.getAttribute('data-category-id'), card.getAttribute('data-category-name'));
            });
        }

        function renderProductCard(product) {
            var priceHtml;
            if (product.has_sizes && product.sizes && product.sizes.length) {
                if (product.sizes.length > 1) {
                    priceHtml = '<div class="qb-price" data-role="price">' + escapeHtml(i18n.priceFrom) + ' <span class="qb-price-value">' + escapeHtml(product.min_price) + '</span> ' + escapeHtml(i18n.currency) + '</div>';
                } else {
                    priceHtml = '<div class="qb-price" data-role="price"><span class="qb-price-value">' + escapeHtml(product.sizes[0].formatted_price) + '</span> ' + escapeHtml(i18n.currency) + '</div>';
                }
            } else {
                var oldPriceHtml = product.old_price ? ('<span class="qb-price-old">' + escapeHtml(product.old_price) + ' ' + escapeHtml(i18n.currency) + '</span>') : '';
                priceHtml = '<div class="qb-price" data-role="price">' + oldPriceHtml + '<span class="qb-price-value">' + escapeHtml(product.price) + '</span> ' + escapeHtml(i18n.currency) + '</div>';
            }

            var errorId = 'qb-size-error-' + product.id;
            var sizeSelectHtml = '';
            if (product.has_sizes && product.sizes && product.sizes.length) {
                var options = '<option value="">' + escapeHtml(i18n.chooseSize) + '</option>' + product.sizes.map(function (size) {
                    return '<option value="' + size.id + '" data-formatted-price="' + escapeHtml(size.formatted_price) + '">' + escapeHtml(size.label) + ' — ' + escapeHtml(size.formatted_price) + ' ' + escapeHtml(i18n.currency) + '</option>';
                }).join('');
                sizeSelectHtml = '' +
                    '<select class="qb-size-select" aria-label="' + escapeHtml(i18n.chooseSize + ': ' + product.name) + '" aria-describedby="' + errorId + '" aria-invalid="false">' + options + '</select>' +
                    '<div class="qb-size-error" id="' + errorId + '" role="alert" hidden>' + escapeHtml(i18n.pleaseSelectSize) + '</div>';
            }

            var imageUrl = product.image ? product.image : qbNoImage;
            var fallbackImage = qbNoImage.replace(/'/g, '&#39;');

            return '' +
                '<article class="qb-product-card" data-product-id="' + product.id + '" data-has-sizes="' + (product.has_sizes ? '1' : '0') + '">' +
                    '<a class="qb-product-figure" href="' + escapeHtml(product.url) + '" target="_blank" rel="noopener">' +
                        '<img src="' + escapeHtml(imageUrl) + '" alt="' + escapeHtml(product.name) + '" loading="lazy" onerror="this.onerror=null;this.src=\'' + fallbackImage + '\';">' +
                    '</a>' +
                    '<div class="qb-product-body">' +
                        '<h4 class="qb-product-title"><a href="' + escapeHtml(product.url) + '" target="_blank" rel="noopener">' + escapeHtml(product.name) + '</a></h4>' +
                        priceHtml +
                        sizeSelectHtml +
                        '<button type="button" class="qb-add-btn" aria-label="' + escapeHtml(i18n.addToCart + ': ' + product.name) + '">' + escapeHtml(i18n.addToCart) + '</button>' +
                    '</div>' +
                '</article>';
        }

        function updateCardPriceFromSize(select) {
            var card = select.closest('.qb-product-card');
            if (!card) return;
            var priceEl = card.querySelector('[data-role="price"]');
            var opt = select.options[select.selectedIndex];
            if (!priceEl || !opt || !opt.value) return;
            var formattedPrice = opt.getAttribute('data-formatted-price');
            if (formattedPrice) {
                priceEl.innerHTML = '<span class="qb-price-value">' + escapeHtml(formattedPrice) + '</span> ' + escapeHtml(i18n.currency);
            }
        }

        function autoSelectSoleSizes(container) {
            var selects = container.querySelectorAll('.qb-size-select');
            selects.forEach(function (select) {
                if (select.options.length === 2) {
                    select.selectedIndex = 1;
                    updateCardPriceFromSize(select);
                }
            });
        }

        function loadProducts(categoryId, categoryName) {
            if (!categoryId) return;
            showStep(stepProducts);
            focusEl(categoryNameEl);
            if (categoryNameEl) categoryNameEl.textContent = categoryName || '';
            productsGrid.innerHTML = '<div class="qb-loading">' + escapeHtml(i18n.loading) + '</div>';
            productsGrid.scrollTop = 0;

            var requestToken = ++productsRequestToken;

            fetch(qbProductsBaseUrl + '/' + encodeURIComponent(categoryId) + '/products', { headers: { 'Accept': 'application/json' } })
                .then(function (response) {
                    if (!response.ok) throw new Error('bad-status');
                    return response.json();
                })
                .then(function (payload) {
                    // A newer loadProducts() call has started since this fetch was sent (e.g. the
                    // user went back and opened a different category before this one resolved) -
                    // drop this now-stale response instead of overwriting the newer one.
                    if (requestToken !== productsRequestToken) return;

                    var products = (payload && payload.products) || [];
                    if (payload && payload.category && payload.category.name && categoryNameEl) {
                        categoryNameEl.textContent = payload.category.name;
                    }
                    if (!products.length) {
                        productsGrid.innerHTML = '<div class="qb-empty">' + escapeHtml(i18n.noProductsInCategory) + '</div>';
                        return;
                    }
                    productsGrid.innerHTML = products.map(renderProductCard).join('');
                    autoSelectSoleSizes(productsGrid);
                })
                .catch(function () {
                    if (requestToken !== productsRequestToken) return;
                    productsGrid.innerHTML = '<div class="qb-empty qb-error-text">' + escapeHtml(i18n.loadingError) + '</div>';
                });
        }

        if (productsGrid) {
            productsGrid.addEventListener('change', function (e) {
                if (!e.target.classList.contains('qb-size-select')) return;
                var card = e.target.closest('.qb-product-card');
                var errorEl = card ? card.querySelector('.qb-size-error') : null;
                if (errorEl) errorEl.hidden = true;
                e.target.classList.remove('qb-error');
                e.target.setAttribute('aria-invalid', 'false');
                updateCardPriceFromSize(e.target);
            });

            productsGrid.addEventListener('click', function (e) {
                var btn = e.target.closest('.qb-add-btn');
                if (!btn) return;

                var card = btn.closest('.qb-product-card');
                if (!card) return;

                var productId = card.getAttribute('data-product-id');
                var hasSizes = card.getAttribute('data-has-sizes') === '1';
                var sizeSelect = card.querySelector('.qb-size-select');
                var sizeError = card.querySelector('.qb-size-error');
                var sizeId = null;

                if (hasSizes) {
                    sizeId = sizeSelect ? sizeSelect.value : '';
                    if (!sizeId) {
                        if (sizeError) sizeError.hidden = false;
                        if (sizeSelect) {
                            sizeSelect.classList.add('qb-error');
                            sizeSelect.setAttribute('aria-invalid', 'true');
                            sizeSelect.focus();
                        }
                        return;
                    }
                }

                if (sizeError) sizeError.hidden = true;
                if (sizeSelect) {
                    sizeSelect.classList.remove('qb-error');
                    sizeSelect.setAttribute('aria-invalid', 'false');
                }

                addToCart(productId, sizeId, btn);
            });
        }

        function addToCart(productId, sizeId, btnEl) {
            if (btnEl.disabled) return;

            btnEl.disabled = true;
            var originalText = btnEl.textContent;
            btnEl.textContent = i18n.adding;

            var formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1);
            if (sizeId) formData.append('size_id', sizeId);
            formData.append('_token', qbCsrfToken);

            fetch(qbAddToCartUrl, {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            })
                .then(function (response) {
                    return response.json()
                        .catch(function () { return null; })
                        .then(function (data) { return { ok: response.ok, status: response.status, data: data }; });
                })
                .then(function (result) {
                    if (result.status === 401) {
                        window.location.href = qbQuickBuyStartUrl;
                        return;
                    }

                    if (!result.ok || !result.data || result.data.success === false) {
                        btnEl.disabled = false;
                        btnEl.textContent = originalText;
                        showToast((result.data && result.data.message) ? result.data.message : i18n.genericError, true);
                        return;
                    }

                    btnEl.textContent = i18n.added;
                    btnEl.classList.add('qb-added');
                    setTimeout(function () {
                        btnEl.classList.remove('qb-added');
                        btnEl.textContent = originalText;
                        btnEl.disabled = false;
                    }, 1500);

                    refreshCartSummary();
                    document.dispatchEvent(new CustomEvent('cart:updated'));
                })
                .catch(function () {
                    btnEl.disabled = false;
                    btnEl.textContent = originalText;
                    showToast(i18n.networkError, true);
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            try {
                var params = new URLSearchParams(window.location.search);
                if (params.get('quickbuy') === '1' && !isGuest) {
                    openModal();
                    params.delete('quickbuy');
                    var qs = params.toString();
                    var newUrl = window.location.pathname + (qs ? ('?' + qs) : '') + window.location.hash;
                    window.history.replaceState(null, '', newUrl);
                }
            } catch (e) {}
        });
    })();
</script>
