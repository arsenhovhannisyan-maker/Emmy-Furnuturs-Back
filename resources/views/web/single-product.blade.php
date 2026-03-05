<style>
    /* Main Carousel */
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
    }

    .carousel-parent img:hover {
        transform: scale(1.02);
    }

    /* Thumbnail Carousel */
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
        cursor: pointer;
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

    /* Arrow Styles */
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

    /* Product Info Section */
    .single-product {
        padding: 20px;
    }

    .single-product h3 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
        line-height: 1.3;
    }

    .group-md.group-middle {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    /* Price Display */
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

    /* Rating */
    .single-product-rating {
        display: flex;
        gap: 2px;
    }

    .single-product-rating .icon {
        color: #FFD700;
        font-size: 18px;
    }

    /* Description */
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

    /* List Description */
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

    /* Size Selection */
    .size-selection {
        margin: 25px 0;
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

    /* Quantity and Add to Cart */
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

    /* Modal "Выберите размер" */
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

    /* Модальное окно "Товар добавлен в корзину" */
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

    /* Tabs */
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

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .carousel-parent img {
            height: 400px;
        }

        .single-product h3 {
            font-size: 24px;
        }

        .group-xs.group-middle {
            flex-direction: column;
            align-items: stretch;
        }

        .product-stepper {
            align-self: flex-start;
            display: flex !important;
            flex-direction: row !important;
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

        .size-selection {
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

        .single-product h3 {
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
    .product-stepper {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e8e8e8;
        transition: all 0.3s ease;
        max-width: 160px;
    }

    .product-stepper:hover {
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        border-color: #d0d0d0;
    }

    .product-stepper button {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%) !important;
        border: none !important;
        width: 44px !important;
        height: 44px !important;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #4a5568;
        position: relative !important;
        overflow: hidden;
        flex-shrink: 0 !important;
    }

    .product-stepper button:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-stepper button:hover {
        color: white;
    }

    .product-stepper button:hover:before {
        opacity: 1;
    }

    .product-stepper button span {
        position: relative;
        z-index: 1;
    }

    .product-stepper button:active {
        transform: scale(0.95);
    }

    .product-stepper button:first-child {
        border-right: 1px solid #e8e8e8 !important;
        order: 1 !important;
    }

    .product-stepper input {
        width: 70px !important;
        padding: 12px 5px !important;
        border: none !important;
        text-align: center !important;
        font-size: 18px;
        font-weight: 700;
        color: #2d3748;
        background: transparent !important;
        transition: all 0.3s ease;
        flex-shrink: 0 !important;
        display: block !important;
        order: 2 !important;
    }

    .product-stepper button:last-child {
        border-left: 1px solid #e8e8e8 !important;
        order: 3 !important;
    }

    .product-stepper input:focus {
        outline: none;
        background: rgba(102, 126, 234, 0.05);
    }

    /* Animation for value changes */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .product-stepper input.value-changed {
        animation: pulse 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 575px) {
        .product-stepper {
            max-width: 140px;
            display: flex !important;
            flex-direction: row !important;
        }

        .product-stepper button {
            width: 40px !important;
            height: 40px !important;
        }

        .product-stepper input {
            width: 60px !important;
            font-size: 16px;
        }
    }
</style>

<x-web-layout>
    <div class="page">
        <!--+breadcrumbs-->
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
        <!-- Single Product-->
        <section class="section section-md section-first bg-default">
            <div class="container">
                <div class="row row-30">
                    <div class="col-lg-6">
                        <div class="slick-vertical slick-product">
                            <!-- Main Carousel (first size photos or default) -->
                            @php
                                $initialPhotos = $photosBySize[0] ?? [];
                            @endphp
                            <div class="slick-slider carousel-parent" id="carousel-parent" data-items="1" data-swipe="true" data-child="#child-carousel" data-for="#child-carousel">
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

                            <!-- Thumbnails -->
                            <div class="slick-slider child-carousel slick-nav-1" id="child-carousel" data-arrows="true" data-items="3">
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
                            <h3 class="text-transform-none font-weight-medium">{{ $product->name }}</h3>
                            <div class="group-md group-middle">
                                <!-- Price Display -->
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

                            <!-- Size Selection -->
                            @if($product->sizes->isNotEmpty())
                                <div class="size-selection">
                                    <label for="size-select" style="display: block; margin-bottom: 8px; font-weight: bold;">@lang('messages.select_size'):</label>
                                    <select id="size-select" class="size-select" name="size_id">
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

                            <div class="group-xs group-middle">
                                <div class="product-stepper">
                                    <button type="button" class="decrement-btn">
                                        <span>-</span>
                                    </button>
                                    <input id="quantity-input" class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000">
                                    <button type="button" class="increment-btn">
                                        <span>+</span>
                                    </button>
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
                <!-- Bootstrap tabs-->
                <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
                    <!-- Nav tabs-->
                    <div class="nav-tabs-wrap">
                        <ul class="nav nav-tabs nav-tabs-1">
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-1" data-toggle="tab">@lang('messages.reviews')</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-2" data-toggle="tab">@lang('messages.additional_info')</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-toggle="tab">@lang('messages.delivery_payment')</a></li>
                        </ul>
                    </div>
                    <!-- Tab panes-->
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
                                        <p class="box-comment-text">Lorem ipsum dolor sit amet, has mutat labores nostrum ei. Duo te blandit erroribus, ut sea ipsum nonumy, mel no ignota accusamus gloriatur. Id has habeo regione, explicari hendrerit reprimique cum te.</p>
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
                                        <p>Lorem ipsum dolor sit amet, has mutat labores nostrum ei. Duo te blandit erroribus, ut sea ipsum nonumy, mel no ignota accusamus gloriatur. Id has habeo regione, explicari hendrerit reprimique cum teLorem ipsum dolor sit amet, has mutat labores nostrum ei. Duo te blandit erroribus, ut sea ipsum nonumy, mel no ignota accusamus gloriatur. Id has habeo regione, explicari hendrerit reprimique cum te</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-1-3">
                            <div class="single-product-info">
                                <div class="unit unit-spacing-md flex-column flex-sm-row align-items-sm-center">
                                    <div class="unit-left"><span class="icon icon-80 mdi mdi-truck-delivery"></span></div>
                                    <div class="unit-body">
                                        <p>Lorem ipsum dolor sit amet, has mutat labores nostrum ei. Duo te blandit erroribus, ut sea ipsum nonumy, mel no ignota accusamus gloriatur. Id has habeo regione, explicari hendrerit reprimique cum teLorem ipsum dolor sit amet, has mutat labores nostrum ei. Duo te blandit erroribus, ut sea ipsum nonumy, mel no ignota accusamus gloriatur. Id has habeo regione, explicari hendrerit reprimique cum te</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related Products-->
        @include('web.components.featured-products', ['featuredProducts' => $featuredProducts])
        <!-- Our brand-->
        @include('web.components.our-brand')

        <!--SEO-->
        @include('SEO.product-seo')

        @if($product->sizes->isNotEmpty())
        <!-- Модальное окно: выберите размер -->
        <div class="select-size-modal-overlay" id="select-size-modal" role="dialog" aria-modal="true" aria-labelledby="select-size-modal-title">
            <div class="select-size-modal">
                <p id="select-size-modal-title">@lang('messages.please_select_size')</p>
                <button type="button" class="select-size-modal-close" id="select-size-modal-close">@lang('messages.ok')</button>
            </div>
        </div>
        @endif

        <!-- Модальное окно: товар добавлен в корзину -->
        <div class="added-to-cart-modal-overlay" id="added-to-cart-modal" role="dialog" aria-modal="true" aria-labelledby="added-to-cart-modal-title">
            <div class="added-to-cart-modal">
                <p id="added-to-cart-modal-title">@lang('messages.product_added_to_cart')</p>
                <button type="button" class="added-to-cart-modal-close" id="added-to-cart-modal-close">@lang('messages.ok')</button>
            </div>
        </div>

    </div>
</x-web-layout>

<script>
    window.productPhotosBySize = @json($photosBySize ?? []);

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
                // Нет фото у этого размера — пробуем любое фото с других размеров
                for (var i = 0; i < photosBySize.length; i++) {
                    if (photosBySize[i] && photosBySize[i].length) {
                        photos = photosBySize[i];
                        break;
                    }
                }
                if (!photos || !photos.length) return;
            }

            // Полностью сносим Slick, чтобы не осталось обёрток
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

            // Даём DOM обновиться, потом снова поднимаем карусель
            setTimeout(function() {
                initCarousels();
            }, 50);
        }

        initCarousels();

        // Синхронизация фото с выбранным размером (главное фото + превью)
        function syncPhotosToSelectedSize() {
            if (!sizeSelect || sizeSelect.value === '') return;
            var opt = sizeSelect.options[sizeSelect.selectedIndex];
            if (!opt) return;
            var idx = opt.getAttribute('data-size-index');
            if (idx === null || idx === '') return;
            var sizeIndex = parseInt(idx, 10);
            if (!isNaN(sizeIndex)) switchPhotosBySize(sizeIndex);
        }

        // Если размер один — выбрать его сразу
        if (sizeSelect && sizeSelect.options.length === 2) {
            sizeSelect.selectedIndex = 1;
            sizeIdHidden.value = sizeSelect.value;
            if (priceDisplay) {
                var fp = sizeSelect.options[1].getAttribute('data-formatted-price');
                if (fp) priceDisplay.innerHTML = fp + ' @lang('messages.currency_rub')';
            }
            syncPhotosToSelectedSize();
        }

        // После загрузки скриптов layout — подстроить фото под выбранный размер (напр. 1000x800)
        setTimeout(function() {
            if (sizeSelect && sizeSelect.value) syncPhotosToSelectedSize();
        }, 250);

        // При смене размера — сразу меняем главное фото и превью
        if (sizeSelect) {
            sizeSelect.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var sizeId = this.value;
                var sizeIndexRaw = selectedOption ? selectedOption.getAttribute('data-size-index') : null;
                var price = selectedOption ? selectedOption.getAttribute('data-price') : null;
                var formattedPrice = selectedOption ? selectedOption.getAttribute('data-formatted-price') : null;

                sizeIdHidden.value = sizeId || '';

                if (sizeId && sizeIndexRaw !== null && sizeIndexRaw !== '') {
                    var sizeIndex = parseInt(sizeIndexRaw, 10);
                    if (!isNaN(sizeIndex)) {
                        switchPhotosBySize(sizeIndex);
                    }
                }

                if (sizeId && price && formattedPrice) {
                    priceDisplay.innerHTML = formattedPrice + ' @lang('messages.currency_rub')';
                    priceDisplay.classList.add('price-update');
                    setTimeout(function() { priceDisplay.classList.remove('price-update'); }, 500);
                } else {
                    resetPriceDisplay();
                }
            });
        }

        // Function to reset price to original state
        function resetPriceDisplay() {
            @if($product->sizes->count() > 1)
                priceDisplay.innerHTML = '@lang('messages.price_from') <span class="default-price">{{ $product->min_price }}</span> @lang('messages.currency_rub')';
            @elseif($product->sizes->count() === 1)
                priceDisplay.innerHTML = '<span class="default-price">{{ $product->sizes->first()->formatted_price ?? number_format($product->sizes->first()->price, 0, '', ' ') }}</span> @lang('messages.currency_rub')';
            @else
                priceDisplay.innerHTML = '<span class="default-price">{{ number_format($product->price, 0, '', ' ') }}</span> @lang('messages.currency_rub')';
            @endif
        }

        // Quantity stepper functionality
        const quantityInput = document.getElementById('quantity-input');
        const decrementBtn = document.querySelector('.decrement-btn');
        const incrementBtn = document.querySelector('.increment-btn');

        if (decrementBtn && incrementBtn) {
            decrementBtn.addEventListener('click', function() {
                if (quantityInput.value > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                    updateHiddenQuantity();
                }
            });

            incrementBtn.addEventListener('click', function() {
                if (quantityInput.value < 1000) {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    updateHiddenQuantity();
                }
            });

            quantityInput.addEventListener('change', function() {
                if (this.value < 1) this.value = 1;
                if (this.value > 1000) this.value = 1000;
                updateHiddenQuantity();
            });
        }

        function updateHiddenQuantity() {
            document.getElementById('quantity-hidden').value = quantityInput.value;
        }

        // Add to cart handler
        const addToCartBtn = document.getElementById('add-to-cart');
        const addToCartForm = document.getElementById('add-to-cart-form');

        addToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Check if size is selected (if sizes exist)
            if (sizeSelect && sizeSelect.value === '') {
                const modal = document.getElementById('select-size-modal');
                if (modal) modal.classList.add('is-open');
                return;
            }

            // Update hidden quantity field
            document.getElementById('quantity-hidden').value = quantityInput.value;

            const formData = new FormData(addToCartForm);

            fetch("{{ route('basket.add') }}", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const modal = document.getElementById('added-to-cart-modal');
                    const textEl = document.getElementById('added-to-cart-modal-title');
                    if (textEl) textEl.textContent = data.message || "@lang('messages.product_added_to_cart')";
                    if (modal) modal.classList.add('is-open');
                })
                .catch(error => console.error('Error:', error));
        });

        // Закрытие модалки "Выберите размер"
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

        // Закрытие модалки "Товар добавлен в корзину"
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
    });

    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity-input');
        const decrementBtn = document.querySelector('.decrement-btn');
        const incrementBtn = document.querySelector('.increment-btn');

        function updateQuantity(value) {
            quantityInput.value = value;
            quantityInput.classList.add('value-changed');
            setTimeout(() => {
                quantityInput.classList.remove('value-changed');
            }, 300);
        }

        if (decrementBtn && incrementBtn) {
            decrementBtn.addEventListener('click', function() {
                if (quantityInput.value > 1) {
                    updateQuantity(parseInt(quantityInput.value) - 1);
                }
            });

            incrementBtn.addEventListener('click', function() {
                if (quantityInput.value < 1000) {
                    updateQuantity(parseInt(quantityInput.value) + 1);
                }
            });

            quantityInput.addEventListener('change', function() {
                if (this.value < 1) this.value = 1;
                if (this.value > 1000) this.value = 1000;
                updateQuantity(this.value);
            });
        }
    });
</script>
