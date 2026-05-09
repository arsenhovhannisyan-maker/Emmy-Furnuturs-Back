<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, follow">
    <title>@lang('messages.page_not_found') — Emmy</title>
    <link rel="icon" href="{{ asset('img/web/tab-photo.png') }}?v={{ @filemtime(public_path('img/web/tab-photo.png')) }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --emmy-accent: #39b3b8;
            --emmy-accent-soft: rgba(57, 179, 184, 0.14);
            --emmy-accent-hover: #2a9ca1;
            --emmy-bg: #eef2f4;
            --emmy-card: #ffffff;
            --emmy-text: #2f3740;
            --emmy-muted: #6e7781;
            --emmy-border: #d7dee5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: var(--emmy-text);
            background:
                radial-gradient(circle at 12% 18%, rgba(57, 179, 184, 0.18), transparent 38%),
                radial-gradient(circle at 88% 82%, rgba(57, 179, 184, 0.12), transparent 34%),
                var(--emmy-bg);
        }

        .err-header {
            width: 100%;
            padding: 10px 40px;
            background: rgb(90, 187, 190);
            border-bottom: 1px solid rgba(57, 179, 184, 0.22);
        }

        .err-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--emmy-text);
        }

        .err-brand img {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            object-fit: cover;
            box-shadow: 0 4px 14px rgba(27, 39, 51, 0.12);
        }

        .err-brand span {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .err-wrap {
            min-height: calc(100vh - 96px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 18px 48px;
        }

        .err-panel {
            width: 100%;
            max-width: 560px;
            background: var(--emmy-card);
            border-radius: 24px;
            border: 1px solid rgba(57, 179, 184, 0.14);
            box-shadow: 0 20px 50px rgba(27, 39, 51, 0.12);
            padding: 40px 36px 36px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .err-panel::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -25%;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, var(--emmy-accent-soft), transparent 70%);
            pointer-events: none;
        }

        .err-code {
            margin: 0;
            font-size: clamp(4.5rem, 14vw, 6.5rem);
            font-weight: 800;
            line-height: 0.95;
            letter-spacing: -0.06em;
            background: linear-gradient(135deg, #39b3b8 0%, #2a8f94 45%, #5abbbd 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
            z-index: 1;
        }

        .err-badge {
            display: inline-block;
            margin-top: 14px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--emmy-accent-hover);
            background: rgba(57, 179, 184, 0.12);
            border: 1px solid rgba(57, 179, 184, 0.25);
        }

        .err-title {
            margin: 22px 0 12px;
            font-size: 1.55rem;
            font-weight: 700;
            color: var(--emmy-text);
            position: relative;
            z-index: 1;
        }

        .err-text {
            margin: 0 auto;
            max-width: 420px;
            font-size: 15px;
            line-height: 1.65;
            color: var(--emmy-muted);
            position: relative;
            z-index: 1;
        }

        .err-actions {
            margin-top: 28px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .err-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 22px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease;
        }

        .err-btn--primary {
            border: 0;
            background: var(--emmy-accent);
            color: #fff;
            text-transform: uppercase;
        }

        .err-btn--primary:hover {
            background: var(--emmy-accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(57, 179, 184, 0.28);
        }

        .err-btn--ghost {
            border: 1px solid var(--emmy-border);
            background: #fff;
            color: var(--emmy-text);
        }

        .err-btn--ghost:hover {
            border-color: var(--emmy-accent);
            color: var(--emmy-accent-hover);
            transform: translateY(-1px);
        }

        .err-icon {
            margin: 8px auto 0;
            width: 120px;
            height: 72px;
            opacity: 0.85;
            position: relative;
            z-index: 1;
        }

        .err-icon svg {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 480px) {
            .err-header {
                padding: 8px 18px;
            }

            .err-panel {
                padding: 32px 22px 28px;
            }
        }
    </style>
</head>
<body>
    <header class="err-header">
        <a class="err-brand" href="{{ route('web.home') }}" aria-label="Emmy — главная">
            <img src="{{ asset('img/web/tab-photo.png') }}" alt="Emmy">
            <span>Emmy</span>
        </a>
    </header>

    <main class="err-wrap">
        <div class="err-panel">
            <p class="err-code" aria-hidden="true">404</p>
            <span class="err-badge">@lang('messages.error_404')</span>
            <h1 class="err-title">@lang('messages.page_not_found')</h1>
            <p class="err-text">@lang('messages.error_404_description')</p>

            <div class="err-icon" aria-hidden="true">
                <svg viewBox="0 0 120 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 58h104v6H8v-6z" fill="#39b3b8" opacity=".35"/>
                    <path d="M18 46h84c3.3 0 6 2.7 6 6v6H12v-6c0-3.3 2.7-6 6-6z" fill="#39b3b8" opacity=".55"/>
                    <path d="M24 28h72c2.2 0 4 1.8 4 4v14H20V32c0-2.2 1.8-4 4-4z" fill="#39b3b8"/>
                    <path d="M28 18h64c2.2 0 4 1.8 4 4v6H24v-6c0-2.2 1.8-4 4-4z" fill="#5abbbd"/>
                    <circle cx="88" cy="22" r="4" fill="#eef2f4" opacity=".9"/>
                </svg>
            </div>

            <div class="err-actions">
                <a class="err-btn err-btn--primary" href="{{ route('web.home') }}">@lang('messages.go_to_home_page')</a>
                <a class="err-btn err-btn--ghost" href="{{ route('web.shop') }}">@lang('messages.error_404_catalog')</a>
            </div>
        </div>
    </main>
</body>
</html>
