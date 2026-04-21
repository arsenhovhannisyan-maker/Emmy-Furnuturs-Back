@extends('layouts.auth')

@section('content')
    <style>
        body {
            background-color: #E9E9E7 !important;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-card {
            background: #fff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            max-width: 650px;
            width: 100%;
            padding: 40px 35px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-weight: 700;
            font-size: 28px;
            color: #333;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1px solid #ccc;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #39B3B8;
            box-shadow: 0 0 0 0.2rem rgba(57, 179, 184, 0.25);
        }

        .btn-primary {
            background-color: #39B3B8;
            border: none;
            border-radius: 10px;
            padding: 10px 0;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2a9ca1;
            box-shadow: 0 6px 15px rgba(57, 179, 184, 0.3);
        }

        .remember-me {
            font-size: 14px;
            color: #555;
        }

        .footer-text {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 25px;
        }

        .footer-text a {
            color: #39B3B8;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>@lang('messages.auth_login_title')</h2>
                <p>@lang('messages.auth_login_subtitle')</p>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">@lang('messages.email')</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">@lang('messages.auth_password')</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label remember-me" for="remember">
                            @lang('messages.auth_remember_me')
                        </label>
                    </div>

                    {{-- Uncomment if needed --}}
                    {{--
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                    --}}
                </div>

                <button type="submit" class="btn btn-primary w-100">@lang('messages.login')</button>
            </form>

            <div class="footer-text">
                @lang('messages.auth_no_account')
                <a href="{{ route('register') }}">@lang('messages.register')</a>
            </div>
        </div>
    </div>
@endsection
