<!-- Product Page SEO Content - Hidden from users, visible for search engines -->
<div style="position: absolute; left: -9999px; top: -9999px;">
    <h1>{{ $product->name }} - премиальная мебель Emmy Furniture</h1>
    <h2>Купить {{ $product->name }} в премиальном магазине мебели в Москве</h2>

    <p><strong>{{ $product->name }}</strong> от Emmy Furniture - модель премиального сегмента с акцентом на качество материалов, комфорт использования и актуальный дизайн. Товар подходит для современных интерьеров ванной комнаты и других функциональных зон.</p>

    <h3>Основные характеристики</h3>
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
        <li><strong>Класс:</strong> премиальная мебель</li>
        <li><strong>Сервис:</strong> консультация и доставка по Москве</li>
    </ul>

    <h3>Преимущества модели</h3>
    <p>Продукт сочетает визуальную выразительность и практичность: устойчивые материалы, продуманная геометрия и надежная фурнитура помогают сохранять внешний вид и функциональность в ежедневной эксплуатации.</p>

    <p><strong>Ключевые слова:</strong> {{ $product->name }} купить москва, премиальная мебель, {{ $product->categories->name }} москва, Emmy Furniture, мебель для ванной купить, доставка мебели по москве</p>
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
{{--        "name": "Emmy Furniture"--}}
{{--    },--}}
{{--    "offers": {--}}
{{--        "@type": "Offer",--}}
{{--        "price": "{{ $product->min_price }}",--}}
{{--        "priceCurrency": "RUB",--}}
{{--        "availability": "https://schema.org/InStock",--}}
{{--        "seller": {--}}
{{--            "@type": "Organization",--}}
{{--            "name": "Emmy Furniture"--}}
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
