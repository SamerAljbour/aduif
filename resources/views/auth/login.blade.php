<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Login</title>

    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet" />
</head>

<body>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome back</h1>
                        <p class="lead">Sign in to your account</p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">

                                <!-- SESSION STATUS -->
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- EMAIL -->
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Enter your email"
                                            required autofocus
                                        >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            type="password"
                                            name="password"
                                            placeholder="Enter your password"
                                            required
                                        >

                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if (Route::has('password.request'))
                                            <small>
                                                <a href="{{ route('password.request') }}">
                                                    Forgot password?
                                                </a>
                                            </small>
                                        @endif
                                    </div>

                                    <!-- REMEMBER -->
                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="remember"
                                            >
                                            <span class="form-check-label">
                                                Remember me
                                            </span>
                                        </label>
                                    </div>

                                    <!-- SUBMIT -->
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Sign in
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('admin/js/app.js') }}"></script>
</body>
</html>
