<x-web-layout :seo-keywords="__('messages.seo_shop_keywords')">
    <div class="page">
        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.what_we_offer')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ url('/') }}">@lang('messages.home')</a></li>
                        <li><a href="#">@lang('messages.pages')</a></li>
                        <li class="active">@lang('messages.what_we_offer')</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Section Services-->
        <section class="section section-md bg-default">
            <div class="container">
                <div class="row row-30 box-ochered">
                    <div class="col-sm-6 col-lg-3">
                        <article class="box-icon-modern">
                            <div class="box-icon-modern-header">
                                <div class="box-icon-modern-count box-ochered-item"></div>
                                <div class="box-icon-modern-icon icon-loveseat"></div>
                            </div>
                            <h4 class="box-icon-modern-title"><a href="#">@lang('messages.free_shipping')</a></h4>
                            <p class="box-icon-modern-text">@lang('messages.free_shipping_description')</p>
                        </article>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <article class="box-icon-modern">
                            <div class="box-icon-modern-header">
                                <div class="box-icon-modern-count box-ochered-item"></div>
                                <div class="box-icon-modern-icon icon-ceiling-lamp-4"></div>
                            </div>
                            <h4 class="box-icon-modern-title"><a href="#">@lang('messages.fresh_fancy')</a></h4>
                            <p class="box-icon-modern-text">@lang('messages.fresh_fancy_description')</p>
                        </article>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <article class="box-icon-modern">
                            <div class="box-icon-modern-header">
                                <div class="box-icon-modern-count box-ochered-item"></div>
                                <div class="box-icon-modern-icon icon-shower-and-bathtub"></div>
                            </div>
                            <h4 class="box-icon-modern-title"><a href="#">@lang('messages.made_with_love')</a></h4>
                            <p class="box-icon-modern-text">@lang('messages.made_with_love_description')</p>
                        </article>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <article class="box-icon-modern">
                            <div class="box-icon-modern-header">
                                <div class="box-icon-modern-count box-ochered-item"></div>
                                <div class="box-icon-modern-icon icon-television"></div>
                            </div>
                            <h4 class="box-icon-modern-title"><a href="#">@lang('messages.varied_stylish')</a></h4>
                            <p class="box-icon-modern-text">@lang('messages.varied_stylish_description')</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- Subscribe to Our Newsletter-->
        <section class="parallax-container call_section"><div class="material-parallax parallax"></div>
            <div class="parallax-content section-md context-dark text-lg-left">
                <div class="container">
                    <div class="row row-30 justify-content-center align-items-center align-items-lg-end">
                        <div class="col-xl-5">
                            <h2 class="parallax-title text-center text-xl-left wow fadeInLeft" data-wow-delay=".1s">@lang('messages.get_in_touch')</h2>
                        </div>
                        <div class="col-xl-7 inset-lg-bottom-10">
                            <!-- RD Mailform-->
                            <form class="ch-form ch-mailform ch-form-inline ch-form-inline-3 form-lg" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="#" novalidate="novalidate">
                                <div class="form-wrap wow fadeInUp">
                                    <input class="form-input form-control-has-validation" id="login-name" type="text" name="name" ><span class="form-validation"></span>
                                    <label class="form-label ch-input-label" for="login-name">@lang('messages.your_name')</label>
                                </div>
                                <div class="form-wrap wow fadeInUp">
                                    <input class="form-input form-control-has-validation" id="contact-email" type="email" name="email" data-constraints="@Email"><span class="form-validation"></span>
                                    <label class="form-label ch-input-label" for="contact-email">@lang('messages.your_email_address')</label>
                                </div>
                                <div class="form-button wow fadeInRight text-center">
                                    <button class="button button-zakaria button-sm button-primary" type="submit">@lang('messages.send_request')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing List-->
{{--        <section class="section section-sm section-first bg-default">--}}
{{--            <div class="container">--}}
{{--                <div class="row row-xl row-30 justify-content-center">--}}
{{--                    <div class="col-sm-6 col-lg-4">--}}
{{--                        <article class="pricing-classic">--}}
{{--                            <div class="pricing-classic-header"><img class="pricing-classic-figure" src="images/price/price-img-1.jpg" alt="" width="346" height="229"/>--}}
{{--                                <div class="pricing-classic-caption">--}}
{{--                                    <div>--}}
{{--                                        <h3 class="pricing-classic-title">@lang('messages.basic')</h3>--}}
{{--                                        <div class="pricing-classic-price-wrap">--}}
{{--                                            <div class="pricing-classic-price heading-4">$90.00</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="pricing-classic-body">--}}
{{--                                <ul class="pricing-classic-list">--}}
{{--                                    <li>@lang('messages.round_furnitures')</li>--}}
{{--                                    <li>@lang('messages.sponge_furnitures')</li>--}}
{{--                                    <li>@lang('messages.wedding_furnitures')</li>--}}
{{--                                    <li>@lang('messages.macarons')</li>--}}
{{--                                </ul><a class="button button-md button-default-outline-2 button-zakaria" href="cart-page.html">@lang('messages.add_to_cart')</a>--}}
{{--                            </div>--}}
{{--                        </article>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6 col-lg-4">--}}
{{--                        <article class="pricing-classic pricing-classic-sale">--}}
{{--                            <div class="pricing-classic-header"><img class="pricing-classic-figure" src="images/price/price-img-2.jpg" alt="" width="346" height="229"/>--}}
{{--                                <div class="pricing-classic-caption">--}}
{{--                                    <div><span class="product-badge product-badge-sale">@lang('messages.sale')</span>--}}
{{--                                        <h3 class="pricing-classic-title">@lang('messages.standard')</h3>--}}
{{--                                        <div class="pricing-classic-price-wrap">--}}
{{--                                            <div class="pricing-classic-price pricing-classic-price-old heading-6">$150.00</div>--}}
{{--                                            <div class="pricing-classic-price heading-4">$120.00</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="pricing-classic-body">--}}
{{--                                <ul class="pricing-classic-list">--}}
{{--                                    <li>@lang('messages.square_furnitures')</li>--}}
{{--                                    <li>@lang('messages.fruit_furnitures')</li>--}}
{{--                                    <li>@lang('messages.sculpted_furnitures')</li>--}}
{{--                                    <li>@lang('messages.biscuits')</li>--}}
{{--                                </ul><a class="button button-md button-default-outline-2 button-zakaria" href="cart-page.html">@lang('messages.add_to_cart')</a>--}}
{{--                            </div>--}}
{{--                        </article>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6 col-lg-4">--}}
{{--                        <article class="pricing-classic">--}}
{{--                            <div class="pricing-classic-header"><img class="pricing-classic-figure" src="images/price/price-img-3.jpg" alt="" width="346" height="229"/>--}}
{{--                                <div class="pricing-classic-caption">--}}
{{--                                    <div>--}}
{{--                                        <h3 class="pricing-classic-title">@lang('messages.premium')</h3>--}}
{{--                                        <div class="pricing-classic-price-wrap">--}}
{{--                                            <div class="pricing-classic-price heading-4">$190.00</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="pricing-classic-body">--}}
{{--                                <ul class="pricing-classic-list">--}}
{{--                                    <li>@lang('messages.scalloped_furnitures')</li>--}}
{{--                                    <li>@lang('messages.chocolate_furnitures')</li>--}}
{{--                                    <li>@lang('messages.celebration_furnitures')</li>--}}
{{--                                    <li>@lang('messages.pies')</li>--}}
{{--                                </ul><a class="button button-md button-default-outline-2 button-zakaria" href="cart-page.html">@lang('messages.add_to_cart')</a>--}}
{{--                            </div>--}}
{{--                        </article>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <!-- Our brand-->
        @include('web.components.our-brand')
        @include('SEO.offer-seo')

    </div>
</x-web-layout>
