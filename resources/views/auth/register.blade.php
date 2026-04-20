<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
</head>

<body>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Get started</h1>
                        <p class="lead">
                            Create your account
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- NAME -->
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input
                                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                                            type="text"
                                            name="name"
                                            value="{{ old('name') }}"
                                            placeholder="Enter your name"
                                            required
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- EMAIL -->
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Enter your email"
                                            required
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
                                            placeholder="Enter password"
                                            required
                                        >
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- CONFIRM PASSWORD -->
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="Confirm password"
                                            required
                                        >
                                    </div>

                                    <!-- SUBMIT -->
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Sign up
                                        </button>
                                    </div>

                                    <!-- LOGIN LINK -->
                                    <div class="text-center mt-3">
                                        <a href="{{ route('login') }}">
                                            Already have an account? Login
                                        </a>
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
