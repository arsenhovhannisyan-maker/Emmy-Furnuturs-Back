<x-web-layout :seo-keywords="__('messages.seo_home_keywords')">
    @php
        $bannerDirectory = base_path('banner');
        $carouselImages = [];

        if (\Illuminate\Support\Facades\File::isDirectory($bannerDirectory)) {
            $bannerFiles = \Illuminate\Support\Facades\File::files($bannerDirectory);
            usort($bannerFiles, function ($a, $b) {
                return strcmp($a->getFilename(), $b->getFilename());
            });

            foreach ($bannerFiles as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
                    $carouselImages[] = route('web.banner.image', ['filename' => $file->getFilename()]);
                }
            }
        }

        if ($carouselImages === []) {
            $carouselImages = [
                asset('img/Carusel1.jpg'),
                asset('img/Carusel2.jpg'),
            ];
        }
    @endphp

    <!-- Swiper-->
    <section class="section swiper-container swiper-slider swiper-slider-4" data-loop="true" data-effect="fade">
        <div class="swiper-wrapper">
            @foreach($carouselImages as $imageUrl)
                <div class="swiper-slide swiper-slide-1" data-slide-bg="{{ $imageUrl }}">
                    <div class="swiper-slide-caption section-md text-sm-left">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8 col-md-7">
                                    <h1 class="swiper-title-1" data-caption-animate="fadeInLeft" data-caption-delay="100">@lang($loop->odd ? 'messages.slider_title_1' : 'messages.slider_title_2')</h1>
                                    <h6 class="swiper-title-2 text-width-medium" data-caption-animate="fadeInLeft" data-caption-delay="250">@lang($loop->odd ? 'messages.slider_description_1' : 'messages.slider_description_2')</h6>
                                    <div class="button-wrap" data-caption-animate="fadeInLeft" data-caption-delay="400"><a class="button button-sm button-primary button-zakaria" href="{{ route('web.shop') }}">@lang('messages.shop_now')</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </section>
    <style>
        .swiper-slider-4 {
            overflow: hidden !important;
        }

        .swiper-slider-4 .swiper-wrapper,
        .swiper-slider-4 .swiper-slide {
            height: 100% !important;
        }

        .swiper-slider-4 .swiper-slide {
            overflow: hidden !important;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        @media (max-width: 767px) {
            .swiper-slider-4 {
                height: 320px !important;
                min-height: 320px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 1180px) {
            .swiper-slider-4 {
                height: 52vw !important;
                min-height: 420px !important;
            }
        }

        @media (min-width: 1181px) {
            .swiper-slider-4 {
                height: 38vw !important;
                min-height: 480px !important;
            }
        }

        .swiper-slider-4 .swiper-button-prev,
        .swiper-slider-4 .swiper-button-next {
            background: none !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            width: auto;
            height: auto;
            font-family: system-ui, -apple-system, Arial, sans-serif !important;
        }
        .swiper-slider-4 .swiper-button-prev:before,
        .swiper-slider-4 .swiper-container-rtl .swiper-button-next:before {
            display: none !important;
        }
        .swiper-slider-4 .swiper-button-next:before,
        .swiper-slider-4 .swiper-container-rtl .swiper-button-prev:before {
            display: none !important;
        }   
        .swiper-slider-4 .swiper-button-prev:focus,
        .swiper-slider-4 .swiper-button-next:focus {
            outline: none !important;
        }

        .contact-subscribe .parallax-content {
            padding-top: 48px;
            padding-bottom: 48px;
        }

        .contact-subscribe__title {
            display: flex;
            flex-direction: column;
            gap: 14px;
            line-height: 1.1;
            margin-bottom: 0;
        }

        .contact-subscribe__title-line {
            display: block;
        }

        .contact-subscribe__form.ch-form-inline {
            margin-bottom: 0;
        }

        .contact-subscribe__form.form-lg .form-input,
        .contact-subscribe__form.form-lg .form-label {
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 0.05em;
        }

        .contact-subscribe__form.form-lg .form-input {
            min-height: 52px;
            padding-top: 14px;
            padding-bottom: 14px;
            border-color: rgba(255, 255, 255, 0.45);
        }

        .contact-subscribe__form.form-lg .form-label {
            top: 26px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .contact-subscribe__form .form-wrap {
            min-width: 140px;
        }

        .contact-subscribe__form .form-wrap.has-focus .form-input {
            border-color: #50BECF;
        }

        .contact-subscribe__form .form-button .button.contact-subscribe__btn {
            padding: 14px 36px !important;
            min-height: 52px !important;
            min-width: 0 !important;
            width: auto !important;
            margin-top: 0 !important;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            white-space: nowrap;
            border-radius: 0;
        }

        .contact-subscribe__form .form-button {
            display: flex;
            align-items: center;
            min-height: auto;
        }

        @media (min-width: 768px) {
            .contact-subscribe__form.ch-form-inline {
                flex-wrap: nowrap;
                align-items: flex-end;
            }

            .contact-subscribe__form .form-wrap {
                flex: 1 1 0;
                min-width: 160px;
            }

            .contact-subscribe__form .contact-subscribe__field-email {
                min-width: 200px;
            }
        }

        @media (min-width: 1200px) {
            .contact-subscribe__row {
                min-height: 250px;
                align-items: center !important;
            }

            .contact-subscribe__title-col,
            .contact-subscribe__form-col {
                display: flex;
                align-items: center;
            }

            .contact-subscribe__form.ch-form-inline {
                align-items: center;
                width: 100%;
            }

            .contact-subscribe__form .form-wrap,
            .contact-subscribe__form .form-button {
                margin-bottom: 0;
            }

            .contact-subscribe__form .contact-subscribe__field-email {
                min-width: 220px;
            }
        }

        @media (max-width: 1199.98px) {
            .contact-subscribe__title {
                gap: 10px;
                margin-bottom: 28px;
            }

            .contact-subscribe__form .form-button {
                width: 100%;
                justify-content: center;
                margin-top: 8px;
            }

            .contact-subscribe__form .form-button .button.contact-subscribe__btn {
                width: 100%;
                max-width: 300px;
            }
        }

        @media (max-width: 767.98px) {
            .contact-subscribe__title-col,
            .contact-subscribe__form-col {
                padding-left: 15px;
                padding-right: 15px;
            }

            .contact-subscribe__form.ch-form-inline {
                margin-left: 0;
                margin-right: 0;
                margin-bottom: 0;
                max-width: 100%;
                width: 100%;
                padding-left: 0;
                padding-right: 0;
            }

            .contact-subscribe__form.ch-form-inline > * {
                display: block;
                width: 100%;
                margin-left: 0 !important;
                margin-right: 0;
                box-sizing: border-box;
            }

            .contact-subscribe__form .form-wrap,
            .contact-subscribe__form .contact-subscribe__field-email {
                min-width: 0;
                width: 100%;
            }

            .contact-subscribe__form .form-input {
                width: 100%;
                box-sizing: border-box;
                text-align: left;
            }

            .contact-subscribe__form.form-lg .form-label {
                text-align: left;
                left: 0;
                right: 0;
            }
        }

        /* ── Safari / iOS fix ── */
        /* background-attachment:fixed breaks layout on iOS Safari */
        @supports (-webkit-touch-callout: none) {
            .call_section,
            .call_section_1,
            .breadcrumbs_section {
                background-attachment: scroll;
            }
            /* hide parallax img layer — dark bg fallback remains */
            .parallax-container.call_section .material-parallax {
                display: none;
            }
        }
        /* Safari desktop: same fix via feature query */
        @media not all and (min-resolution:.001dpcm) {
            @supports (-webkit-appearance: none) {
                .call_section,
                .call_section_1,
                .breadcrumbs_section {
                    background-attachment: scroll;
                }
                .parallax-container.call_section .material-parallax {
                    display: none;
                }
            }
        }
    </style>

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
                    <div class="decorative-box text-center"><img src="{{asset("img/favicon.png")}}" alt="@lang('messages.about_image_alt')" /></div>
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

    <!-- Get in touch-->
    <section class="parallax-container call_section"><div class="material-parallax parallax"></div>
        <div class="parallax-content section-md context-dark text-lg-left">
            <div class="container">
                <div class="row row-30 justify-content-center align-items-center align-items-lg-end">
                    <div class="col-xl-5">
                        <h2 class="parallax-title text-center text-xl-left wow fadeInLeft" data-wow-delay=".1s">@lang('messages.get_in_touch')</h2>
                    </div>
                    <div class="col-xl-7 inset-lg-bottom-10">
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

    <!-- Our Blog-->
    @include('web.components.our-blog')

    <!-- Our brand-->
    @include('web.components.our-brand')
    @include('SEO.home-seo')

</x-web-layout>
