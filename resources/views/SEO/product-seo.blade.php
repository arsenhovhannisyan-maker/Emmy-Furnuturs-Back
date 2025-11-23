<!-- Product Page SEO Content - Hidden from users, visible for search engines -->
<div style="position: absolute; left: -9999px; top: -9999px;">
    <h1>{{ $product->name }} - Купить в Emmy Furniture Munich</h1>
    <h2>Премиальная мебель {{ $product->name }} в Мюнхене</h2>

    <p><strong>{{ $product->name }}</strong> - {{ $product->description }}. Доступно для покупки в мебельном магазине Emmy Furniture Munich. Высокое качество материалов, европейское производство, доставка по Мюнхену и всей Германии.</p>

    <h3>Характеристики товара {{ $product->name }}</h3>
    <ul>
        <li><strong>Категория:</strong> {{ $product->categories->name }}</li>
        <li><strong>Цена:</strong> от {{ $product->min_price }} руб.</li>
        @if($product->sizes->isNotEmpty())
            <li><strong>Доступные размеры:</strong>
                @foreach($product->sizes as $size)
                    {{ $size->size }}{{ !$loop->last ? ',' : '' }}
                @endforeach
            </li>
        @endif
        <li><strong>Качество:</strong> Премиальные материалы</li>
        <li><strong>Доставка:</strong> По всему Мюнхену</li>
    </ul>

    <h3>Почему выбирают {{ $product->name }}?</h3>
    <p>Этот товар отличается исключительным качеством сборки, использованием экологичных материалов и современным дизайном. Идеально подходит для обустройства дома в Мюнхене.</p>

    <h3>Доставка и оплата</h3>
    <p>Быстрая доставка мебели {{ $product->name }} по Мюнхену: центр города, Швабинг, Максфорштадт, Хайдхаузен, Зендлинг, Гизинг, Пазинг и все surrounding районы. Профессиональная сборка и гарантия качества.</p>

    <p><strong>Ключевые слова:</strong> {{ $product->name }} купить мюнхен, мебель {{ $product->name }}, {{ $product->categories->name }} мюнхен, премиальная мебель, магазин мебели Emmy Furniture, доставка мебели в Мюнхене</p>
</div>

{{--<!-- Structured Data for Product -->--}}
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "Product",--}}
{{--        "name": "{{ $product->name }}",--}}
{{--    "description": "{{ $product->description }}",--}}
{{--    "category": "{{ $product->categories->name }}",--}}
{{--    "url": "{{ url()->current() }}",--}}
{{--    "image": [--}}
{{--    @foreach([$product->photo1, $product->photo2, $product->photo3, $product->photo4] as $photo)--}}
{{--        @if($photo)"{{ $photo->file_url }}"{{ !$loop->last ? ',' : '' }}@endif--}}
{{--    @endforeach--}}
{{--    ],--}}
{{--    "brand": {--}}
{{--        "@type": "Brand",--}}
{{--        "name": "Emmy Furniture Munich"--}}
{{--    },--}}
{{--    "offers": {--}}
{{--        "@type": "Offer",--}}
{{--        "price": "{{ $product->min_price }}",--}}
{{--        "priceCurrency": "RUB",--}}
{{--        "availability": "https://schema.org/InStock",--}}
{{--        "seller": {--}}
{{--            "@type": "Organization",--}}
{{--            "name": "Emmy Furniture Munich"--}}
{{--        }--}}
{{--    }@if($product->sizes->isNotEmpty()),--}}
{{--    "additionalProperty": [--}}
{{--    @foreach($product->sizes as $size)--}}
{{--        {--}}
{{--            "@type": "PropertyValue",--}}
{{--            "name": "Размер",--}}
{{--            "value": "{{ $size->size }}"--}}
{{--        }{{ !$loop->last ? ',' : '' }}--}}
{{--    @endforeach--}}
{{--    ]--}}
{{--    @endif--}}
{{--    }--}}
{{--</script>--}}

{{--<!-- Breadcrumb Structured Data -->--}}
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
{{--            "name": "Магазин",--}}
{{--            "item": "{{ route('web.shop') }}"--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 3,--}}
{{--            "name": "{{ $product->name }}",--}}
{{--            "item": "{{ url()->current() }}"--}}
{{--        }--}}
{{--    ]--}}
{{--}--}}
{{--</script>--}}
