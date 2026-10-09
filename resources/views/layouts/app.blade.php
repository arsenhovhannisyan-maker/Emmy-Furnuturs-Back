<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title & Basic Meta -->
    <title>{{ $meta->getTitle() }}</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $meta->getDescription() }}">
    <meta name="keywords" content="{{ $meta->getKeywords() }}">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Emmy">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $meta->getOgType() }}">
    <meta property="og:url" content="{{ $meta->getOgUrl() }}">
    <meta property="og:title" content="{{ $meta->getTitle() }}">
    <meta property="og:description" content="{{ $meta->getDescription() }}">
    <meta property="og:image" content="{{ $meta->getOgImage() }}">
    <meta property="og:site_name" content="Emmy">
    <meta property="og:locale" content="{{ app()->getLocale() }}">

    <!-- Twitter Card -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ $meta->getOgUrl() }}">
    <meta property="twitter:title" content="{{ $meta->getTitle() }}">
    <meta property="twitter:description" content="{{ $meta->getDescription() }}">
    <meta property="twitter:image" content="{{ $meta->getOgImage() }}">

    <!-- Alternate Languages -->
    @foreach(getSupportedLocales() as $locale)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ getCurrentAlternateHref($locale) }}"/>
    @endforeach

    <!-- Structured Data -->
{{--    <script type="application/ld+json">--}}
{{--        {--}}
{{--            "@context": "https://schema.org",--}}
{{--            "@type": "FurnitureStore",--}}
{{--            "name": "Emmy",--}}
{{--            "description": "{{ $meta->getDescription() }}",--}}
{{--        "url": "{{ url('/') }}",--}}
{{--        "logo": "{{ url('/img/logo.png') }}",--}}
{{--        "telephone": "+7-XXX-XXX-XX-XX",--}}
{{--        "email": "info@emmyfurniture.com",--}}
{{--        "address": {--}}
{{--            "@type": "PostalAddress",--}}
{{--            "streetAddress": "Ваш адрес",--}}
{{--            "addressLocality": "Ваш город",--}}
{{--            "postalCode": "XXXXXX",--}}
{{--            "addressCountry": "RU"--}}
{{--        },--}}
{{--        "openingHours": [--}}
{{--            "Mo-Fr 09:00-18:00",--}}
{{--            "Sa 10:00-16:00"--}}
{{--        ],--}}
{{--        "priceRange": "₽₽",--}}
{{--        "sameAs": [--}}
{{--            "https://www.instagram.com/emmyfurniture",--}}
{{--            "https://www.facebook.com/emmyfurniture"--}}
{{--        ]--}}
{{--    }--}}
{{--    </script>--}}

    <!-- Additional Schema for Website -->
{{--    <script type="application/ld+json">--}}
{{--        {--}}
{{--            "@context": "https://schema.org",--}}
{{--            "@type": "WebSite",--}}
{{--            "name": "Emmy",--}}
{{--            "url": "{{ url('/') }}",--}}
{{--        "potentialAction": {--}}
{{--            "@type": "SearchAction",--}}
{{--            "target": "{{ route('web.shop') }}?search={search_term_string}",--}}
{{--            "query-input": "required name=search_term_string"--}}
{{--        }--}}
{{--    }--}}
{{--    </script>--}}

    <!-- Preload Critical Resources -->
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
    <link rel="preload" href="{{ asset('js/app.js') }}" as="script">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div id="app">
    <!-- Improved Navigation with SEO-friendly links -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" title="Emmy - Главная страница">
                <img src="{{ asset('img/logo.png') }}" alt="Emmy - магазин мебели для ванной комнаты" width="120" height="40">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключить навигацию">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Main Navigation -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" title="Главная страница Emmy">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.shop') }}" title="Каталог мебели">Магазин</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about" title="О компании Emmy">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact" title="Контакты мебельного магазина">Контакты</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <!-- Optional: Login/Register links -->
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Hidden SEO Text for better rankings -->
    <div style="position: absolute; left: -9999px; top: -9999px;">
        <h1>Emmy - магазин мебели для ванной комнаты</h1>
        <p>Купить мебель для ванной комнаты в интернет-магазине Emmy. {{ $meta->getKeywords() }}</p>
    </div>
</div>
</body>
</html>
