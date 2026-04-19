<x-web-layout :seo-keywords="__('messages.seo_blog_keywords')">
    <div class="page">
        <!--+breadcrumbs-->
        <section class="breadcrumbs-custom">
            <div class="parallax-container breadcrumbs_section">
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                    <div class="container">
                        <h1 class="breadcrumbs-custom-title">@lang('messages.blog_list')</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="{{ url('/') }}">@lang('messages.home')</a></li>
                        <li><a href="{{ route('web.blog') }}">@lang('messages.blog')</a></li>
                        <li class="active">@lang('messages.blog_list')</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Section Shop-->
        <section class="section section-md bg-default text-md-left">
            <div class="container">
                <div class="row row-50 row-md-60">
                    <div class="col-lg-12 col-xl-12">
                        <div class="inset-xl-right-70">
                            <div class="row row-50 row-md-60">

                                @foreach($blogs as $blog)
                                    <div class="col-12">
                                        <!-- Post Modern-->
                                        <article class="post post-modern box-xxl">
                                            <div class="post-modern-panel">
                                                <div><a class="post-modern-tag" href="#">@lang('messages.news')</a></div>
                                                <div>
                                                    <time class="post-modern-time" datetime="{{ $blog['created_at_formatted'] }}">
                                                        {{ $blog['created_at_formatted'] }}
                                                    </time>
                                                </div>
                                            </div>
                                            <h3 class="post-modern-title">
                                                <a href="{{ url('blog/'.$blog['id']) }}">
                                                    {{ $blog['name'] }}
                                                </a>
                                            </h3>
                                            <a class="post-modern-figure" href="{{ url('blog/'.$blog['id']) }}">
                                                <img src="{{ $blog['photo'] }}" alt="{{ $blog['name'] }}" width="800" height="394" />
                                            </a>
                                            <p class="post-modern-text">
                                                {{ $blog['shortDescription'] }}
                                            </p>
                                            <a class="post-modern-link" href="{{ url('blog/'.$blog['id']) }}">@lang('messages.read_more')</a>
                                        </article>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('web.components.our-brand')
        @include('SEO.blog-list-seo')

    </div>
</x-web-layout>
