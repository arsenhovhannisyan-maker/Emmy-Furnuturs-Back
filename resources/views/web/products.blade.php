<style>
    /* Product Modern Layout Fix */
    .product-modern {
        position: relative;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }

    .product-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.12);
    }

    .unit.unit-spacing-0 {
        display: flex;
        flex-direction: column;
    }

    @media (min-width: 576px) {
        .unit.unit-spacing-0 {
            flex-direction: row;
        }
    }

    .unit-left {
        flex: 0 0 auto;
        width: 100%;
    }

    @media (min-width: 576px) {
        .unit-left {
            width: 40%;
            max-width: 300px;
        }
    }

    .product-modern-figure {
        display: block;
        position: relative;
        overflow: hidden;
        border-radius: 12px 12px 0 0;
    }

    @media (min-width: 576px) {
        .product-modern-figure {
            border-radius: 12px 0 0 12px;
        }
    }

    .product-modern-figure img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    @media (min-width: 576px) {
        .product-modern-figure img {
            height: 200px;
        }
    }

    .product-modern-figure:hover img {
        transform: scale(1.05);
    }

    .unit-body {
        flex: 1;
        padding: 25px;
        display: flex;
        flex-direction: column;
    }

    .product-modern-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-modern-title {
        margin-bottom: 12px;
        font-size: 20px;
        font-weight: 600;
        line-height: 1.3;
    }

    .product-modern-title a {
        color: #2c3e50;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-modern-title a:hover {
        color: #007bff;
    }

    .product-price-wrap {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .product-price {
        font-size: 22px;
        font-weight: 700;
        color: #e74c3c;
    }

    .product-price-old {
        font-size: 16px;
        color: #95a5a6;
        text-decoration: line-through;
        font-weight: 500;
    }

    .product-modern-text {
        flex: 1;
        color: #555;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .product-modern form {
        margin-top: auto;
    }

    .button.button-primary.button-zakaria {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
    }

    .button.button-primary.button-zakaria:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    /* Product Badge */
    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #e74c3c;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
    }

    /* Loading State */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Empty State */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
        background: #f8f9fa;
        border-radius: 12px;
        margin: 20px 0;
    }

    .empty-state .icon {
        font-size: 64px;
        color: #bdc3c7;
        margin-bottom: 20px;
        display: block;
    }

    /* Filter Section */
    .aside {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06);
        margin-bottom: 30px;
    }

    .aside-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #2c3e50;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 10px;
    }

    /* Price Range */
    .ch-range-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .ch-range-form-wrap {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ch-range-input {
        width: 80px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-align: center;
    }

    /* Categories Filter */
    .list-shop-filter {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
    }

    .list-shop-filter li {
        padding: 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .list-shop-filter li:last-child {
        border-bottom: none;
    }

    .list-shop-filter__label {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        margin: 0;
        padding: 10px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
    }

    .list-shop-filter__label:hover {
        background: #f0f7ff;
    }

    .list-shop-filter__label:has(.category-filter:checked) {
        background: #e3f2fd;
        box-shadow: inset 0 0 0 2px #50becf;
        color: #0d6efd;
        font-weight: 600;
    }

    .list-shop-filter__text {
        flex: 1;
        line-height: 1.4;
    }

    /* Search Form */
    .ch-search {
        margin-top: 20px;
    }

    /* Product Top Panel */
    .product-top-panel {
        background: #fff;
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .product-top-panel-title {
        margin: 0;
        color: #2c3e50;
        font-weight: 500;
    }

    .product-view-toggle {
        display: flex;
        gap: 10px;
    }

    .product-view-link {
        font-size: 20px;
        color: #bdc3c7;
        text-decoration: none;
        transition: color 0.3s ease;
        padding: 8px;
        border-radius: 4px;
        background: #f8f9fa;
    }

    .product-view-link.active,
    .product-view-link:hover {
        color: #007bff;
        background: #e3f2fd;
    }

    button.product-view-link {
        border: none;
        cursor: pointer;
        line-height: 1;
    }

    #products-container.products-layout--grid .product-modern .unit {
        flex-direction: column !important;
    }

    #products-container.products-layout--grid .product-modern .unit-left {
        width: 100% !important;
        max-width: none !important;
    }

    #products-container.products-layout--grid .product-modern-figure {
        border-radius: 12px 12px 0 0 !important;
    }

    #products-container.products-layout--grid .product-modern-figure img {
        height: 200px;
    }

    #products-container.products-layout--grid .product-modern-body {
        text-align: center;
    }

    #products-container.products-layout--grid .product-modern-title {
        font-size: 17px;
    }

    #products-container.products-layout--grid .product-modern-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 0;
        margin-bottom: 12px;
    }

    #products-container.products-layout--grid .product-modern form {
        width: 100%;
    }

    @media (min-width: 576px) {
        #products-container.products-layout--grid .product-modern-body {
            text-align: left;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .product-modern-figure img {
            height: 220px;
        }

        .unit-body {
            padding: 20px;
        }
    }

    @media (max-width: 767px) {
        .product-top-panel {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-modern-figure img {
            height: 200px;
        }

        .unit-body {
            padding: 15px;
        }
    }

    @media (max-width: 575px) {
        .product-modern-figure img {
            height: 180px;
        }

        .product-modern-title {
            font-size: 18px;
        }

        .product-price {
            font-size: 20px;
        }

        .product-modern-text {
            font-size: 13px;
        }
    }

    .breadcrumbs-custom-path {
        color: #7f8c8d;
    }

    .breadcrumbs-custom-path a {
        color: #3498db;
        text-decoration: none;
    }

    .breadcrumbs-custom-path .active {
        color: #2c3e50;
    }

    /* Section Background */
    .section-md.bg-primary-2 {
        background: #f8f9fa !important;
    }
</style>

<x-web-layout
    :seo-title="__('messages.shop_list') . ' | ' . __('messages.seo_brand_suffix')"
    :seo-description="__('messages.seo_shop_catalog_description')"
    :seo-keywords="__('messages.seo_shop_keywords')"
>
    <div class="page">
        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.shop_list')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ url('/') }}">@lang('messages.home')</a></li>
                        <li><a href="{{ route('web.shop') }}">@lang('messages.shop')</a></li>
                        <li class="active">@lang('messages.shop_list')</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Section Shop-->
        <section class="section section-md bg-primary-2 text-md-left">
            <div class="container">
                <div class="row row-50">
                    <div class="col-lg-4 col-xl-3">
                        <div class="aside row row-30 row-md-50 justify-content-md-between">
                            <div class="aside-item col-12">
                                <h6 class="aside-title">@lang('messages.filter_by_price')</h6>
                                <!-- RD Range-->
                                <div class="ch-range"
                                     data-min="0"
                                     data-max="50000"
                                     data-min-diff="100"
                                     data-start="[0, 50000]"
                                     data-step="1"
                                     data-tooltip="false"
                                     data-input=".ch-range-input-value-1"
                                     data-input-2=".ch-range-input-value-2"></div>

                                <div class="group-xs group-justify">
                                    <div>
                                        <button id="filter-btn" class="button button-sm button-secondary button-zakaria" type="button">
                                            @lang('messages.filter')
                                        </button>
                                    </div>
                                    <div>
                                        <div class="ch-range-wrap">
                                            <div class="ch-range-title">@lang('messages.price'):</div>
                                            <div class="ch-range-form-wrap">
                                                <input id="min_price" class="ch-range-input ch-range-input-value-1" type="text" name="min_price">
                                                <span>руб.</span>
                                        
                                            </div>
                                            <div class="ch-range-divider"></div>
                                            <div class="ch-range-form-wrap">
                                                <input id="max_price" class="ch-range-input ch-range-input-value-2" type="text" name="max_price">
                                                <span>руб.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="aside-item col-sm-6 col-md-5 col-lg-12">
                                <h6 class="aside-title">@lang('messages.categories')</h6>
                                <ul class="list-shop-filter" id="categories-filter">
                                    <!-- Все категории -->
                                    <li class="list-shop-filter__item">
                                        <label class="list-shop-filter__label">
                                            <input type="checkbox" name="categories[]" value="all" id="category-all"
                                                   checked class="category-filter">
                                            <span class="list-shop-filter__text">@lang('messages.all_categories')</span>
                                        </label>
                                    </li>

                                    <!-- Динамические категории -->
                                    @if(!empty($categories) && (is_array($categories) || $categories instanceof \Illuminate\Support\Collection))
                                        @foreach($categories as $category)
                                            @php
                                                $categoryId = '';
                                                $categoryName = 'Unnamed Category';

                                                if (is_array($category)) {
                                                    $categoryId = $category['id'] ?? '';
                                                    $categoryName = $category['name'] ?? 'Unnamed Category';
                                                } elseif (is_object($category)) {
                                                    $categoryId = $category->id ?? '';
                                                    $categoryName = $category->name ?? 'Unnamed Category';
                                                }
                                            @endphp

                                            @if(!empty($categoryId))
                                                <li class="list-shop-filter__item">
                                                    <label class="list-shop-filter__label">
                                                        <input type="checkbox" name="categories[]" value="{{ $categoryId }}"
                                                               id="category-{{ $categoryId }}" class="category-filter">
                                                        <span class="list-shop-filter__text">{{ $categoryName }}</span>
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li class="text-muted">@lang('messages.no_categories_found')</li>
                                    @endif
                                </ul>

                            </div>                        </div>
                    </div>

                    <div class="col-lg-8 col-xl-9">
                        <div class="product-top-panel group-md">
                            <p class="product-top-panel-title" id="results-text">
                                @if(isset($products) && $products->count() > 0)
                                    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        @lang('messages.showing_results', [
                                            'start' => $products->firstItem(),
                                            'end' => $products->lastItem(),
                                            'total' => $products->total()
                                        ])
                                    @else
                                        @lang('messages.showing_results', [
                                            'start' => 1,
                                            'end' => $products->count(),
                                            'total' => $products->count()
                                        ])
                                    @endif
                                @else
                                    @lang('messages.showing_no_results')
                                @endif
                            </p>
                            <div>
                                <div class="group-sm group-middle">
                                    <div class="product-view-toggle" role="group" aria-label="{{ __('messages.products_view_grid') }} / {{ __('messages.products_view_list') }}">
                                        <button type="button" class="mdi mdi-apps product-view-link product-view-grid" title="{{ __('messages.products_view_grid') }}" aria-pressed="false"></button>
                                        <button type="button" class="mdi mdi-format-list-bulleted product-view-link product-view-list active" title="{{ __('messages.products_view_list') }}" aria-pressed="true"></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="products-container" class="row row-30 row-md-50 row-lg-60 products-layout products-layout--list">
                            @if(isset($products) && $products->count() > 0)
                                @foreach($products as $product)
                                    <div class="product-col col-12">
                                        <!-- Product-->
                                        <article class="product-modern text-center text-sm-left">
                                            <div class="unit unit-spacing-0 flex-column flex-sm-row">
                                                <div class="unit-left">
                                                    <a class="product-modern-figure" href="{{ route('web.product', $product->id) }}">
                                                        <img src="{{ $product->photo1->file_url ?? asset('images/shop/product-placeholder.png') }}"
                                                             alt="{{ $product->name }}" width="328" height="330"/>
                                                    </a>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="product-modern-body">
                                                        <h4 class="product-modern-title">
                                                            <a href="{{ route('web.product', $product->id) }}">{{ $product->name }}</a>
                                                        </h4>
                                                        <div class="product-price-wrap">
                                                            @if($product->old_price && $product->old_price > $product->price)
                                                                <div class="product-price product-price-old">{{ number_format($product->old_price, 2) }} @lang('messages.currency_rub')</div>
                                                            @endif
                                                            <div class="product-price">{{ number_format($product->price, 2) }} @lang('messages.currency_rub')</div>
                                                        </div>
                                                        <p class="product-modern-text">{{ Str::limit($product->description, 100) }}</p>
                                                        <form action="{{ route('basket.add') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button class="button button-primary button-zakaria" type="submit">@lang('messages.add_to_cart')</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($product->old_price && $product->old_price > $product->price)
                                                @php
                                                    $discountPercent = round((($product->old_price - $product->price) / $product->old_price) * 100);
                                                @endphp
                                                <span class="product-badge product-badge-sale">-{{ $discountPercent }}%</span>
                                            @endif
                                        </article>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12 text-center">
                                    <div class="empty-state py-5">
                                        <i class="icon mdi mdi-package-variant" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                                        <p class="text-muted" style="font-size: 18px;">@lang('messages.no_products_found')</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(isset($products) && $products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
                            <div class="mt-5" id="products-pagination">
                                {{ $products->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        @else
                            <div class="mt-5" id="products-pagination"></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Our brand-->
        @include('web.components.our-brand')
        @include('SEO.shop-seo')

    </div>
</x-web-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButton = document.querySelector('#filter-btn');
        const minInput = document.querySelector('#min_price');
        const maxInput = document.querySelector('#max_price');
        const productsContainer = document.querySelector('#products-container');
        const resultsText = document.querySelector('#results-text');
        const categoryAll = document.querySelector('#category-all');
        const categoryCheckboxes = document.querySelectorAll('.category-filter');
        const browseUrl = "{{ route('web.shop.products') }}";
        @php
            $productRouteTemplate = preg_replace('#/\d+$#', '/__ID__', route('web.product', ['id' => 1]));
        @endphp
        const productUrlTemplate = "{{ $productRouteTemplate }}";
        const currencyLabel = " @lang('messages.currency_rub')";
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
        const layoutStorageKey = 'shopProductsView';

        if (!productsContainer) return;

        let currentView = sessionStorage.getItem(layoutStorageKey) === 'grid' ? 'grid' : 'list';

        function getProductColClass() {
            return currentView === 'grid'
                ? 'product-col col-12 col-sm-6 col-lg-4'
                : 'product-col col-12';
        }

        function applyLayoutToContainer() {
            productsContainer.classList.remove('products-layout--list', 'products-layout--grid');
            productsContainer.classList.add('products-layout', currentView === 'grid' ? 'products-layout--grid' : 'products-layout--list');
            productsContainer.querySelectorAll('.product-col').forEach(function (col) {
                col.className = getProductColClass();
            });
        }

        function setViewToggleUI() {
            const gridBtn = document.querySelector('.product-view-grid');
            const listBtn = document.querySelector('.product-view-list');
            if (!gridBtn || !listBtn) return;
            if (currentView === 'grid') {
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
                gridBtn.setAttribute('aria-pressed', 'true');
                listBtn.setAttribute('aria-pressed', 'false');
            } else {
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
                listBtn.setAttribute('aria-pressed', 'true');
                gridBtn.setAttribute('aria-pressed', 'false');
            }
        }

        (function initLayoutToggle() {
            const gridBtn = document.querySelector('.product-view-grid');
            const listBtn = document.querySelector('.product-view-list');
            setViewToggleUI();
            applyLayoutToContainer();
            if (gridBtn) {
                gridBtn.addEventListener('click', function () {
                    if (currentView === 'grid') return;
                    currentView = 'grid';
                    sessionStorage.setItem(layoutStorageKey, 'grid');
                    setViewToggleUI();
                    applyLayoutToContainer();
                });
            }
            if (listBtn) {
                listBtn.addEventListener('click', function () {
                    if (currentView === 'list') return;
                    currentView = 'list';
                    sessionStorage.setItem(layoutStorageKey, 'list');
                    setViewToggleUI();
                    applyLayoutToContainer();
                });
            }
        })();

        // Обработчик изменения категорий
        if (categoryCheckboxes.length > 0) {
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function(e) {
                    handleCategoryChange(e.target);
                });
            });
        }

        function handleCategoryChange(clickedCheckbox) {
            const isAllCategory = clickedCheckbox.id === 'category-all';

            if (isAllCategory && clickedCheckbox.checked) {
                document.querySelectorAll('.category-filter:not(#category-all)').forEach(cb => {
                    cb.checked = false;
                });
            } else if (!isAllCategory && clickedCheckbox.checked && categoryAll) {
                categoryAll.checked = false;
            }

            applyFilters();
        }

        function normalizePriceInput(value, fallback) {
            if (value === null || value === undefined || value === '') {
                return fallback;
            }

            const normalized = String(value)
                .replace(/[^\d.,]/g, '')
                .replace(',', '.');
            const parsed = Number.parseFloat(normalized);

            if (!Number.isFinite(parsed) || parsed < 0) {
                return fallback;
            }

            return String(Math.floor(parsed));
        }

        function buildBrowseQueryUrl(page) {
            let min = normalizePriceInput(minInput?.value, '0');
            let max = normalizePriceInput(maxInput?.value, '999999');
            if (Number(min) > Number(max)) {
                [min, max] = [max, min];
            }

            if (minInput) minInput.value = min;
            if (maxInput) maxInput.value = max;

            const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked'))
                .filter(cb => cb.value !== 'all')
                .map(cb => cb.value);

            const params = new URLSearchParams();
            params.set('min_price', min);
            params.set('max_price', max);
            if (selectedCategories.length > 0) {
                params.set('category_ids', selectedCategories.join(','));
            }
            if (page && page > 1) {
                params.set('page', String(page));
            }
            return `${browseUrl}?${params.toString()}`;
        }

        async function fetchBrowse(url) {
            productsContainer.classList.add('loading');
            productsContainer.innerHTML = '<div class="col-12 text-center"><p>@lang('messages.loading')</p></div>';

            try {
                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('HTTP ' + response.status);
                }

                const data = await response.json();
                renderProducts(data.products || [], data.pagination, { total: data.total, from: data.from, to: data.to });
            } catch (err) {
                console.error('Error fetching products:', err);
                showError('@lang('messages.loading_error')');
            } finally {
                productsContainer.classList.remove('loading');
            }
        }

        async function applyFilters() {
            await fetchBrowse(buildBrowseQueryUrl(1));
        }

        if (filterButton) {
            filterButton.addEventListener('click', applyFilters);
        }

        const productsPaginationEl = document.getElementById('products-pagination');
        if (productsPaginationEl) {
            productsPaginationEl.addEventListener('click', function (e) {
                const anchor = e.target.closest('a.page-link');
                if (!anchor || !anchor.getAttribute('href')) return;
                e.preventDefault();
                fetchBrowse(anchor.href);
            });
        }

        function renderProducts(products, paginationHtml, meta) {
            productsContainer.innerHTML = '';

            const paginationEl = document.getElementById('products-pagination');
            if (paginationEl) paginationEl.innerHTML = paginationHtml || '';

            if (!Array.isArray(products) || products.length === 0) {
                productsContainer.innerHTML = `
                    <div class="col-12 text-center">
                        <div class="empty-state py-5">
                            <i class="icon mdi mdi-package-variant" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                            <p class="text-muted" style="font-size: 18px;">@lang('messages.no_products_found')</p>
                        </div>
                    </div>
                `;
                if (resultsText) resultsText.textContent = '@lang('messages.showing_no_results')';
                return;
            }

            if (resultsText && meta && meta.total != null) {
                const start = meta.from != null ? meta.from : 1;
                const end = meta.to != null ? meta.to : products.length;
                const total = meta.total;
                resultsText.textContent = '@lang('messages.showing_results', ['start' => '__START__', 'end' => '__END__', 'total' => '__TOTAL__'])'
                    .replace('__START__', start).replace('__END__', end).replace('__TOTAL__', total);
            } else if (resultsText) {
                resultsText.textContent = `Showing ${products.length} product(s)`;
            }

            const escapeHtml = (unsafe) => {
                if (unsafe === null || unsafe === undefined) return '';
                return String(unsafe)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            };

            const truncate = (text, length) => text?.length > length ? text.substring(0, length) + '…' : text || '';

            products.forEach(product => {
                const hasDiscount = product.old_price && product.old_price > product.price;
                const discountPercent = hasDiscount
                    ? Math.round(((product.old_price - product.price) / product.old_price) * 100)
                    : 0;

                const oldPriceHtml = hasDiscount
                    ? `<div class="product-price product-price-old">${Number(product.old_price).toFixed(2)}${currencyLabel}</div>`
                    : '';

                const priceHtml = `<div class="product-price">${Number(product.price).toFixed(2)}${currencyLabel}</div>`;
                const photoUrl = product.photo1?.file_url || '{{ asset("images/shop/product-placeholder.png") }}';
                const productUrl = productUrlTemplate.replace('__ID__', String(product.id));

                const formHtml = `
                    <form action="{{ route('basket.add') }}" method="POST">
                        <input type="hidden" name="_token" value="${escapeHtml(csrfToken)}">
                        <input type="hidden" name="product_id" value="${escapeHtml(product.id)}">
                        <input type="hidden" name="quantity" value="1">
                        <button class="button button-primary button-zakaria" type="submit">@lang('messages.add_to_cart')</button>
                    </form>
                `;

                const discountBadge = hasDiscount
                    ? `<span class="product-badge product-badge-sale">-${discountPercent}%</span>`
                    : '';

                const productHtml = `
                    <div class="${getProductColClass()}">
                        <article class="product-modern text-center text-sm-left">
                            <div class="unit unit-spacing-0 flex-column flex-sm-row">
                                <div class="unit-left">
                                    <a class="product-modern-figure" href="${productUrl}">
                                        <img src="${escapeHtml(photoUrl)}" alt="${escapeHtml(product.name)}" width="328" height="330"/>
                                    </a>
                                </div>
                                <div class="unit-body">
                                    <div class="product-modern-body">
                                        <h4 class="product-modern-title">
                                            <a href="${productUrl}">${escapeHtml(product.name)}</a>
                                        </h4>
                                        <div class="product-price-wrap">
                                            ${oldPriceHtml}
                                            ${priceHtml}
                                        </div>
                                        <p class="product-modern-text">${escapeHtml(truncate(product.description, 100))}</p>
                                        ${formHtml}
                                    </div>
                                </div>
                            </div>
                            ${discountBadge}
                        </article>
                    </div>
                `;

                productsContainer.insertAdjacentHTML('beforeend', productHtml);
            });
        }

        function showError(message) {
            productsContainer.innerHTML = `
                <div class="col-12 text-center">
                    <div class="empty-state py-5">
                        <i class="icon mdi mdi-alert-circle-outline" style="font-size: 64px; color: #ff6b6b; margin-bottom: 20px;"></i>
                        <p class="text-muted" style="font-size: 18px;">${message}</p>
                    </div>
                </div>
            `;
            if (resultsText) resultsText.textContent = '@lang('messages.showing_no_results')';
        }
    });
</script>
