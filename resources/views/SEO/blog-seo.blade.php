
<!-- Blog Post SEO Content - Hidden from users, visible for search engines -->
<div style="position: absolute; left: -9999px; top: -9999px;">
    <h1>{{ $blog->name }} - Блог Emmy Furniture</h1>
    <h2>Статьи о премиальной мебели и интерьерах ванных комнат</h2>

    <p><strong>{{ $blog->name }}</strong> - подробная статья в блоге мебельного магазина Emmy Furniture. {{ Str::limit(strip_tags($blog->description), 200) }}</p>

    <h3>Ключевые темы статьи</h3>
    <ul>
        <li>Премиальные тенденции в мебели для ванной комнаты</li>
        <li>Современный интерьер и практичные решения</li>
        <li>Качество материалов и долговечность мебели</li>
        <li>Советы по выбору зеркал, шкафов и комплектов</li>
    </ul>

    <h3>О блоге Emmy Furniture</h3>
    <p>В блоге Emmy Furniture мы публикуем экспертные материалы о премиальной мебели, функциональных решениях для ванной и актуальном дизайне. Контент помогает выбрать мебель осознанно и под задачи конкретного интерьера.</p>

    <h3>Почему стоит читать наш блог?</h3>
    <p>Мы публикуем только проверенную информацию от дизайнеров интерьера и специалистов по мебели. Наши статьи помогают сделать осознанный выбор при покупке мебели и создать гармоничное пространство в вашем доме.</p>

    <p><strong>Ключевые слова:</strong> {{ $blog->name }}, блог о премиальной мебели, мебель для ванной москва, статьи про зеркала и шкафы, Emmy Furniture блог, советы по выбору мебели для ванной</p>
</div>

<!-- Structured Data for Blog Post -->
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "BlogPosting",--}}
{{--        "mainEntityOfPage": {--}}
{{--            "@type": "WebPage",--}}
{{--            "@id": "{{ url()->current() }}"--}}
{{--    },--}}
{{--    "headline": "{{ $blog->name }}",--}}
{{--    "description": "{{ Str::limit(strip_tags($blog->description), 160) }}",--}}
{{--    "image": [--}}
{{--        "{{ $blog->photo?->file_url ?? '/images/blog/blog-detail-1.jpg' }}"--}}
{{--    ],--}}
{{--    "author": {--}}
{{--        "@type": "Organization",--}}
{{--        "name": "Emmy Furniture"--}}
{{--    },--}}
{{--    "publisher": {--}}
{{--        "@type": "Organization",--}}
{{--        "name": "Emmy Furniture",--}}
{{--        "logo": {--}}
{{--            "@type": "ImageObject",--}}
{{--            "url": "{{ asset('img/web/logo-emmy.png') }}"--}}
{{--        }--}}
{{--    },--}}
{{--    "datePublished": "{{ $blog->created_at->toIso8601String() }}",--}}
{{--    "dateModified": "{{ $blog->updated_at->toIso8601String() }}",--}}
{{--    "articleSection": "Мебель и дизайн интерьера",--}}
{{--    "keywords": "мебель, дизайн интерьера, обустройство дома, мебель москва"--}}
{{--}--}}
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
{{--            "name": "Блог о мебели",--}}
{{--            "item": "{{ route('web.blog') }}"--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 3,--}}
{{--            "name": "{{ $blog->name }}",--}}
{{--            "item": "{{ url()->current() }}"--}}
{{--        }--}}
{{--    ]--}}
{{--}--}}
{{--</script>--}}

{{--<!-- Related Posts Structured Data -->--}}
{{--@if($relatedBlogs->count())--}}
{{--    <script type="application/ld+json">--}}
{{--        {--}}
{{--            "@context": "https://schema.org",--}}
{{--            "@type": "ItemList",--}}
{{--            "name": "Похожие статьи о мебели",--}}
{{--            "description": "Другие интересные статьи из блога Emmy Furniture",--}}
{{--            "numberOfItems": {{ $relatedBlogs->count() }},--}}
{{--    "itemListElement": [--}}
{{--        @foreach($relatedBlogs as $related)--}}
{{--            {--}}
{{--                "@type": "ListItem",--}}
{{--                "position": {{ $loop->iteration }},--}}
{{--            "item": {--}}
{{--                "@type": "BlogPosting",--}}
{{--                "name": "{{ $related->name }}",--}}
{{--                "url": "{{ route('web.getSingleBlog', $related->id) }}",--}}
{{--                "image": "{{ $related->photo?->file_url ?? '/images/blog/blog-home-1.jpg' }}",--}}
{{--                "datePublished": "{{ $related->created_at->toIso8601String() }}"--}}
{{--            }--}}
{{--        }{{ !$loop->last ? ',' : '' }}--}}
{{--        @endforeach--}}
{{--        ]--}}
{{--    }--}}
{{--    </script>--}}
{{--@endif--}}
