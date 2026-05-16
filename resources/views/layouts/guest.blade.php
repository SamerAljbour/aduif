<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forgot Password — {{ config('app.name', 'Laravel') }}</title>

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
            margin-bottom: 8px;
        }

        .auth-header p {
            font-size: 13.5px;
            color: #6b7280;
            line-height: 1.6;
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
            margin-bottom: 20px;
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
            margin-top: 6px;
        }

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
            margin-bottom: 20px;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -4px rgba(25, 18, 49, 0.3);
        }

        /* ── Back link ── */
        .auth-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 13px;
            color: #6b7280;
            text-decoration: none;
        }

        .auth-back svg {
            width: 14px;
            height: 14px;
            stroke: #6b7280;
            flex-shrink: 0;
        }

        .auth-back span {
            color: #191231;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-back:hover span {
            color: #2a1a47;
        }

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
                <svg viewBox="0 0 24 24" fill="none" stroke="#191231" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="auth-logo-name">{{ config('app.name', 'Acme') }}</span>
        </div>

        <div class="auth-card">

            {{-- Icon --}}
            <div class="auth-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>

            {{-- Header --}}
            <div class="auth-header">
                <h1>Forgot password?</h1>
                <p>Enter your email and we'll send you a link<br>to reset your password.</p>
            </div>

            {{-- Session status --}}
            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input
                        id="email"
                        class="{{ $errors->has('email') ? 'error' : '' }}"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit">
                    Send reset link
                </button>

            </form>

            {{-- Back to login --}}
            @if (Route::has('login'))
                <a class="auth-back" href="{{ route('login') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Back to <span>sign in</span>
                </a>
            @endif

        </div>
    </div>
</body>
</html>
