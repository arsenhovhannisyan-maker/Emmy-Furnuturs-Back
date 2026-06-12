<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? __('messages.login') }}</title>

    <link rel="icon" href="{{ asset('img/web/tab-photo.png') }}?v={{ @filemtime(public_path('img/web/tab-photo.png')) }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --auth-accent: #50BECF;
            --auth-accent-hover: #626469;
            --auth-bg: #eef2f4;
            --auth-card: #ffffff;
            --auth-text: #2f3740;
            --auth-muted: #6e7781;
            --auth-border: #d7dee5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: var(--auth-text);
            background:
                radial-gradient(circle at 15% 15%, rgba(80, 190, 207, 0.16), transparent 35%),
                radial-gradient(circle at 85% 85%, rgba(80, 190, 207, 0.14), transparent 32%),
                var(--auth-bg);
        }

        .auth-header {
            width: 100%;
            padding: 5px 50px;
            background: #50BECF;
            border-bottom: 1px solid rgba(80, 190, 207, 0.35);
            backdrop-filter: blur(4px);
        }

        .auth-page {
            min-height: calc(100vh - 84px);
            padding: 32px 16px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-shell {
            width: 100%;
            max-width: 560px;
        }

        .auth-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--auth-text);
        }

        .auth-brand img {
            width: 72px;
            height: 72px;
            border-radius: 16px;
            object-fit: cover;
        }

        .auth-brand span {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .auth-card {
            width: 100%;
            max-width: 520px;
            background: var(--auth-card);
            border-radius: 22px;
            border: 1px solid rgba(80, 190, 207, 0.2);
            box-shadow: 0 16px 40px rgba(27, 39, 51, 0.14);
            padding: 34px 30px 28px;
        }

        .auth-title {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
            line-height: 1.2;
            text-align: center;
            color: var(--auth-text);
        }

        .auth-subtitle {
            margin: 8px 0 26px;
            text-align: center;
            font-size: 14px;
            color: var(--auth-muted);
        }

        .auth-label {
            display: inline-block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #46515d;
        }

        .auth-input {
            width: 100%;
            border: 1px solid var(--auth-border);
            border-radius: 12px;
            height: 46px;
            padding: 0 14px;
            font-size: 14px;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .auth-input:focus {
            border-color: var(--auth-accent);
            box-shadow: 0 0 0 0.2rem rgba(80, 190, 207, 0.25);
            outline: 0;
        }

        .auth-submit {
            width: 100%;
            border: 0;
            border-radius: 12px;
            height: 44px;
            background: var(--auth-accent);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .3px;
            text-transform: uppercase;
            transition: background-color .2s ease, transform .2s ease, box-shadow .2s ease;
        }

        .auth-submit:hover {
            background: var(--auth-accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(80, 190, 207, 0.3);
        }

        .auth-helper {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
            color: var(--auth-muted);
        }

        .auth-helper a {
            color: var(--auth-accent);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-helper a:hover {
            color: var(--auth-accent-hover);
            text-decoration: underline;
        }

        .auth-header .auth-brand {
            color: #fff;
        }
    </style>
</head>
<body>
    <header class="auth-header">
        <a class="auth-brand" href="{{ url('/') }}" aria-label="Emmy home">
            <img src="{{ asset('img/web/tab-photo-2.png') }}" alt="Emmy logo">
            <span>Emmy</span>
        </a>
    </header>

    <div class="auth-page">
        <div class="auth-shell">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
