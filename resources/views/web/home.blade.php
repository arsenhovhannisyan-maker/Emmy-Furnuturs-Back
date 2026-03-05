<x-web-layout>
    <!-- Swiper-->
    <section class="section swiper-container swiper-slider swiper-slider-4" data-loop="true" data-effect="fade">
        <div class="swiper-wrapper">
            <div class="swiper-slide swiper-slide-1" data-slide-bg="{{ asset('img/Carusel1.jpg') }}">
                <div class="swiper-slide-caption section-md text-sm-left">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8 col-md-7">
                                <h1 class="swiper-title-1" data-caption-animate="fadeInLeft" data-caption-delay="100">@lang('messages.slider_title_1')</h1>
                                <h6 class="swiper-title-2 text-width-medium" data-caption-animate="fadeInLeft" data-caption-delay="250">@lang('messages.slider_description_1')</h6>
                                <div class="button-wrap" data-caption-animate="fadeInLeft" data-caption-delay="400"><a class="button button-sm button-primary button-zakaria" href="{{ route('web.shop') }}">@lang('messages.shop_now')</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-1" data-slide-bg="{{ asset('img/Carusel2.jpg') }}">
                <div class="swiper-slide-caption section-md text-sm-left">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8 col-md-7">
                                <h1 class="swiper-title-1" data-caption-animate="fadeInLeft" data-caption-delay="100">@lang('messages.slider_title_2')</h1>
                                <h6 class="swiper-title-2 text-width-medium" data-caption-animate="fadeInRight" data-caption-delay="250">@lang('messages.slider_description_2')</h6>
                                <div class="button-wrap" data-caption-animate="fadeInUp" data-caption-delay="400"><a class="button button-sm button-primary button-zakaria" href="{{ route('web.shop') }}">@lang('messages.shop_now')</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination"></div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </section>

    <section class="section section-md text-md-left quote-about">
        <div class="container">
            <div class="row row-30">
                <div class="col-md-4 col-lg-4 wow fadeInLeft custom-banner" data-wow-delay=".2s">
                    <article class="box-icon-creative">
                        <div class="unit flex-column flex-md-row flex-lg-column flex-xl-row align-items-md-center align-items-lg-start align-items-xl-center">
                            <div class="unit-left">
                                <div class="box-icon-creative-icon icon-couch"></div>
                            </div>
                            <div class="unit-body">
                                <div class="d-flex align-items-center"> <!-- Added flex container -->
                                    <img src="{{ asset('img/321.png') }}" alt="image" class="me-3"> <!-- Added margin class -->
                                    <h4 class="box-icon-creative-title mb-0"><a href="#">@lang('messages.free_shipping')</a></h4> <!-- Removed bottom margin -->
                                </div>
                                <p class="box-icon-creative-text">@lang('messages.free_shipping_desc')</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 col-lg-4 wow fadeInLeft custom-banner" data-wow-delay=".1s">
                    <article class="box-icon-creative">
                        <div class="unit flex-column flex-md-row flex-lg-column flex-xl-row align-items-md-center align-items-lg-start align-items-xl-center">
                            <div class="unit-left">
                                <div class="box-icon-creative-icon icon-two-drawers"></div>
                            </div>
                            <div class="unit-body">
                                <div class="d-flex align-items-center"> <!-- Added flex container -->

                                    <img src="{{ asset('img/123.png') }}" alt="image">
                                <h4 class="box-icon-creative-title"><a href="#">@lang('messages.fresh_innovation')</a></h4>
                                    </div>
                                <p class="box-icon-creative-text">@lang('messages.fresh_innovation_desc')</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 col-lg-4 wow fadeInLeft custom-banner">
                    <article class="box-icon-creative">
                        <div class="unit flex-column flex-md-row flex-lg-column flex-xl-row align-items-md-center align-items-lg-start align-items-xl-center">
                            <div class="unit-left">
                                <div class="box-icon-creative-icon icon-side-lamp-2"></div>
                            </div>
                            <div class="unit-body">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('img/312.png') }}" alt="image">
                                <h4 class="box-icon-creative-title"><a href="#">@lang('messages.made_with_love')</a></h4>
                                </div>
                                <p class="box-icon-creative-text">@lang('messages.made_with_love_desc')</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Offer-->
    <section class="section section-md bg-default text-md-left">
        <div class="container">
            <div class="row row-70 row-lg-50 justify-content-center align-items-md-center">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="aboutUs">
                        <h2 class="text-transform-capitalize wow fadeInRight">@lang('messages.what_we_offer')</h2>
                        <!-- Bootstrap collapse-->

                        <p>@lang('messages.what_we_offer_desc_1')</p>
                        <p>@lang('messages.what_we_offer_desc_2')</p>
                        <ul class="list-marked">
                            <li>@lang('messages.feature_1')</li>
                            <li>@lang('messages.feature_2')</li>
                            <li>@lang('messages.feature_3')</li>
                        </ul>
                        <a class="button button-sm button-primary button-zakaria" href="{{ route('web.shop') }}">@lang('messages.shop_now')</a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <div class="decorative-box text-center"><img src="{{asset("img/about/aboutimg.png")}}" alt="@lang('messages.about_image_alt')" /></div>
                </div>
            </div>
        </div>
    </section>

    @include('web.components.product-section')

    <!-- Testimonials-->
    <section class="section bg-brown-1 call_section_1">
        <div class="parallax-content section-md context-dark">
            <div class="container">
                <h3 class="text-spacing-100">@lang('messages.summer_sale')</h3>
                <h6 class="font-weight-light">@lang('messages.summer_sale_desc')</h6>
                <a class="button button-sm button-shadow-2 button-primary button-zakaria" href="{{ route('web.shop') }}">@lang('messages.shop_now')</a>
            </div>
        </div>
    </section>

    <!-- Gallery-->
    @include('web.components.gallery')

    <!-- Subscribe to Our Newsletter-->
    <section class="parallax-container call_section">
        <div class="parallax-content section-md context-dark text-lg-left">
            <div class="container">
                <div class="row row-30 justify-content-center align-items-center align-items-lg-end">
                    <div class="col-xl-5">
                        <h2 class="parallax-title text-center text-xl-left wow fadeInLeft" data-wow-delay=".1s">@lang('messages.get_in_touch')</h2>
                    </div>
                    <div class="col-xl-7 inset-lg-bottom-10">
                        <!-- RD Mailform-->
                        <form class="ch-form ch-mailform ch-form-inline ch-form-inline-3 form-lg"
                              data-form-output="form-output-global"
                              data-form-type="subscribe"
                              method="post"
                              action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="form-wrap wow fadeInUp">
                                <input class="form-input" id="login-name" type="text" name="first_name" required/>
                                <label class="form-label" for="login-name">@lang('messages.your_name')</label>
                            </div>
                            <div class="form-wrap wow fadeInUp">
                                <input class="form-input" id="contact-email" type="email" name="email" required/>
                                <label class="form-label" for="contact-email">@lang('messages.your_email_address')</label>
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

    <!-- Our Blog-->
    @include('web.components.our-blog')

    <!-- Our brand-->
    @include('web.components.our-brand')
    @include('SEO.home-seo')

</x-web-layout>
