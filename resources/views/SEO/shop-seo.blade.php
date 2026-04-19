<!-- Shop Page SEO Content - Hidden from users, visible for search engines -->
<div style="position: absolute; left: -9999px; top: -9999px;">
    <h1>Каталог Emmy Furniture - премиальный магазин мебели</h1>
    <h2>Премиальная мебель для ванной комнаты в Москве</h2>

    <p><strong>Emmy Furniture</strong> предлагает каталог премиальной мебели для ванной: зеркала, зеркальные шкафы, тумбы и коллекции для современных интерьеров. Все модели подобраны с учетом надежности, эстетики и ежедневного комфорта.</p>

    <h3>Что представлено в каталоге</h3>
    <ul>
        <li><strong>Зеркала для ванной</strong> - стильные модели разных форматов и размеров</li>
        <li><strong>Зеркальные шкафы</strong> - функциональные решения для хранения и организации пространства</li>
        <li><strong>Мебельные комплекты</strong> - гармоничные коллекции в едином дизайне</li>
        <li><strong>Влагостойкие решения</strong> - материалы и покрытия для эксплуатации в ванной комнате</li>
    </ul>

    <h3>Преимущества покупки в Emmy</h3>
    <p>Мы поддерживаем премиальный уровень сервиса: прозрачные условия заказа, удобный подбор моделей и внимательное сопровождение на каждом этапе покупки.</p>

    <h3>Удобный поиск и фильтрация</h3>
    <p>Используйте фильтры по категориям и цене, чтобы быстро найти подходящую мебель для ванной комнаты и сравнить варианты по параметрам.</p>

    <p><strong>Ключевые слова:</strong> каталог премиальной мебели, магазин мебели москва, мебель для ванной, зеркала для ванной, зеркальный шкаф купить, Emmy Furniture каталог, премиальная мебель для ванной</p>
</div>

<!-- Structured Data for Product Collection Page -->
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "CollectionPage",--}}
{{--        "name": "Магазин мебели - Emmy Furniture",--}}
{{--        "description": "Каталог премиальной мебели для дома и офиса в Москве",--}}
{{--        "url": "{{ url()->current() }}",--}}
{{--    "mainEntity": {--}}
{{--        "@type": "ItemList",--}}
{{--        "name": "Каталог мебели",--}}
{{--        "description": "Широкий выбор качественной мебели различных категорий",--}}
{{--        "numberOfItems": {{ $products->count() ?? 0 }},--}}
{{--        "itemListElement": [--}}
{{--    @if(isset($products) && $products->count() > 0)--}}
{{--        @foreach($products->take(10) as $product)--}}
{{--            {--}}
{{--                "@type": "ListItem",--}}
{{--                "position": {{ $loop->iteration }},--}}
{{--                    "item": {--}}
{{--                        "@type": "Product",--}}
{{--                        "name": "{{ $product->name }}",--}}
{{--                        "description": "{{ Str::limit(strip_tags($product->description), 100) }}",--}}
{{--                        "url": "{{ route('web.product', $product->id) }}",--}}
{{--                        "image": "{{ $product->photo1->file_url ?? asset('images/shop/product-placeholder.png') }}",--}}
{{--                        "offers": {--}}
{{--                            "@type": "Offer",--}}
{{--                            "price": "{{ $product->price }}",--}}
{{--                            "priceCurrency": "USD",--}}
{{--                            "availability": "https://schema.org/InStock"--}}
{{--                        }--}}
{{--                    }--}}
{{--                }{{ !$loop->last ? ',' : '' }}--}}
{{--        @endforeach--}}
{{--    @endif--}}
{{--    ]--}}
{{--}--}}
{{--}--}}
{{--</script>--}}

<!-- Breadcrumb Structured Data -->
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "BreadcrumbList",--}}
{{--        "itemListElement": [--}}
{{--            {--}}
{{--                "@type": "ListItem",--}}
{{--                "position": 1,--}}
{{--                "name": "Главная",--}}
{{--                "item": "{{ route('web.home') }}"--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 2,--}}
{{--            "name": "Магазин мебели",--}}
{{--            "item": "{{ route('web.shop') }}"--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 3,--}}
{{--            "name": "Каталог товаров",--}}
{{--            "item": "{{ url()->current() }}"--}}
{{--        }--}}
{{--    ]--}}
{{--}--}}
{{--</script>--}}

<!-- Local Business Structured Data -->
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "FurnitureStore",--}}
{{--        "name": "Emmy Furniture",--}}
{{--        "description": "Магазин премиальной мебели в Москве",--}}
{{--        "url": "{{ url('/') }}",--}}
{{--    "address": {--}}
{{--        "@type": "PostalAddress",--}}
{{--        "addressLocality": "Москва",--}}
{{--        "addressCountry": "DE"--}}
{{--    },--}}
{{--    "openingHours": [--}}
{{--        "Mo-Fr 10:00-18:00",--}}
{{--        "Sa 10:00-16:00"--}}
{{--    ],--}}
{{--    "priceRange": "$$",--}}
{{--    "hasOfferCatalog": {--}}
{{--        "@type": "OfferCatalog",--}}
{{--        "name": "Категории мебели",--}}
{{--        "itemListElement": [--}}
{{--            {--}}
{{--                "@type": "OfferCatalog",--}}
{{--                "name": "Мебель для гостиной",--}}
{{--                "itemListElement": [--}}
{{--                    {--}}
{{--                        "@type": "Offer",--}}
{{--                        "itemOffered": {--}}
{{--                            "@type": "Product",--}}
{{--                            "name": "Диваны и кресла"--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        "@type": "Offer",--}}
{{--                        "itemOffered": {--}}
{{--                            "@type": "Product",--}}
{{--                            "name": "Журнальные столики"--}}
{{--                        }--}}
{{--                    }--}}
{{--                ]--}}
{{--            },--}}
{{--            {--}}
{{--                "@type": "OfferCatalog",--}}
{{--                "name": "Спальная мебель",--}}
{{--                "itemListElement": [--}}
{{--                    {--}}
{{--                        "@type": "Offer",--}}
{{--                        "itemOffered": {--}}
{{--                            "@type": "Product",--}}
{{--                            "name": "Кровати и матрасы"--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        "@type": "Offer",--}}
{{--                        "itemOffered": {--}}
{{--                            "@type": "Product",--}}
{{--                            "name": "Шкафы и комоды"--}}
{{--                        }--}}
{{--                    }--}}
{{--                ]--}}
{{--            }--}}
{{--        ]--}}
{{--    }--}}
{{--}--}}
{{--</script>--}}
