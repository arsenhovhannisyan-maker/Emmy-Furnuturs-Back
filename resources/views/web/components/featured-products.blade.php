<section class="section section-md section-last bg-primary-2 featured-products-section">
    <div class="container">
        <h4 class="font-weight-sbold">@lang('messages.featured_products')</h4>
        <div class="row row-lg row-30 row-lg-50 justify-content-center">
            @foreach($featuredProducts as $product)
                <div class="col-sm-6 col-md-5 col-lg-3">
                    <article class="product">
                        <div class="product-body">
                            <div class="product-figure">
                                <img
                                    src="{{ $product->photo1 ? $product->photo1->file_url : asset('images/no-image.png') }}"
                                    alt="{{ $product->name }}"
                                    width="220"
                                    height="160"
                                />
                            </div>
                            <h5 class="product-title">
                                <a href="{{ route('web.product', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <div class="product-price-wrap">
                                @if($product->old_price && $product->old_price > $product->price)
                                    <div class="product-price product-price-old">
                                        ${{ number_format($product->old_price, 2) }}
                                    </div>
                                @endif
                                <div class="product-price">
                                    ${{ number_format($product->price, 2) }}
                                </div>
                            </div>
                        </div>

                        @if($product->old_price && $product->old_price > $product->price)
                            <span class="product-badge product-badge-sale">@lang('messages.sale')</span>
                        @endif

                        <div class="product-button-wrap">
                            <div class="product-button">
                                <a class="button button-gray-14 button-zakaria"
                                   href="{{ route('web.product', $product->id) }}"
                                   title="@lang('messages.view_details')">
                                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="product-button">
                                <form action="{{ route('basket.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                            class="button button-primary-2 button-zakaria"
                                            title="@lang('messages.add_to_cart')">
                                        <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .featured-products-section .product {
        overflow: hidden;
    }

    .featured-products-section .product-figure img {
        max-width: 100%;
        max-height: 160px;
        object-fit: contain;
    }

    .featured-products-section .product-button .button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        line-height: 1;
        padding: 0;
        vertical-align: middle;
        box-sizing: border-box;
        position: relative;
    }

    .featured-products-section .product-button .button i {
        font-size: 17px;
        line-height: 1;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .featured-products-section .product-button-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .featured-products-section .product-button + .product-button {
        margin-left: 0;
    }

    .featured-products-section .product-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        line-height: 0;
    }

    .featured-products-section .product-button form {
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
    }

    .featured-products-section .product-button .fa-cart-shopping {
        top: 50%;
    }

    .featured-products-section .product-button .button::before,
    .featured-products-section .product-button .button::after {
        display: none !important;
    }

    .featured-products-section button.button {
        border: 0;
        appearance: none;
    }

    @media (min-width: 768px) {
        .featured-products-section .product-body {
            transition: opacity .2s ease;
        }

        .featured-products-section .product-button-wrap {
            visibility: hidden;
        }

        .featured-products-section .product:hover .product-body {
            opacity: .24;
        }

        .featured-products-section .product:hover .product-button-wrap {
            visibility: visible;
        }
    }
</style>
