<style>
    .carousel-parent {
        margin-bottom: 20px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .slick-product-figure {
        border-radius: 12px;
        overflow: hidden;
    }

    .carousel-parent img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        transition: transform 0.5s ease;
        cursor: zoom-in;
    }

    .carousel-parent img:hover {
        transform: scale(1.02);
    }

    .child-carousel {
        display: flex !important;
        justify-content: flex-start;
        gap: 12px;
        margin-top: 15px;
        flex-wrap: nowrap;
        padding: 5px 0;
    }

    .child-carousel .item {
        flex: 0 0 auto;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .child-carousel .thumbnail {
        width: 100px;
        height: 100px;
        object-fit: cover;
        cursor: zoom-in;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        border-radius: 6px;
    }

    .child-carousel .thumbnail:hover {
        border-color: #007bff;
        transform: translateY(-2px);
    }

    .child-carousel .thumbnail.slick-current {
        border-color: #007bff;
        opacity: 1;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    #child-carousel .slick-track {
        display: flex !important;
        gap: 12px;
    }

    .slick-prev,
    .slick-next {
        font-size: 0 !important;
        background: rgba(255, 255, 255, 0.9) !important;
        border: none !important;
        outline: none !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1;
        transition: all 0.3s ease;
    }

    .slick-prev:hover,
    .slick-next:hover {
        background: white !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .slick-prev {
        left: 15px !important;
    }

    .slick-next {
        right: 15px !important;
    }

    .slick-prev:before,
    .slick-next:before {
        color: #333 !important;
        opacity: 0.8 !important;
        font-size: 20px !important;
        line-height: 1;
    }

    .slick-prev:before {
        content: "←" !important;
    }

    .slick-next:before {
        content: "→" !important;
    }

    .single-product {
        padding: 20px;
    }

    .product-heading-block {
        margin-bottom: 4px;
    }

    .product-page-title {
        font-size: 28px;
        font-weight: 600;
        margin: 0 0 14px 0;
        color: #2c3e50;
        line-height: 1.35;
        word-wrap: break-word;
        overflow-wrap: anywhere;
    }

    .single-product h3 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
        line-height: 1.3;
    }

    .size-selection.size-selection--below-title {
        display: block;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        margin: 0 0 18px 0;
        padding: 14px 16px;
    }

    .size-selection__label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 15px;
        color: #334155;
        line-height: 1.3;
    }

    .size-selection--below-title .size-select {
        width: 100%;
        max-width: 100%;
        min-height: 46px;
        box-sizing: border-box;
    }

    @media (max-width: 767px) {
        .size-selection.size-selection--below-title {
            padding: 12px 14px;
            margin-bottom: 16px;
        }

        .size-selection.size-selection--below-title .size-selection__label {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .size-selection--below-title .size-select {
            min-height: 48px;
            padding: 14px 42px 14px 14px;
            font-size: 16px;
        }
    }

    @media (max-width: 575px) {
        .product-page-title {
            font-size: 22px;
            margin-bottom: 12px;
        }

        .size-selection.size-selection--below-title {
            padding: 12px 12px;
            margin-bottom: 14px;
            border-radius: 10px;
        }

        .size-selection--below-title .size-select {
            font-size: 16px;
        }
    }

    .group-md.group-middle {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .single-product-price {
        font-size: 26px;
        font-weight: 700;
        color: #2c3e50;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        padding: 5px 0;
    }

    .default-price {
        font-size: 28px;
        font-weight: 800;
    }

    .price-update {
        animation: pricePulse 0.5s ease-in-out;
    }

    @keyframes pricePulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .single-product-rating {
        display: flex;
        gap: 2px;
    }

    .single-product-rating .icon {
        color: #FFD700;
        font-size: 18px;
    }

    .single-product p {
        font-size: 16px;
        line-height: 1.6;
        color: #555;
        margin-bottom: 25px;
    }

    .hr-gray-100 {
        border: 0;
        height: 1px;
        background: #eaeaea;
        margin: 25px 0;
    }

    .list.list-description {
        margin-bottom: 25px;
    }

    .list.list-description li {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .list.list-description li:last-child {
        border-bottom: none;
    }

    .list.list-description li span:first-child {
        font-weight: 600;
        color: #333;
    }

    .list.list-description li span:last-child {
        color: #666;
    }

    .size-selection:not(.size-selection--below-title) {
        margin: 25px 0;
    }

    .size-selection {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        border: 1px solid #eaeaea;
    }

    .size-selection label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }

    .size-selection.size-selection--below-title label.size-selection__label {
        color: #334155;
    }

    .size-select {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        background-color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
    }

    .size-select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    .size-select option {
        padding: 12px;
        font-size: 15px;
    }

    .group-xs.group-middle {
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 25px 0;
        flex-wrap: wrap;
    }


    #add-to-cart {
        padding: 14px 30px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        flex-grow: 1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #add-to-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .select-size-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .select-size-modal-overlay.is-open {
        display: flex;
    }
    .select-size-modal {
        background: #fff;
        border-radius: 12px;
        padding: 28px 32px;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        text-align: center;
    }
    .select-size-modal p {
        margin: 0 0 20px;
        font-size: 17px;
        color: #2c3e50;
        line-height: 1.5;
    }
    .select-size-modal-close {
        padding: 12px 28px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .select-size-modal-close:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .added-to-cart-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .added-to-cart-modal-overlay.is-open {
        display: flex;
    }
    .added-to-cart-modal {
        background: #fff;
        border-radius: 12px;
        padding: 28px 32px;
        max-width: 420px;
        width: 100%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        text-align: center;
    }
    .added-to-cart-modal p {
        margin: 0 0 20px;
        font-size: 17px;
        color: #2c3e50;
        line-height: 1.5;
    }
    .added-to-cart-modal-close {
        padding: 12px 28px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .added-to-cart-modal-close:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .tabs-custom {
        margin-top: 50px;
    }

    .nav-tabs-wrap {
        border-bottom: 2px solid #eaeaea;
    }

    .nav-tabs-1 {
        display: flex;
        gap: 10px;
    }

    .nav-tabs-1 .nav-item .nav-link {
        padding: 14px 25px;
        font-size: 16px;
        font-weight: 600;
        color: #666;
        border: none;
        border-radius: 8px 8px 0 0;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .nav-tabs-1 .nav-item .nav-link.active,
    .nav-tabs-1 .nav-item .nav-link:hover {
        color: #007bff;
        background: white;
        border-bottom: 3px solid #007bff;
    }

    .tab-content-1 {
        padding: 30px;
        background: white;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 991px) {
        .carousel-parent img {
            height: 400px;
        }

        .single-product h3,
        .product-page-title {
            font-size: 24px;
        }

        .group-xs.group-middle {
            flex-direction: column;
            align-items: stretch;
        }

        .single-product .product-qty-picker {
            align-self: flex-start;
        }
    }

    @media (max-width: 767px) {
        .carousel-parent img {
            height: 300px;
        }

        .child-carousel .thumbnail {
            width: 80px;
            height: 80px;
        }

        .single-product {
            padding: 15px 0;
        }

        .size-selection:not(.size-selection--below-title) {
            padding: 15px;
        }
    }

    @media (max-width: 575px) {
        .carousel-parent img {
            height: 250px;
        }

        .child-carousel .thumbnail {
            width: 60px;
            height: 60px;
        }

        .single-product h3,
        .product-page-title {
            font-size: 22px;
        }

        .single-product-price {
            font-size: 22px;
        }

        .nav-tabs-1 {
            flex-direction: column;
        }

        .nav-tabs-1 .nav-item .nav-link {
            border-radius: 8px;
            margin-bottom: 5px;
        }
    }
    .single-product .product-qty-picker {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        flex-wrap: nowrap;
        box-sizing: border-box;
        width: 100%;
        max-width: 200px;
        min-height: 52px;
        border-radius: 12px;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.06);
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .single-product .product-qty-picker:hover {
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.1);
        border-color: #d1d5db;
    }

    .single-product .product-qty-picker__input {
        box-sizing: border-box;
        flex: 1 1 0;
        min-width: 0;
        width: auto !important;
        max-width: none !important;
        min-height: 0 !important;
        margin: 0;
        padding: 8px 10px;
        border: none !important;
        border-radius: 0;
        background: #ffffff !important;
        color: #0f172a !important;
        font-size: 20px;
        font-weight: 700;
        font-variant-numeric: tabular-nums;
        line-height: 1.3;
        text-align: center;
        font-family: inherit;
        letter-spacing: normal;
        -webkit-appearance: none;
        appearance: none;
        box-shadow: none !important;
    }

    .single-product .product-qty-picker__input:focus {
        outline: 2px solid rgba(102, 126, 234, 0.45);
        outline-offset: -2px;
        background: #f8fafc !important;
    }

    .single-product .product-qty-picker__input::-webkit-outer-spin-button,
    .single-product .product-qty-picker__input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .single-product .product-qty-picker__controls {
        display: flex;
        flex-direction: column;
        flex: 0 0 44px;
        width: 44px;
        min-height: 100%;
        border-left: 1px solid #e5e7eb;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .single-product .product-qty-picker__btn {
        box-sizing: border-box;
        flex: 1 1 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 26px;
        margin: 0;
        padding: 0;
        border: none;
        background: transparent;
        cursor: pointer;
        color: #475569;
        font-size: 15px;
        line-height: 1;
        transition: color 0.15s ease, background 0.15s ease;
    }

    .single-product .product-qty-picker__btn:hover {
        color: #4f46e5;
        background: rgba(79, 70, 229, 0.08);
    }

    .single-product .product-qty-picker__btn:active {
        background: rgba(79, 70, 229, 0.14);
    }

    .single-product .product-qty-picker__btn--inc {
        border-bottom: 1px solid #e5e7eb;
    }

    .single-product .product-qty-picker__btn i {
        pointer-events: none;
    }

    @keyframes sp-qty-pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.04); }
        100% { transform: scale(1); }
    }

    .single-product .product-qty-picker__input.value-changed {
        animation: sp-qty-pulse 0.3s ease;
    }

    @media (max-width: 575px) {
        .single-product .product-qty-picker {
            max-width: 180px;
            min-height: 48px;
        }

        .single-product .product-qty-picker__controls {
            flex-basis: 40px;
            width: 40px;
        }

        .single-product .product-qty-picker__input {
            font-size: 18px;
            padding: 6px 8px;
        }
    }

    .product-image-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 10050;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: rgba(0, 0, 0, 0.88);
        backdrop-filter: blur(4px);
    }

    .product-image-modal-overlay.is-open {
        display: flex;
    }

    .product-image-modal-inner {
        position: relative;
        max-width: min(96vw, 1400px);
        max-height: 90vh;
        margin: auto;
    }

    .product-image-modal-inner img {
        display: block;
        max-width: 100%;
        max-height: 90vh;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.45);
    }

    .product-image-modal-close {
        position: absolute;
        top: -12px;
        right: -12px;
        z-index: 2;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #fff;
        color: #333;
        font-size: 26px;
        line-height: 1;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .product-image-modal-close:hover {
        transform: scale(1.05);
        background: #f3f4f6;
    }

    @media (max-width: 575px) {
        .product-image-modal-close {
            top: 8px;
            right: 8px;
        }
    }
</style>

@php
    $seoProductImage = null;
    if ($product->photo1?->file_url) {
        $u = $product->photo1->file_url;
        $seoProductImage = \Illuminate\Support\Str::startsWith($u, ['http://', 'https://']) ? $u : url($u);
    }
@endphp
<x-web-layout
    :seo-title="$product->name . ' | ' . __('messages.seo_brand_suffix')"
    :seo-description="Str::limit(strip_tags((string) ($product->description ?? '')), 160)"
    :seo-keywords="$product->name . ', ' . ($product->categories->name ?? '') . ', ' . __('messages.seo_product_keywords')"
    :seo-image="$seoProductImage"
    seo-type="product"
>
    <div class="page">
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.single_product')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{route('web.home')}}">@lang('messages.home')</a></li>
                        <li><a href="{{ route('web.shop') }}">@lang('messages.shop')</a></li>
                        <li class="active">@lang('messages.single_product')</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section section-md section-first bg-default">
            <div class="container">
                <div class="row row-30">
                    <div class="col-lg-6">
                        <div class="slick-vertical slick-product">
                            @php
                                $initialPhotos = $photosBySize[0] ?? [];
                            @endphp
                            <div class="carousel-parent" id="carousel-parent" data-items="1" data-swipe="true" data-child="#child-carousel" data-for="#child-carousel">
                                @forelse($initialPhotos as $photo)
                                    <div class="item">
                                        <div class="slick-product-figure">
                                            <img src="{{ $photo['url'] }}" alt="" width="530" height="480"/>
                                        </div>
                                    </div>
                                @empty
                                    <div class="item">
                                        <div class="slick-product-figure">
                                            <img src="{{ asset('img/web/logo-emmy.png') }}" alt="" width="530" height="480"/>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <div class="child-carousel slick-nav-1" id="child-carousel" data-arrows="true" data-items="3">
                                @forelse($initialPhotos as $photo)
                                    <div class="item">
                                        <div class="slick-product-figure">
                                            <img src="{{ $photo['url'] }}" alt="" width="100" height="100" class="thumbnail"/>
                                        </div>
                                    </div>
                                @empty
                                    <div class="item">
                                        <div class="slick-product-figure">
                                            <img src="{{ asset('img/web/logo-emmy.png') }}" alt="" width="100" height="100" class="thumbnail"/>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="single-product">
                            <div class="product-heading-block">
                                <h3 class="text-transform-none font-weight-medium product-page-title">{{ $product->name }}</h3>
                                @if($product->sizes->isNotEmpty())
                                    <div class="size-selection size-selection--below-title">
                                        <label for="size-select" class="size-selection__label">@lang('messages.select_size'):</label>
                                        <select id="size-select" class="size-select" name="size_id" data-no-select2>
                                            <option value="">@lang('messages.choose_size')</option>
                                            @foreach($product->sizes as $size)
                                                <option value="{{ $size->id }}"
                                                        data-size-index="{{ $loop->index }}"
                                                        data-price="{{ $size->price }}"
                                                        data-formatted-price="{{ $size->formatted_price ?? number_format($size->price, 0, '', ' ') }}">
                                                    {{ $size->size }} — {{ $size->formatted_price ?? number_format($size->price, 0, '', ' ') }} @lang('messages.currency_rub')
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                            <div class="group-md group-middle">
                                <div class="single-product-price" id="price-display">
                                    @if($product->sizes->count() > 1)
                                        @lang('messages.price_from')
                                        <span class="default-price">{{ $product->min_price }}</span>
                                        @lang('messages.currency_rub')
                                    @elseif($product->sizes->count() === 1)
                                        <span class="default-price">{{ $product->sizes->first()->formatted_price ?? number_format($product->sizes->first()->price, 0, '', ' ') }}</span>
                                        @lang('messages.currency_rub')
                                    @else
                                        <span class="default-price">{{ number_format($product->price, 0, '', ' ') }}</span>
                                        @lang('messages.currency_rub')
                                    @endif
                                </div>
                            </div>
                            <p>{{ $product->description }}</p>
                            <hr class="hr-gray-100">
                            <ul class="list list-description">
                                <li><span>@lang('messages.categories'):</span><span>{{ $product->categories->name }}</span></li>
                            </ul>

                            <div class="group-xs group-middle">
                                <div class="product-qty-picker" role="group" aria-label="@lang('messages.quantity')">
                                    <input id="quantity-input" class="product-qty-picker__input" type="number" data-zeros="true" value="1" min="1" max="1000" inputmode="numeric" autocomplete="off">
                                    <div class="product-qty-picker__controls">
                                        <button type="button" class="product-qty-picker__btn product-qty-picker__btn--inc increment-btn" aria-label="@lang('messages.quantity_increase')">
                                            <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="product-qty-picker__btn decrement-btn" aria-label="@lang('messages.quantity_decrease')">
                                            <i class="fa-solid fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>

                                <form action="{{ route('basket.add') }}" method="POST" class="d-inline-block ms-2" id="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                                    <input type="hidden" name="size_id" id="size-id-hidden" value="">
                                    <button id="add-to-cart" type="submit" class="button button-lg button-secondary button-zakaria">@lang('messages.add_to_cart')</button>
                                </form>
                            </div>
                            <hr class="hr-gray-100">

                            @include('web.components.social-media')
                        </div>
                    </div>
                </div>
                <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
                    <div class="nav-tabs-wrap">
                        <ul class="nav nav-tabs nav-tabs-1">
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-1" data-toggle="tab">@lang('messages.reviews')</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-2" data-toggle="tab">@lang('messages.additional_info')</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-toggle="tab">@lang('messages.delivery_payment')</a></li>
                        </ul>
                    </div>
                    <div class="tab-content tab-content-1">
                        <div class="tab-pane fade show active" id="tabs-1-1">
                            <div class="box-comment">
                                <div class="unit flex-column flex-sm-row unit-spacing-md">
                                    <div class="unit-left"><a class="box-comment-figure" href="#"><img src="" alt="" width="119" height="119"/></a></div>
                                    <div class="unit-body">
                                        <div class="group-sm group-justify">
                                            <div>
                                                <div class="group-xs group-middle">
                                                    <h5 class="box-comment-author"><a href="#">Jane Doe</a></h5>
                                                    <div class="box-rating"><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star"></span><span class="icon mdi mdi-star-half"></span></div>
                                                </div>
                                            </div>
                                            <div class="box-comment-time">
                                                <time datetime="2019-11-30">Nov 30, 2019</time>
                                            </div>
                                        </div>
                                        <p class="box-comment-text">Качественная мебель, аккуратная сборка и приятный дизайн. Отдельно порадовала консультация по подбору размера и быстрая доставка.</p>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-transform-none font-weight-medium">@lang('messages.leave_review')</h4>
                        </div>
                        <div class="tab-pane fade" id="tabs-1-2">
                            <div class="single-product-info">
                                <div class="unit unit-spacing-md flex-column flex-sm-row align-items-sm-center">
                                    <div class="unit-left"><span class="icon icon-80 mdi mdi-information-outline"></span></div>
                                    <div class="unit-body">
                                        <p>Изделие выполнено из качественных и долговечных материалов. Конструкция рассчитана на эксплуатацию во влажной среде, устойчива к пару и сохраняет внешний вид при ежедневном использовании.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-1-3">
                            <div class="single-product-info">
                                <div class="unit unit-spacing-md flex-column flex-sm-row align-items-sm-center">
                                    <div class="unit-left"><span class="icon icon-80 mdi mdi-truck-delivery"></span></div>
                                    <div class="unit-body">
                                        <p>Доставка по Москве и области выполняется по согласованию. По запросу доступны поставки в регионы России и Белоруссии. Для оптовых заказов и индивидуальных условий свяжитесь с менеджером.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('web.components.featured-products', ['featuredProducts' => $featuredProducts])
        @include('web.components.our-brand')

        @include('SEO.product-seo')

        @if($product->sizes->isNotEmpty())
        <div class="select-size-modal-overlay" id="select-size-modal" role="dialog" aria-modal="true" aria-labelledby="select-size-modal-title">
            <div class="select-size-modal">
                <p id="select-size-modal-title">@lang('messages.please_select_size')</p>
                <button type="button" class="select-size-modal-close" id="select-size-modal-close">@lang('messages.ok')</button>
            </div>
        </div>
        @endif

        <div class="added-to-cart-modal-overlay" id="added-to-cart-modal" role="dialog" aria-modal="true" aria-labelledby="added-to-cart-modal-title">
            <div class="added-to-cart-modal">
                <p id="added-to-cart-modal-title">@lang('messages.product_added_to_cart')</p>
                <button type="button" class="added-to-cart-modal-close" id="added-to-cart-modal-close">@lang('messages.ok')</button>
            </div>
        </div>

        <div class="product-image-modal-overlay" id="product-image-modal" role="dialog" aria-modal="true" aria-label="@lang('messages.single_product')">
            <div class="product-image-modal-inner">
                <button type="button" class="product-image-modal-close" id="product-image-modal-close" aria-label="@lang('messages.close')">&times;</button>
                <img src="" alt="" id="product-image-modal-img" width="1200" height="800" decoding="async">
            </div>
        </div>

    </div>
</x-web-layout>

<script>
    window.productPhotosBySize = @json($photosBySize ?? []);
    window.productNameForGallery = @json($product->name);

    document.addEventListener('DOMContentLoaded', function () {
        const mainCarouselEl = document.querySelector('#carousel-parent');
        const childCarouselEl = document.getElementById('child-carousel');
        const sizeSelect = document.getElementById('size-select');
        const sizeIdHidden = document.getElementById('size-id-hidden');
        const priceDisplay = document.getElementById('price-display');

        function initCarousels() {
            if (!mainCarouselEl || !childCarouselEl) return;
            const thumbnails = childCarouselEl.querySelectorAll('.thumbnail');
            if (thumbnails.length === 0) return;

            if (typeof $ !== 'undefined' && !$(mainCarouselEl).hasClass('slick-initialized')) {
                $(mainCarouselEl).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: false,
                    asNavFor: '#child-carousel',
                });
                $('#child-carousel').slick({
                    slidesToShow: Math.min(3, thumbnails.length),
                    slidesToScroll: 1,
                    asNavFor: '#carousel-parent',
                    focusOnSelect: true,
                    arrows: true,
                    vertical: false,
                });
            }
            thumbnails.forEach((t, i) => t.classList.toggle('slick-current', i === 0));
        }

        function switchPhotosBySize(sizeIndex) {
            var photosBySize = window.productPhotosBySize;
            if (!photosBySize || !mainCarouselEl || !childCarouselEl) return;

            var photos = photosBySize[sizeIndex];
            if (!photos || !photos.length) {
                for (var i = 0; i < photosBySize.length; i++) {
                    if (photosBySize[i] && photosBySize[i].length) {
                        photos = photosBySize[i];
                        break;
                    }
                }
                if (!photos || !photos.length) return;
            }

            if (typeof $ !== 'undefined') {
                try {
                    var $main = $(mainCarouselEl);
                    var $child = $(childCarouselEl);
                    if ($main.hasClass('slick-initialized')) { $main.slick('unslick'); }
                    if ($child.hasClass('slick-initialized')) { $child.slick('unslick'); }
                } catch (e) {}
            }

            var mainHtml = photos.map(function(p) {
                return '<div class="item"><div class="slick-product-figure"><img src="' + p.url + '" alt="" width="530" height="480"/></div></div>';
            }).join('');
            var thumbHtml = photos.map(function(p) {
                return '<div class="item"><div class="slick-product-figure"><img src="' + p.url + '" alt="" width="100" height="100" class="thumbnail"/></div></div>';
            }).join('');

            mainCarouselEl.innerHTML = mainHtml;
            childCarouselEl.innerHTML = thumbHtml;

            setTimeout(function() {
                initCarousels();
            }, 50);
        }

        initCarousels();

        function syncPhotosToSelectedSize() {
            if (!sizeSelect || sizeSelect.value === '') return;
            var opt = sizeSelect.options[sizeSelect.selectedIndex];
            if (!opt) return;
            var idx = opt.getAttribute('data-size-index');
            if (idx === null || idx === '') return;
            var sizeIndex = parseInt(idx, 10);
            if (!isNaN(sizeIndex)) switchPhotosBySize(sizeIndex);
        }

        if (sizeSelect && sizeSelect.options.length === 2) {
            sizeSelect.selectedIndex = 1;
            sizeIdHidden.value = sizeSelect.value;
            if (priceDisplay) {
                var fp = sizeSelect.options[1].getAttribute('data-formatted-price');
                if (fp) {
                    priceDisplay.innerHTML = '<span class="default-price">' + fp + '</span> @lang('messages.currency_rub')';
                }
            }
            syncPhotosToSelectedSize();
        }

        setTimeout(function() {
            if (sizeSelect && sizeSelect.value) syncPhotosToSelectedSize();
        }, 250);

        function handleSizeChange() {
            if (!sizeSelect || !priceDisplay) return;
            var selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
            var sizeId = sizeSelect.value;
            var sizeIndexRaw = selectedOption ? selectedOption.getAttribute('data-size-index') : null;
            var formattedPrice = selectedOption ? selectedOption.getAttribute('data-formatted-price') : null;

            sizeIdHidden.value = sizeId || '';

            if (sizeId && sizeIndexRaw !== null && sizeIndexRaw !== '') {
                var sizeIndex = parseInt(sizeIndexRaw, 10);
                if (!isNaN(sizeIndex)) {
                    switchPhotosBySize(sizeIndex);
                }
            }

            if (sizeId && formattedPrice) {
                priceDisplay.innerHTML = '<span class="default-price">' + formattedPrice + '</span> @lang('messages.currency_rub')';
                priceDisplay.classList.add('price-update');
                setTimeout(function() { priceDisplay.classList.remove('price-update'); }, 500);
            } else {
                resetPriceDisplay();
            }
        }

        if (sizeSelect) {
            if (typeof jQuery !== 'undefined') {
                jQuery(sizeSelect).on('change.productSize select2:select', handleSizeChange);
            } else {
                sizeSelect.addEventListener('change', handleSizeChange);
            }
        }

        function resetPriceDisplay() {
            @if($product->sizes->count() > 1)
                priceDisplay.innerHTML = '@lang('messages.price_from') <span class="default-price">{{ $product->min_price }}</span> @lang('messages.currency_rub')';
            @elseif($product->sizes->count() === 1)
                priceDisplay.innerHTML = '<span class="default-price">{{ $product->sizes->first()->formatted_price ?? number_format($product->sizes->first()->price, 0, '', ' ') }}</span> @lang('messages.currency_rub')';
            @else
                priceDisplay.innerHTML = '<span class="default-price">{{ number_format($product->price, 0, '', ' ') }}</span> @lang('messages.currency_rub')';
            @endif
        }

        const quantityInput = document.getElementById('quantity-input');
        const decrementBtn = document.querySelector('.product-qty-picker .decrement-btn');
        const incrementBtn = document.querySelector('.product-qty-picker .increment-btn');

        function updateHiddenQuantity() {
            if (!quantityInput) return;
            var hidden = document.getElementById('quantity-hidden');
            if (hidden) hidden.value = quantityInput.value;
        }

        function pulseQuantityField() {
            if (!quantityInput) return;
            quantityInput.classList.add('value-changed');
            setTimeout(function() { quantityInput.classList.remove('value-changed'); }, 300);
        }

        function clampQuantity() {
            if (!quantityInput) return;
            var v = parseInt(quantityInput.value, 10);
            if (isNaN(v) || v < 1) quantityInput.value = 1;
            else if (v > 1000) quantityInput.value = 1000;
            updateHiddenQuantity();
        }

        if (quantityInput && decrementBtn && incrementBtn) {
            incrementBtn.addEventListener('click', function() {
                var v = parseInt(quantityInput.value, 10) || 1;
                if (v < 1000) {
                    quantityInput.value = v + 1;
                    pulseQuantityField();
                    updateHiddenQuantity();
                }
            });
            decrementBtn.addEventListener('click', function() {
                var v = parseInt(quantityInput.value, 10) || 1;
                if (v > 1) {
                    quantityInput.value = v - 1;
                    pulseQuantityField();
                    updateHiddenQuantity();
                }
            });
            quantityInput.addEventListener('change', clampQuantity);
            quantityInput.addEventListener('input', function() { updateHiddenQuantity(); });
        }

        const addToCartBtn = document.getElementById('add-to-cart');
        const addToCartForm = document.getElementById('add-to-cart-form');

        addToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();

            if (sizeSelect && sizeSelect.value === '') {
                const modal = document.getElementById('select-size-modal');
                if (modal) modal.classList.add('is-open');
                return;
            }

            document.getElementById('quantity-hidden').value = quantityInput.value;
            if (sizeSelect && sizeIdHidden) {
                sizeIdHidden.value = sizeSelect.value || '';
            }

            const formData = new FormData(addToCartForm);

            fetch("{{ route('basket.add') }}", {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => {
                    return response.json().then(data => ({ ok: response.ok, status: response.status, data }));
                })
                .then(({ ok, data }) => {
                    const modal = document.getElementById('added-to-cart-modal');
                    const textEl = document.getElementById('added-to-cart-modal-title');
                    if (textEl) textEl.textContent = (data && data.message) ? data.message : "@lang('messages.product_added_to_cart')";
                    if (modal) modal.classList.add('is-open');
                })
                .catch(error => {
                    console.error('Error:', error);
                    const modal = document.getElementById('added-to-cart-modal');
                    const textEl = document.getElementById('added-to-cart-modal-title');
                    if (textEl) textEl.textContent = "@lang('messages.product_added_to_cart')";
                    if (modal) modal.classList.add('is-open');
                });
        });

        const selectSizeModal = document.getElementById('select-size-modal');
        const selectSizeModalClose = document.getElementById('select-size-modal-close');
        if (selectSizeModal) {
            function closeSelectSizeModal() {
                selectSizeModal.classList.remove('is-open');
            }
            if (selectSizeModalClose) {
                selectSizeModalClose.addEventListener('click', closeSelectSizeModal);
            }
            selectSizeModal.addEventListener('click', function(e) {
                if (e.target === selectSizeModal) closeSelectSizeModal();
            });
        }

        const addedToCartModal = document.getElementById('added-to-cart-modal');
        const addedToCartModalClose = document.getElementById('added-to-cart-modal-close');
        if (addedToCartModal) {
            function closeAddedToCartModal() {
                addedToCartModal.classList.remove('is-open');
            }
            if (addedToCartModalClose) {
                addedToCartModalClose.addEventListener('click', closeAddedToCartModal);
            }
            addedToCartModal.addEventListener('click', function(e) {
                if (e.target === addedToCartModal) closeAddedToCartModal();
            });
        }

        var productImageModal = document.getElementById('product-image-modal');
        var productImageModalImg = document.getElementById('product-image-modal-img');
        var productImageModalCloseBtn = document.getElementById('product-image-modal-close');
        var productGalleryRoot = document.querySelector('.slick-vertical.slick-product');

        function openProductImageModal(src) {
            if (!productImageModal || !productImageModalImg || !src) return;
            productImageModalImg.src = src;
            productImageModalImg.alt = window.productNameForGallery || '';
            productImageModal.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeProductImageModal() {
            if (!productImageModal || !productImageModalImg) return;
            productImageModal.classList.remove('is-open');
            productImageModalImg.removeAttribute('src');
            document.body.style.overflow = '';
        }

        if (productGalleryRoot) {
            productGalleryRoot.addEventListener('click', function (e) {
                var img = e.target.closest('img');
                if (!img) return;
                if (!img.closest('#carousel-parent') && !img.closest('#child-carousel')) return;
                e.preventDefault();
                openProductImageModal(img.currentSrc || img.src);
            });
        }

        if (productImageModalCloseBtn) {
            productImageModalCloseBtn.addEventListener('click', closeProductImageModal);
        }

        if (productImageModal) {
            productImageModal.addEventListener('click', function (e) {
                if (e.target === productImageModal) closeProductImageModal();
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') return;
            if (productImageModal && productImageModal.classList.contains('is-open')) {
                closeProductImageModal();
            }
        });
    });
</script>
