<x-web-layout :seo-keywords="__('messages.seo_team_keywords')">
    <div class="page">

        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.our_team')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ url('/') }}">@lang('messages.home')</a></li>
                        <li><a href="#">@lang('messages.pages')</a></li>
                        <li class="active">@lang('messages.our_team')</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Team Classic-->
        <section class="section section-sm section-first bg-default">
            <div class="container">
                <h3 class="font-weight-regular">#1</h3>
                <!-- Our team-->
                @include('web.components.our-team')
            </div>
        </section>

        <!-- Our brand-->
        @include('web.components.our-brand')
        @include('SEO.team-seo')

    </div>
</x-web-layout>
