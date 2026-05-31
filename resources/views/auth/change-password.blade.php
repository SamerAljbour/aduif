@extends('adminLayouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Update Admin Password
                </h2>
                <p class="text-muted mt-2">Secure your admin account by setting a new password. Use a strong password and confirm it below.</p>
            </div>
        </div>
    </div>
</div>
<div class="page-wrapper">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 p-3 bg-light rounded-3 border border-muted">
                            <strong>Need to update your password?</strong>
                            <p class="mb-0 text-muted" style="font-size: 0.95rem;">Enter your current password, choose a strong new password, and confirm it to keep your account secure.</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger d-flex align-items-start gap-3 border border-danger shadow-sm p-3 rounded-3 alert-dismissible fade show" role="alert">
                                <div class="mt-1">
                                    <i class="align-middle" data-feather="x-circle"></i>
                                </div>
                                <div class="flex-fill">
                                    <strong class="d-block mb-2">Please fix the following errors:</strong>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success d-flex align-items-start gap-3 border border-success shadow-sm p-3 rounded-3 alert-dismissible fade show" role="alert">
                                <div class="mt-1">
                                    <i class="align-middle" data-feather="check-circle"></i>
                                </div>
                                <div class="flex-fill">
                                    <strong class="d-block mb-2">Success!</strong>
                                    <div>{{ session('success') }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.change') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password" required>
                                @error('current_password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input id="password-input" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password" required>

                                {{-- Strength bar --}}
                                <div class="mt-3">
                                    <div style="height: 6px; background: var(--color-bg); border-radius: 100px; overflow: hidden;">
                                        <div id="password-strength-bar"
                                             role="progressbar"
                                             aria-valuenow="0"
                                             aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="height: 100%; width: 0%; border-radius: 100px; transition: width 0.3s ease, background-color 0.3s ease;"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <small id="password-strength-label" style="font-weight: 500; transition: color 0.3s; color: var(--color-muted);">Enter a password</small>
                                        <small id="password-score" class="text-muted"></small>
                                    </div>
                                </div>

                                {{-- Criteria badges --}}
                                <div class="mt-2 d-flex flex-wrap gap-2 align-items-center" id="password-criteria">
                                    <span class="badge" id="criteria-length"  style="font-weight: 400; font-size: 11px; padding: 4px 9px; border-radius: 100px; background: var(--color-bg); color: var(--color-muted); border: 1px solid var(--color-accent-light);">8+ chars</span>
                                    <span class="badge" id="criteria-lower"   style="font-weight: 400; font-size: 11px; padding: 4px 9px; border-radius: 100px; background: var(--color-bg); color: var(--color-muted); border: 1px solid var(--color-accent-light);">lowercase</span>
                                    <span class="badge" id="criteria-upper"   style="font-weight: 400; font-size: 11px; padding: 4px 9px; border-radius: 100px; background: var(--color-bg); color: var(--color-muted); border: 1px solid var(--color-accent-light);">uppercase</span>
                                    <span class="badge" id="criteria-number"  style="font-weight: 400; font-size: 11px; padding: 4px 9px; border-radius: 100px; background: var(--color-bg); color: var(--color-muted); border: 1px solid var(--color-accent-light);">number</span>
                                    <span class="badge" id="criteria-symbol"  style="font-weight: 400; font-size: 11px; padding: 4px 9px; border-radius: 100px; background: var(--color-bg); color: var(--color-muted); border: 1px solid var(--color-accent-light);">symbol</span>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm new password" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                        <script>
                            (function () {
                                var passwordInput   = document.getElementById('password-input');
                                var strengthBar     = document.getElementById('password-strength-bar');
                                var strengthLabel   = document.getElementById('password-strength-label');
                                var scoreLabel      = document.getElementById('password-score');

                                var criteria = {
                                    length: document.getElementById('criteria-length'),
                                    lower:  document.getElementById('criteria-lower'),
                                    upper:  document.getElementById('criteria-upper'),
                                    number: document.getElementById('criteria-number'),
                                    symbol: document.getElementById('criteria-symbol'),
                                };

                                var COLORS = ['#e24b4a', '#e24b4a', '#ef9f27', '#639922', '#639922'];
                                var LABELS = ['Too weak', 'Too weak', 'Getting there', 'Strong', 'Very strong'];

                                var MET_STYLE   = 'font-weight:400;font-size:11px;padding:4px 9px;border-radius:100px;background:#d3f9d8;color:#2b8a3e;border:1px solid #8ce99a;';
                                var UNMET_STYLE = 'font-weight:400;font-size:11px;padding:4px 9px;border-radius:100px;background:var(--color-bg);color:var(--color-muted);border:1px solid var(--color-accent-light);';

                                function testPassword(value) {
                                    return {
                                        length: value.length >= 8,
                                        lower:  /[a-z]/.test(value),
                                        upper:  /[A-Z]/.test(value),
                                        number: /[0-9]/.test(value),
                                        symbol: /[@$!%*#?&^()_+\-=\[\]{};:\\|,.<>\/?~`]/.test(value),
                                    };
                                }

                                function updateStrength() {
                                    var value   = passwordInput.value;
                                    var results = testPassword(value);
                                    var score   = Object.values(results).filter(Boolean).length;

                                    // Update criterion badges
                                    Object.keys(results).forEach(function (key) {
                                        criteria[key].style.cssText = results[key] ? MET_STYLE : UNMET_STYLE;
                                    });

                                    // Empty state
                                    if (value.length === 0) {
                                        strengthBar.style.width           = '0%';
                                        strengthBar.style.backgroundColor = 'transparent';
                                        strengthBar.setAttribute('aria-valuenow', 0);
                                        strengthLabel.textContent  = 'Enter a password';
                                        strengthLabel.style.color  = 'var(--color-muted)';
                                        scoreLabel.textContent     = '';
                                        return;
                                    }

                                    var pct   = Math.max(12, (score / 5) * 100);
                                    var color = COLORS[score - 1] || COLORS[0];

                                    strengthBar.style.width           = pct + '%';
                                    strengthBar.style.backgroundColor = color;
                                    strengthBar.setAttribute('aria-valuenow', pct);
                                    strengthLabel.textContent  = LABELS[score - 1] || LABELS[0];
                                    strengthLabel.style.color  = color;
                                    scoreLabel.textContent     = score + ' / 5 criteria';
                                }

                                if (passwordInput) {
                                    passwordInput.addEventListener('input', updateStrength);
                                    updateStrength();
                                }
                            })();
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
