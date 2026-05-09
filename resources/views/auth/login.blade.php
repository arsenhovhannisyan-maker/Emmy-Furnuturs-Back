@extends('layouts.auth')

@section('content')
    <div class="auth-card">
        <h2 class="auth-title">@lang('messages.auth_login_title')</h2>
        <p class="auth-subtitle">@lang('messages.auth_login_subtitle')</p>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="auth-label">E-mail адрес</label>
                <input id="email" type="email"
                       class="auth-input @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="auth-label">@lang('messages.auth_password')</label>
                <input id="password" type="password"
                       class="auth-input @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
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

            <button type="submit" class="auth-submit">@lang('messages.login')</button>
        </form>

        <div class="auth-helper">
            @lang('messages.auth_no_account')
            <a href="{{ route('register') }}">@lang('messages.register')</a>
        </div>
    </div>
@endsection
