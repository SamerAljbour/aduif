<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register — {{ config('app.name', 'Aduif') }}</title>
    <link rel="shortcut icon" href="{{ asset('user/images/aduif-white.png') }}"  style="border-radius:50% "/>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #1B2A4A;
            --color-primary-rgb: 27, 42, 74;
            --color-accent: #4A6FA5;
            --color-accent-rgb: 74, 111, 165;
            --color-accent-light: #6B8FC4;
            --color-accent-light-rgb: 107, 143, 196;
            --color-bg: #F2F4F7;
            --color-surface: #FFFFFF;
            --color-muted: #5A6A85;
        }

        html, body, * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Tajawal', sans-serif !important; }

        body {
            font-family: 'Tajawal', sans-serif !important;
            line-height: 1.8;
            -webkit-font-smoothing: antialiased;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        h1 { font-weight: 900; }
        h2, h3 { font-weight: 700; }
        h4, h5, h6, .auth-card h2 { font-weight: 500; }
        h1, h2, h3, h4 { line-height: 1.4; }
        p, li, td { font-weight: 400; line-height: 1.9; }
        small, .small, label { font-weight: 300; }

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
            background: var(--color-surface);
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
            color: var(--color-surface);
            letter-spacing: -0.01em;
        }

        /* ── Card ── */
        .auth-card {
            background: var(--color-surface);
            border-radius: 18px;
            box-shadow: 0 28px 60px rgba(18, 23, 54, 0.22);
            padding: 40px 36px 36px;
        }

        /* ── Icon ── */
        .auth-icon {
            width: 52px;
            height: 52px;
            background: rgba(var(--color-accent-rgb), 0.14);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .auth-icon svg {
            width: 26px;
            height: 26px;
            stroke: var(--color-primary);
        }

        /* ── Header ── */
        .auth-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 6px;
        }

        .auth-header p {
            font-size: 13.5px;
            color: var(--color-muted);
        }

        p {
            text-align: justify;
            text-align-last: auto;
            text-justify: inter-word;
            hyphens: auto;
        }

        /* ── Form ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-primary);
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--color-accent-light);
            border-radius: 9px;
            font-size: 14px;
            font-family: 'Tajawal', sans-serif !important;
            color: var(--color-primary);
            background: var(--color-bg);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--color-accent);
            background: var(--color-surface);
            box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb), 0.08);
        }

        .form-group input.error {
            border-color: #ef4444;
        }

        .error-text {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
        }

        /* ── Button ── */
        .btn-submit {
            width: 100%;
            padding: 12px 24px;
            background: var(--color-accent);
            color: var(--color-surface);
            border: none;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Tajawal', sans-serif !important;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 18px;
        }

        .btn-submit:hover {
            background: var(--color-accent-light);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -4px rgba(var(--color-primary-rgb), 0.30);
        }

        /* ── Footer ── */
        .auth-footer {
            text-align: center;
            font-size: 13px;
            color: var(--color-muted);
        }

        .auth-footer a {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-footer a:hover { color: var(--color-accent-light); }

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

                </svg>
            </div>
            {{-- <span class="auth-logo-name">{{ config('app.name', 'Acme') }}</span> --}}
        </div>

        <div class="auth-card">

            {{-- Icon --}}
            <div class="auth-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <line x1="19" y1="8" x2="19" y2="14"/>
                    <line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
            </div>

            {{-- Header --}}
            <div class="auth-header">
                <h1>Get started</h1>
                <p>Create your free account</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        id="name"
                        class="@error('name') error @enderror"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your name"
                        required autofocus
                    >
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

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
                        required
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
                        placeholder="Create a password"
                        required
                    >
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required
                    >
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit">Sign up</button>

                {{-- Login link --}}
                <div class="auth-footer">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
