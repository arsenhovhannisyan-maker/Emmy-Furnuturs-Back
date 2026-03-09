@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #E9E9E7 !important;
            font-family: 'Poppins', sans-serif;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .register-card {
            background: #fff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            max-width: 520px;
            width: 100%;
            padding: 40px 35px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            font-weight: 700;
            font-size: 28px;
            color: #333;
            margin-bottom: 8px;
        }

        .register-header p {
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

    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2>Create an Account</h2>
                <p>Join us and start your experience today</p>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input id="first_name" type="text"
                           class="form-control @error('first_name') is-invalid @enderror"
                           name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name" autofocus>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input id="last_name" type="text"
                           class="form-control @error('last_name') is-invalid @enderror"
                           name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name">
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail Address</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password"
                           class="form-control"
                           name="password_confirmation" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>

            <div class="footer-text">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
@endsection
