<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — {{ config('app.name', 'Aduif') }}</title>
    <link rel="shortcut icon" href="{{ asset('user/images/aduif-white.png') }}"  style="border-radius:50% "/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #191231 0%, #0f1a3c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
        }

        /* ── Logo ── */
        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .auth-logo-box {
            width: 38px;
            height: 38px;
            background: #ffffff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-logo-box svg {
            width: 22px;
            height: 22px;
        }

        .auth-logo-name {
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: -0.01em;
        }

        /* ── Card ── */
        .auth-card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 28px 60px rgba(18, 23, 54, 0.22);
            padding: 40px 36px 36px;
        }

        /* ── Icon ── */
        .auth-icon {
            width: 52px;
            height: 52px;
            background: #ede9fe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .auth-icon svg {
            width: 26px;
            height: 26px;
            stroke: #191231;
        }

        /* ── Header ── */
        .auth-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        .auth-header p {
            font-size: 13.5px;
            color: #6b7280;
        }

        /* ── Alert ── */
        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* ── Form ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 9px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #111827;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #191231;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(25, 18, 49, 0.08);
        }

        .form-group input.error {
            border-color: #ef4444;
        }

        .error-text {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
        }

        /* ── Remember / Forgot ── */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: auto;
            margin: 0;
            accent-color: #191231;
        }

        .checkbox-wrapper label {
            margin: 0;
            font-weight: 400;
            color: #6b7280;
            font-size: 13px;
        }

        .form-footer a {
            color: #191231;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: color 0.2s;
        }

        .form-footer a:hover { color: #2a1a47; }

        /* ── Button ── */
        .btn-submit {
            width: 100%;
            padding: 12px 24px;
            background: #191231;
            color: #ffffff;
            border: none;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 18px;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -4px rgba(25, 18, 49, 0.3);
        }

        /* ── Footer ── */
        .auth-footer {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }

        .auth-footer a {
            color: #191231;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-footer a:hover { color: #2a1a47; }

        @media (max-width: 480px) {
            .auth-card { padding: 32px 24px 28px; }
            .auth-header h1 { font-size: 20px; }
        }
    </style>
</head>

<body>
    <div class="auth-container">

        {{-- Logo --}}
        <div class="auth-logo">
            <div class="auth-logo-box">
                    <img src="{{ asset('user/images/aduif-white.png') }}"
        alt="Homepage"
        style="width: auto; height: 100px; max-width: 170px; object-fit: contain; border-radius: 50%; margin-bottom: 25px;">

            </div>
            {{-- <span class="auth-logo-name">{{ config('app.name', 'Aduif') }}</span> --}}
        </div>

        <div class="auth-card">

            {{-- Icon --}}
            <div class="auth-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>

            {{-- Header --}}
            <div class="auth-header">
                <h1>Welcome back</h1>
                <p>Sign in to your account</p>
            </div>

            {{-- Session status --}}
            @if (session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        class="@error('email') error @enderror"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required autofocus
                    >
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        class="@error('password') error @enderror"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember & Forgot --}}
                <div class="form-footer">
                    <div class="checkbox-wrapper">
                        <input id="remember" type="checkbox" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    {{-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif --}}
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit">Sign in</button>

                {{-- Register link --}}
                <div class="auth-footer">
                    Don't have an account? <a href="{{ route('register') }}">Sign up</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
