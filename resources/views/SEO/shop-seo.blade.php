<!-- Shop Page SEO Content - Hidden from users, visible for search engines -->
<div style="position: absolute; left: -9999px; top: -9999px;">
    <h1>Магазин мебели Emmy Furniture Munich - Каталог премиальной мебели</h1>
    <h2>Широкий выбор качественной мебели для дома и офиса в Мюнхене</h2>

    <p><strong>Emmy Furniture Munich</strong> предлагает обширный каталог премиальной мебели для гостиной, спальни, столовой, офиса и других помещений. У нас вы найдете мебель различных стилей - от классического до современного минимализма.</p>

    <h3>Категории мебели в нашем магазине</h3>
    <ul>
        <li><strong>Мебель для гостиной</strong> - Диваны, кресла, журнальные столики, ТВ-тумбы, комоды</li>
        <li><strong>Спальная мебель</strong> - Кровати, матрасы, шкафы, прикроватные тумбочки, гарнитуры</li>
        <li><strong>Обеденные группы</strong> - Обеденные столы, стулья, буфеты, серванты, барные стойки</li>
        <li><strong>Офисная мебель</strong> - Письменные столы, офисные кресла, книжные полки, шкафы для документов</li>
        <li><strong>Мебель для прихожей</strong> - Консоли, вешалки, банкетки, зеркала, полки для обуви</li>
        <li><strong>Детская мебель</strong> - Кровати, письменные столы, стулья, шкафы для детской комнаты</li>
    </ul>

    <h3>Преимущества покупки в нашем магазине</h3>
    <p>Мы тщательно отбираем каждую модель мебели, учитывая качество материалов, долговечность и современный дизайн. Все товары проходят строгий контроль качества перед поступлением в продажу.</p>

    <h3>Фильтрация и поиск товаров</h3>
    <p>Используйте удобные фильтры по цене и категориям чтобы быстро найти подходящую мебель. Наша система поиска поможет locate именно то, что вам нужно для обустройства дома в Мюнхене.</p>

    <h3>Доставка и обслуживание</h3>
    <p>Бесплатная доставка по всему Мюнхену, профессиональная сборка и гарантия на все товары. Мы обслуживаем все районы города включая центр, Швабинг, Максфорштадт, Хайдхаузен и другие.</p>

    <p><strong>Ключевые слова:</strong> магазин мебели мюнхен, купить мебель в мюнхене, каталог мебели, мебель для гостиной, спальная мебель, офисная мебель, мебельный магазин Emmy Furniture, доставка мебели мюнхен, цены на мебель</p>
</div>

<!-- Structured Data for Product Collection Page -->
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "CollectionPage",--}}
{{--        "name": "Магазин мебели - Emmy Furniture Munich",--}}
{{--        "description": "Каталог премиальной мебели для дома и офиса в Мюнхене",--}}
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
{{--                        "url": "{{ route('dashboard.web.product', $product->id) }}",--}}
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
{{--        "name": "Emmy Furniture Munich",--}}
{{--        "description": "Магазин премиальной мебели в Мюнхене",--}}
{{--        "url": "{{ url('/') }}",--}}
{{--    "address": {--}}
{{--        "@type": "PostalAddress",--}}
{{--        "addressLocality": "Мюнхен",--}}
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
