<!-- Cart Page SEO Content - Hidden from users, visible for search engines -->
<div style="position: absolute; left: -9999px; top: -9999px;">
    <h1>Корзина покупок - Emmy Furniture Munich</h1>
    <h2>Ваши выбранные товары в мебельном магазине Мюнхена</h2>

    <p><strong>Emmy Furniture Munich</strong> - ваша корзина покупок содержит выбранные товары для дома и офиса. Просмотрите список товаров, измените количество или удалите ненужные позиции перед оформлением заказа.</p>

    <h3>Управление корзиной покупок</h3>
    <ul>
        <li><strong>Просмотр товаров</strong> - Все выбранные товары с фотографиями и описаниями</li>
        <li><strong>Изменение количества</strong> - Легко увеличивайте или уменьшайте количество товаров</li>
        <li><strong>Удаление товаров</strong> - Удаляйте ненужные позиции одним кликом</li>
        <li><strong>Автоматический пересчет</strong> - Сумма заказа пересчитывается автоматически</li>
        <li><strong>Безопасное хранение</strong> - Товары сохраняются в корзине до оформления заказа</li>
    </ul>

    <h3>Процесс покупки</h3>
    <p>После добавления товаров в корзину вы можете:</p>
    <ol>
        <li>Проверить состав заказа и общую стоимость</li>
        <li>Внести изменения в количество товаров</li>
        <li>Удалить ненужные позиции</li>
        <li>Перейти к оформлению заказа</li>
        <li>Выбрать способ доставки и оплаты</li>
        <li>Подтвердить заказ и получить подтверждение</li>
    </ol>

    <h3>Преимущества покупки в Emmy Furniture Munich</h3>
    <ul>
        <li><strong>Качественная мебель</strong> - Только проверенные производители и материалы</li>
        <li><strong>Честные цены</strong> - Прозрачное ценообразование без скрытых платежей</li>
        <li><strong>Бесплатная доставка</strong> - Доставка по Мюнхену при заказе от определенной суммы</li>
        <li><strong>Профессиональная сборка</strong> - Помощь в сборке мебели при необходимости</li>
        <li><strong>Гарантия качества</strong> - Гарантия на все товары от производителя</li>
    </ul>

    <h3>Часто задаваемые вопросы о корзине</h3>
    <p><strong>Сколько времени товары хранятся в корзине?</strong><br>
        Товары сохраняются в вашей корзине в течение 30 дней. Вы можете вернуться к оформлению заказа в любое удобное время.</p>

    <p><strong>Можно ли изменить заказ после оформления?</strong><br>
        Да, вы можете связаться с нами в течение 24 часов после оформления заказа для внесения изменений.</p>

    <p><strong>Есть ли минимальная сумма заказа?</strong><br>
        Минимальная сумма заказа для бесплатной доставки по Мюнхену составляет 200 евро.</p>

    <h3>Следующие шаги после заполнения корзины</h3>
    <p>После того как вы добавили все нужные товары в корзину, нажмите кнопку "Перейти к оформлению заказа". Вас перенаправит на страницу оформления заказа, где вы сможете указать данные для доставки и выбрать способ оплаты.</p>

    <p><strong>Ключевые слова:</strong> корзина покупок мебель мюнхен, товары в корзине, оформление заказа мебели, покупка мебели онлайн, Emmy Furniture корзина, управление заказом, сумма заказа</p>
</div>

<!-- Structured Data for Shopping Cart Page -->
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "WebPage",--}}
{{--        "name": "Корзина покупок - Emmy Furniture Munich",--}}
{{--        "description": "Управление товарами в корзине перед оформлением заказа мебели",--}}
{{--        "url": "{{ url()->current() }}",--}}
{{--    "mainEntity": {--}}
{{--        "@type": "ItemList",--}}
{{--        "name": "Товары в корзине",--}}
{{--        "description": "Список выбранных товаров мебели",--}}
{{--        "numberOfItems": {{ $items->count() }},--}}
{{--        "itemListElement": [--}}
{{--    @if($items->count() > 0)--}}
{{--        @foreach($items as $item)--}}
{{--            {--}}
{{--                "@type": "ListItem",--}}
{{--                "position": {{ $loop->iteration }},--}}
{{--                    "item": {--}}
{{--                        "@type": "Product",--}}
{{--                        "name": "{{ $item->product->name }}",--}}
{{--                        "description": "{{ Str::limit(strip_tags($item->product->description), 100) }}",--}}
{{--                        "image": "{{ $item->product->photo1->file_url ?? asset('images/shop/product-placeholder.png') }}",--}}
{{--                        "offers": {--}}
{{--                            "@type": "Offer",--}}
{{--                            "price": "{{ $item->product->price }}",--}}
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
{{--            "name": "Магазин мебели",--}}
{{--            "item": "{{ route('web.shop') }}"--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "ListItem",--}}
{{--            "position": 3,--}}
{{--            "name": "Корзина покупок",--}}
{{--            "item": "{{ url()->current() }}"--}}
{{--        }--}}
{{--    ]--}}
{{--}--}}
{{--</script>--}}

{{--<!-- Shopping Action Structured Data -->--}}
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "Action",--}}
{{--        "name": "Перейти к оформлению заказа",--}}
{{--        "description": "Переход к оформлению заказа выбранных товаров мебели",--}}
{{--        "target": {--}}
{{--            "@type": "EntryPoint",--}}
{{--            "urlTemplate": "{{ route('order.checkout') }}",--}}
{{--        "actionPlatform": [--}}
{{--            "http://schema.org/DesktopWebPlatform",--}}
{{--            "http://schema.org/MobileWebPlatform"--}}
{{--        ]--}}
{{--    },--}}
{{--    "result": {--}}
{{--        "@type": "Order",--}}
{{--        "name": "Заказ мебели"--}}
{{--    }--}}
{{--}--}}
{{--</script>--}}

{{--<!-- Organization Structured Data -->--}}
{{--<script type="application/ld+json">--}}
{{--    {--}}
{{--        "@context": "https://schema.org",--}}
{{--        "@type": "Organization",--}}
{{--        "name": "Emmy Furniture Munich",--}}
{{--        "url": "{{ url('/') }}",--}}
{{--    "logo": "{{ asset('img/web/logo-emmy.png') }}",--}}
{{--    "description": "Магазин премиальной мебели в Мюнхене с удобной системой онлайн-заказов",--}}
{{--    "contactPoint": {--}}
{{--        "@type": "ContactPoint",--}}
{{--        "contactType": "customer service",--}}
{{--        "email": "emmy-web@mail.ru",--}}
{{--        "availableLanguage": ["de", "ru", "en"]--}}
{{--    },--}}
{{--    "areaServed": {--}}
{{--        "@type": "City",--}}
{{--        "name": "Мюнхен"--}}
{{--    },--}}
{{--    "makesOffer": [--}}
{{--        {--}}
{{--            "@type": "Offer",--}}
{{--            "itemOffered": {--}}
{{--                "@type": "Service",--}}
{{--                "name": "Бесплатная доставка",--}}
{{--                "description": "Бесплатная доставка мебели по Мюнхену при заказе от 200€"--}}
{{--            }--}}
{{--        },--}}
{{--        {--}}
{{--            "@type": "Offer",--}}
{{--            "itemOffered": {--}}
{{--                "@type": "Service",--}}
{{--                "name": "Сборка мебели",--}}
{{--                "description": "Профессиональная сборка мебели на дому"--}}
{{--            }--}}
{{--        }--}}
{{--    ]--}}
{{--}--}}
{{--</script>--}}
