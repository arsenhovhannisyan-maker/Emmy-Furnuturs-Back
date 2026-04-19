<x-web-layout :seo-keywords="__('messages.seo_gallery_keywords')">
    <div class="page">
        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.masonry_gallery')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ url('/') }}">@lang('messages.home')</a></li>
                        <li><a href="{{ route('web.gallery') }}">@lang('messages.gallery')</a></li>
                        <li class="active">@lang('messages.masonry_gallery')</li>
                    </ul>
                </div>
            </div>
        </section>
        @include('web.components.gallery')

        @include('web.components.our-brand')
        @include('SEO.gallery-seo')

    </div>
</x-web-layout>
