@extends('layouts.auth')

@section('content')
    <div class="auth-card">
        <h2 class="auth-title">@lang('messages.auth_register_title')</h2>
        <p class="auth-subtitle">@lang('messages.auth_register_subtitle')</p>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="first_name" class="auth-label">@lang('messages.first_name')</label>
                <input id="first_name" type="text"
                       class="auth-input @error('first_name') is-invalid @enderror"
                       name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name" autofocus>
                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="last_name" class="auth-label">@lang('messages.last_name')</label>
                <input id="last_name" type="text"
                       class="auth-input @error('last_name') is-invalid @enderror"
                       name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name">
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="auth-label">E-mail адрес</label>
                <input id="email" type="email"
                       class="auth-input @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email">r
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="auth-label">@lang('messages.auth_password')</label>
                <input id="password" type="password"
                       class="auth-input @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="auth-label">@lang('messages.auth_confirm_password')</label>
                <input id="password-confirm" type="password"
                       class="auth-input"
                       name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="auth-submit">@lang('messages.register')</button>
        </form>

        <div class="auth-helper">
            @lang('messages.auth_have_account')
            <a href="{{ route('login') }}">@lang('messages.login')</a>
        </div>
    </div>
@endsection
