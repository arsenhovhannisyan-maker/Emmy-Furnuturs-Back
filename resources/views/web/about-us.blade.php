<x-web-layout :seo-keywords="__('messages.seo_about_keywords')">
    <div class="page">

        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.about_us')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ url('/') }}">@lang('messages.home')</a></li>
                        <li><a href="#">@lang('messages.pages')</a></li>
                        <li class="active">@lang('messages.about_us')</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Section About-->
        <section class="section section-md bg-default text-md-left">
            <div class="container">
                <div class="row row-40 row-md-60 justify-content-center align-items-xl-center">
                    <div class="col-md-11 col-lg-6 col-xl-5">
                        <!-- Quote Classic Big-->
                        <article class="quote-classic-big inset-xl-right-30">
                            <div class="heading-2 quote-classic-big-text">
                                <div class="q">@lang('messages.america_best_furniture')</div>
                            </div>
                        </article>
                        <!-- Bootstrap tabs-->
                        <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
                            <!-- Nav tabs-->
                            <div class="nav-tabs-wrap">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-1" data-toggle="tab">@lang('messages.about')</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-2" data-toggle="tab">@lang('messages.our_mission')</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-toggle="tab">@lang('messages.our_goals')</a></li>
                                </ul>
                            </div>
                            <!-- Tab panes-->
                            <div class="tab-content About_tabs">
                                <div class="tab-pane fade" id="tabs-1-1">
                                    <p>@lang('messages.about_tab_content')</p>
                                </div>
                                <div class="tab-pane fade show active" id="tabs-1-2">
                                    <p>@lang('messages.mission_tab_content')</p>
                                </div>
                                <div class="tab-pane fade" id="tabs-1-3">
                                    <p>@lang('messages.goals_tab_content')</p>
                                </div>
                            </div>
                        </div>
                        <a class="button button-sm button-primary button-zakaria" href="{{route('web.shop')}}">@lang('messages.shop_now')</a>
                    </div>
                    <div class="col-md-11 col-lg-6 col-xl-7">
                        <div class="inset-xl-left-35 about-us-video">
                            <video
                                class="w-100"
                                style="max-height: 480px; border-radius: 6px; object-fit: contain; background: #1a1a1a;"
                                src="{{ asset('emmy.mp4') }}"
                                controls
                                playsinline
                                preload="metadata"
                            ></video>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section History-->
        @include('web.components.our-history')

        <!-- Our team-->
        @include('web.components.our-team')

        <!-- Counter Modern-->
        <section class="parallax-container call_section_1">
            <div class="parallax-content section-md context-dark">
                <div class="container">
                    <div class="row row-30 justify-content-center">
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h2 class="counter-modern-number"><span class="counter">245</span> </h2>
                                <div class="counter-modern-decor"></div>
                                <h5 class="counter-modern-title">@lang('messages.exclusive_furnitures')</h5>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h2 class="counter-modern-number"><span class="counter">182</span> </h2>
                                <div class="counter-modern-decor"></div>
                                <h5 class="counter-modern-title">@lang('messages.custom_furniture')</h5>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h2 class="counter-modern-number"><span class="counter">1267</span> </h2>
                                <div class="counter-modern-decor"></div>
                                <h5 class="counter-modern-title">@lang('messages.satisfied_clients')</h5>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="counter-modern">
                                <h2 class="counter-modern-number"><span class="counter">47</span> </h2>
                                <div class="counter-modern-decor"></div>
                                <h5 class="counter-modern-title">@lang('messages.team_members')</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our brand-->
        @include('web.components.our-brand')
        @include('SEO.about-seo')

    </div>
</x-web-layout>
