<footer class="section footer-modern footer-modern-2">
    <div class="footer-modern-body section-md">
        <div class="container container-new">
            <div class="row row-40 row-md-50 justify-content-between align-items-start responsive-flex">

                <!-- Categories Column -->
                <div class="col-md-5 wow fadeInUp col-md-new new-res" data-wow-delay=".1s">
                    <div class="footer-column">
                        <h5 class="footer-modern-title">@lang('messages.categories')</h5>
                        <ul class="footer-modern-list footer-categories-list">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('web.products', ['categoryId' => $category['id']]) }}">
                                        <span class="link-bullet">•</span>
                                        {{ $category['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Navigation Column -->
                <div class="col-md-4 wow fadeInUp new-res" data-wow-delay=".2s">
                    <div class="footer-column">
                        <h5 class="footer-modern-title">@lang('messages.navigation')</h5>
                        <ul class="footer-modern-list">
                            <li><a href="{{ route('web.home') }}">@lang('messages.home')</a></li>
                            <li><a href="{{ route('web.about') }}">@lang('messages.about_us')</a></li>
                            <li><a href="{{ route('web.team') }}">@lang('messages.our_team')</a></li>
                            <li><a href="{{ route('web.shop') }}">@lang('messages.shop')</a></li>
                            <li><a href="{{ route('web.contact-us') }}">@lang('messages.contact_us')</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Get in Touch Column -->
                <div class="col-md-3 wow fadeInUp new-res" data-wow-delay=".3s">
                    <div class="footer-column">
                        <h5 class="footer-modern-title">@lang('messages.get_in_touch')</h5>
                        <ul class="contacts-creative">
                            <li>
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <span class="icon mdi mdi-map-marker"></span>
                                    </div>
                                    <div class="contact-content">
                                        <span class="contact-text">272B Støk, 1st Floor<br>DC Office, Washington, USA</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <span class="icon mdi mdi-phone"></span>
                                    </div>
                                    <div class="contact-content">
                                        <a href="tel:+01-23-4226789" class="contact-link">+01-23-4226789</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <span class="icon mdi mdi-email-outline"></span>
                                    </div>
                                    <div class="contact-content">
                                        <a href="mailto:hello@example.com" class="contact-link">hello@example.com</a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <!-- Brand/Logo in Get in Touch Column -->
                        <div class="footer-brand-mini mt-4">
                            <div class="footer-logo mb-3">
                                <a href="{{ route('web.home') }}">
                                    <img class="logo-default" src="{{ asset('img/about/logo-emmy.png') }}" alt="@lang('messages.logo_alt')" width="120">
                                </a>
                            </div>
                            <p class="footer-text-small">
                                Lorem ipsum is simply dummy text of the printing and typesetting industry. It has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-modern-panel text-center">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 text-md-start">
                    <p class="copyright-text mb-0">
                        © 2024 All rights reserved.
                        <a href="https://netframe.am/" target="_blank" rel="noopener noreferrer">
                            NetFrame
                        </a>. All rights reserved.
                        <a href="{{ route('web.privacy.policy') }}">Privacy Policy</a>
                    </p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <div class="payment-methods">
                        <div class="payment-icons">
{{--                            <img src="{{ asset('img/payments/Visa.png') }}" alt="Visa" loading="lazy">--}}
{{--                            <img src="{{ asset('img/payments/MasterCard.png') }}" alt="Mastercard" loading="lazy">--}}
                            <img src="{{ asset('img/payments/sbp.png') }}" alt="PayPal" loading="lazy">
                            <img src="{{ asset('img/payments/Mir.png') }}" alt="Apple Pay" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        color: #333;
        padding: 70px 0 0;
        /*border-top: 3px solid #007bff;*/
        box-shadow: 0 -5px 30px rgba(0, 123, 255, 0.1);
    }

    .footer-column {
        margin-bottom: 35px;
    }

    .footer-modern-title {
        color: #2c3e50;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 15px;
        letter-spacing: 0.5px;
    }

    .footer-modern-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .footer-column:hover .footer-modern-title::after {
        width: 70px;
    }

    /* Categories List */
    .footer-categories-list {
        list-style: none;
        padding: 0;
        margin: 0;
        column-count: 2;
        column-gap: 25px;
        -webkit-column-count: 2;
        -moz-column-count: 2;
    }

    .footer-categories-list li {
        margin-bottom: 12px;
        break-inside: avoid;
        -webkit-column-break-inside: avoid;
        page-break-inside: avoid;
        display: inline-block;
        width: 110%;
    }


    .footer-categories-list a {
        color: #555;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        display: block;
        padding: 8px 20px;
        border-radius: 8px;
        background: rgba(0, 123, 255, 0.05);
        border: 1px solid rgba(0, 123, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .footer-categories-list a:hover {
        color: #007bff;
        background: rgba(0, 123, 255, 0.1);
        border-color: rgba(0, 123, 255, 0.3);
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
    }

    .link-bullet {
        color: #007bff;
        margin-right: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .footer-categories-list a:hover .link-bullet {
        transform: scale(1.3);
        color: #00c6ff;
    }

    /* Navigation List */
    .footer-modern-list:not(.footer-categories-list) {
        list-style: none;
        padding: 0;
        margin: 0;
        display: block;
        width: 100%;
    }

    .footer-modern-list:not(.footer-categories-list) li {
        margin-bottom: 10px;
    }

    .footer-modern-list:not(.footer-categories-list) a {
        color: #555;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        display: block;
        padding: 10px 45px;
        border-radius: 8px;
        background: rgba(0, 123, 255, 0.03);
        border-left: 3px solid transparent;
    }

    .footer-modern-list:not(.footer-categories-list) a:hover {
        color: #007bff;
        background: rgba(0, 123, 255, 0.1);
        border-left-color: #007bff;
        transform: translateX(8px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
    }

    /* Contact Section */
    .contacts-creative {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contacts-creative li {
        margin-bottom: 20px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px;
        background: rgba(0, 123, 255, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(0, 123, 255, 0.1);
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        background: rgba(0, 123, 255, 0.1);
        border-color: rgba(0, 123, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15);
    }

    .contact-icon {
        color: #007bff;
        font-size: 1.3rem;
        margin-top: 2px;
        flex-shrink: 0;
        width: 24px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .contact-item:hover .contact-icon {
        color: #00c6ff;
        transform: scale(1.1);
    }

    .contact-content {
        flex: 1;
    }

    .contact-text {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.5;
        font-weight: 500;
    }

    .contact-link {
        color: #555;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .contact-link:hover {
        color: #007bff;
    }

    .footer-brand-mini {
        padding-top: 25px;
        margin-top: 25px;
    }

    .footer-logo img {
        max-width: 140px;
        height: auto;
        transition: all 0.3s ease;
    }

    .footer-logo:hover img {
        transform: scale(1.05);
        filter: brightness(1.1);
    }

    .footer-text-small {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
        font-style: italic;
    }

    .footer-modern-panel {
        background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);
        padding: 25px 0;
        border-top: 1px solid rgba(0, 123, 255, 0.2);
        margin-top: 50px;
    }

    .copyright-text {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .copyright-text a {
        color: #007bff;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .copyright-text a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .payment-methods {
        display: flex;
        justify-content: flex-end;
    }

    .payment-icons {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .payment-icons img {
        width: 48px;
        height: 30px;
        object-fit: contain;
        opacity: 0.8;
        transition: all 0.3s ease;
        border-radius: 4px;
        background: white;
        padding: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin: 0;
    }

    .payment-icons img:hover {
        opacity: 1;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Ensure proper column layout */
    .row-40 .col-md-4 {
        width: 33.333333%;
        float: left;
        box-sizing: border-box;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-modern {
            padding: 50px 0 0;
        }
        .footer-categories-list li {
            width: 100% !important;
        }

            .footer-column {
            margin-bottom: 40px;
            text-align: center;
        }

        .footer-modern-title::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .footer-column:hover .footer-modern-title::after {
            width: 50px;
        }

        .contact-item {
            justify-content: center;
            text-align: center;
            flex-direction: column;
            gap: 10px;
        }

        .footer-modern-panel .row > div {
            text-align: center !important;
        }

        .row-40 .col-md-4 {
            width: 100%;
            float: none;
            margin-bottom: 40px;
        }

        /* Categories - Single column on mobile */
        .footer-categories-list {
            column-count: 1;
            -webkit-column-count: 1;
            -moz-column-count: 1;
        }

        .footer-categories-list a,
        .footer-modern-list:not(.footer-categories-list) a {
            text-align: center;
        }

        .footer-categories-list a:hover,
        .footer-modern-list:not(.footer-categories-list) a:hover {
            transform: translateY(-2px);
        }

        /* Payment methods responsive */
        .payment-methods {
            justify-content: center;
            margin-top: 15px;
        }

        .payment-icons {
            justify-content: center;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 576px) {
        .footer-modern-title {
            font-size: 1.2rem;
            margin-left: 15px;
        }

        .footer-modern-list a,
        .contact-link,
        .contact-text {
            font-size: 0.9rem;
        }

        .footer-categories-list a,
        .footer-modern-list:not(.footer-categories-list) a {
            padding: 12px 15px;
        }

        .payment-icons img {
            width: 42px;
            height: 26px;
        }
    }

    /* Clear floats */
    .row-40::after {
        content: "";
        display: table;
        clear: both;
    }

    .footer-modern-list:not(.footer-categories-list) {
        column-count: 1 !important;
        -webkit-column-count: 1 !important;
        -moz-column-count: 1 !important;
    }

    .footer-modern-list:not(.footer-categories-list) li {
        width: 100% !important;
        display: block !important;
        float: none !important;
    }
</style>
