<section class="section section-md section-last bg-primary-2">
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
                                <a class="button button-gray-14 button-zakaria fl-bigmug-line-search74"
                                   href="{{ route('web.product', $product->id) }}"
                                   title="@lang('messages.view_details')">
                                </a>
                            </div>
                            <div class="product-button">
                                <form action="{{ route('basket.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                            class="button button-primary-2 button-zakaria fl-bigmug-line-shopping202"
                                            title="@lang('messages.add_to_cart')">
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
