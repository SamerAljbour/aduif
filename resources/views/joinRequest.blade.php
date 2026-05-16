@extends('userLayouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root {
    --brand: #191231;
    --brand-dark: #191231;
    --brand-light: rgba(25, 18, 49, 0.14);
    --text: #0f172a;
    --text-muted: #64748b;
    --surface: #ffffff;
    --bg: #f8fafc;
    --border: #e2e8f0;
    --radius: 12px;
    --danger: #ef4444;
    --danger-light: #fef2f2;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── Page shell ── */
.s-home::after { background-color: transparent; }
.s-home {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 100px;
    min-height: 100vh;
    height: auto;
}

/* ── Wrap ── */
.jr-wrap {
    position: relative;
    z-index: 3;
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    max-width: 811px;
    width: 100%;
    margin: 0 auto;
    padding: 2.5rem 2rem 4rem;
    border-radius: 12px;
}

/* ── Header ── */
.jr-header { margin-bottom: 2.5rem; }
.jr-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--brand-light); color: var(--brand-dark);
    font-size: 11px; font-weight: 600; padding: 4px 14px;
    border-radius: 100px; margin-bottom: 1rem;
    letter-spacing: 0.06em; text-transform: uppercase;
}
.jr-tag span {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--brand); display: inline-block;
}
.jr-header h1 {
    font-family: 'Syne', sans-serif; font-size: 30px; font-weight: 700;
    color: var(--text); line-height: 1.2; margin-bottom: 0.5rem;
}
.jr-header p { color: var(--text-muted); font-size: 15px; line-height: 1.6; }

/* ── Progress ── */
.jr-progress {
    height: 3px; background: var(--border);
    border-radius: 100px; margin-bottom: 2rem; overflow: hidden;
}
.jr-progress-fill {
    height: 100%; background: var(--brand);
    border-radius: 100px;
    transition: width 0.4s cubic-bezier(.4,0,.2,1);
}

/* ── Steps nav ── */
.jr-steps {
    display: flex; gap: 0;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 100px; padding: 5px; margin-bottom: 2rem; overflow: hidden;
}
.jr-step-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 7px;
    padding: 9px 6px; border-radius: 100px; border: none; background: transparent;
    cursor: pointer; transition: all 0.25s; font-family: 'DM Sans', sans-serif;
    font-size: 13px; font-weight: 500; color: var(--text-muted); white-space: nowrap;
    margin-bottom: 0;
}
.jr-step-btn.active { background: var(--text); color: #fff; }
.jr-step-btn.done { color: var(--brand-dark); }
.jr-step-num {
    width: 20px; height: 20px; border-radius: 50%; display: flex;
    align-items: center; justify-content: center; font-size: 11px; font-weight: 600;
    background: var(--border); color: var(--text-muted); flex-shrink: 0; transition: all 0.25s;
}
.jr-step-btn.active .jr-step-num { background: var(--brand); color: #fff; }
.jr-step-btn.done .jr-step-num { background: var(--brand-light); color: var(--brand-dark); }

/* ── Card ── */
.jr-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 2rem; margin-bottom: 1rem;
}
.jr-card-title {
    font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 600;
    margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;
}
.jr-card-title .dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--brand); flex-shrink: 0;
}

/* ── Section label ── */
.jr-section-label {
    font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;
    color: var(--text-muted); margin-bottom: 1rem; padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
}

/* ── Grid ── */
.jr-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    align-items: start;
}
.jr-grid.full { grid-template-columns: 1fr; }

/* ── Fields ── */
.jr-field {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.jr-field label {
    font-size: 13px; font-weight: 500; color: var(--text);
    display: flex; align-items: center; gap: 4px;
}
.req { color: var(--brand); font-size: 14px; }

.jr-field input,
.jr-field select,
.jr-field textarea {
    border: 1.5px solid var(--border); border-radius: 8px;
    padding: 10px 14px; font-size: 14px; font-family: 'DM Sans', sans-serif;
    color: var(--text); background: var(--bg); transition: border-color 0.2s;
    outline: none; width: 100%; margin: 0;
}
.jr-field textarea { resize: vertical; min-height: 90px; line-height: 1.6; }
.jr-field input:focus,
.jr-field select:focus,
.jr-field textarea:focus { border-color: var(--brand); background: #fff; }
.jr-field input::placeholder,
.jr-field textarea::placeholder { color: #94a3b8; }
.jr-field input.invalid { border-color: var(--danger) !important; }

/* Error message — always in flow, visibility toggled to prevent layout shift */
.jr-field .error-msg {
    font-size: 12px;
    color: var(--danger);
    line-height: 1.4;
    min-height: 18px;
    display: block;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.15s;
}
.jr-field.has-error .error-msg {
    visibility: visible;
    opacity: 1;
}
.jr-field.has-error input,
.jr-field.has-error select,
.jr-field.has-error textarea,
.jr-field.has-error .jr-upload-zone,
.jr-field.has-error .jr-multi-zone { border-color: var(--danger); }

.jr-field select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px;
}

/* ── Radio ── */
.jr-radio-group { display: flex; gap: 10px; }
.jr-radio-option {
    flex: 1; border: 1.5px solid var(--border); border-radius: 8px;
    padding: 12px 14px; cursor: pointer; transition: all 0.2s;
    display: flex; align-items: center; gap: 10px; background: var(--bg);
    user-select: none;
}
.jr-radio-option:hover { border-color: var(--brand); background: rgba(25, 18, 49, 0.08); }
.jr-radio-option.selected { border-color: var(--brand); background: var(--brand-light); }
.jr-radio-option input[type=radio] { display: none; }
.jr-radio-dot {
    width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: all 0.2s;
}
.jr-radio-option.selected .jr-radio-dot { border-color: var(--brand); background: var(--brand); }
.jr-radio-dot::after {
    content: ''; width: 6px; height: 6px; border-radius: 50%;
    background: white; display: none;
}
.jr-radio-option.selected .jr-radio-dot::after { display: block; }
.jr-radio-label { font-size: 14px; font-weight: 500; }

/* ── Single upload zone ── */
.jr-upload-zone {
    border: 2px dashed var(--border); border-radius: 8px; padding: 1.25rem;
    text-align: center; cursor: pointer; transition: all 0.2s;
    background: var(--bg); position: relative;
}
.jr-upload-zone:hover { border-color: var(--brand); background: rgba(25, 18, 49, 0.08); }
.jr-upload-zone.has-file { border-color: var(--brand); border-style: solid; background: var(--brand-light); }
.jr-upload-zone input[type=file] {
    position: absolute; inset: 0; opacity: 0;
    cursor: pointer; width: 100%; height: 100%;
}
.jr-upload-icon {
    width: 34px; height: 34px; border-radius: 8px; background: var(--brand-light);
    display: flex; align-items: center; justify-content: center; margin: 0 auto 6px;
}
.jr-upload-title { font-size: 13px; font-weight: 500; margin-bottom: 2px; }
.jr-upload-sub { font-size: 11px; color: var(--text-muted); }
.jr-file-name { font-size: 12px; font-weight: 500; color: var(--brand-dark); margin-top: 4px; }

/* ── Multi-doc upload ── */
.jr-multi-zone {
    border: 2px dashed var(--border); border-radius: 10px;
    padding: 1.5rem; background: var(--bg); transition: all 0.2s;
    position: relative; cursor: pointer;
}
.jr-multi-zone:hover,
.jr-multi-zone.drag-over { border-color: var(--brand); background: rgba(25, 18, 49, 0.08); }
.jr-multi-zone input[type=file] {
    position: absolute; inset: 0; opacity: 0;
    cursor: pointer; width: 100%; height: 100%;
}
.jr-multi-zone-inner {
    display: flex; flex-direction: column;
    align-items: center; gap: 6px; pointer-events: none;
}
.jr-multi-zone-icon {
    width: 42px; height: 42px; border-radius: 10px; background: var(--brand-light);
    display: flex; align-items: center; justify-content: center; margin-bottom: 4px;
}
.jr-multi-zone-title { font-size: 14px; font-weight: 600; }
.jr-multi-zone-sub { font-size: 12px; color: var(--text-muted); }

.jr-docs-list { margin-top: 1rem; display: flex; flex-direction: column; gap: 8px; }
.jr-doc-item {
    display: flex; align-items: center; gap: 10px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 8px; padding: 10px 12px; animation: slideIn 0.2s ease;
}
.jr-doc-icon {
    width: 32px; height: 32px; border-radius: 6px; background: var(--brand-light);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.jr-doc-info { flex: 1; min-width: 0; }
.jr-doc-name { font-size: 13px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.jr-doc-size { font-size: 11px; color: var(--text-muted); }
.jr-doc-remove {
    width: 26px; height: 26px; border-radius: 6px; border: 1px solid var(--border);
    background: transparent; cursor: pointer; display: flex; align-items: center;
    justify-content: center; color: var(--text-muted); font-size: 14px;
    transition: all 0.15s; flex-shrink: 0; line-height: 1;
}
.jr-doc-remove:hover { background: var(--danger-light); border-color: var(--danger); color: var(--danger); }
.jr-docs-count { font-size: 12px; color: var(--text-muted); margin-top: 8px; text-align: right; }

/* ── Nav bar ── */
.jr-nav {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border);
}
.jr-btn-ghost {
    padding: 10px 20px; border: 1.5px solid var(--border); border-radius: 8px;
    background: transparent; color: var(--text-muted); font-size: 14px; font-weight: 500;
    cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif;
    display: flex; align-items: center; gap: 6px;
}
.jr-btn-ghost:hover { border-color: var(--text); color: var(--text); }
.jr-btn-primary {
    padding: 10px 28px; border-radius: 8px; background: var(--brand);
    color: #fff; font-size: 14px; font-weight: 600; border: none;
    cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif;
    display: flex; align-items: center; gap: 8px;
}
.jr-btn-primary:hover { background: var(--brand-dark); transform: translateY(-1px); }
.jr-btn-primary:active { transform: scale(0.98); }
.jr-btn-submit { background: #0f172a; }
.jr-btn-submit:hover { background: #1e293b; }

/* ── Review ── */
.jr-review-row {
    display: flex; justify-content: space-between; align-items: flex-start;
    padding: 10px 0; border-bottom: 1px solid var(--border); gap: 1rem;
}
.jr-review-row:last-child { border-bottom: none; }
.jr-review-key { font-size: 13px; color: var(--text-muted); flex-shrink: 0; min-width: 160px; }
.jr-review-val { font-size: 13px; font-weight: 500; color: var(--text); text-align: right; }
.jr-badge {
    display: inline-flex; align-items: center; padding: 3px 10px;
    border-radius: 100px; font-size: 12px; font-weight: 500;
}
.jr-badge-green { background: var(--brand-light); color: var(--brand-dark); }
.jr-badge-blue { background: #eff6ff; color: #1d4ed8; }

/* ── Panels — hidden panels take ZERO space ── */
.jr-panel { display: none; animation: fadeUp 0.3s ease; }
.jr-panel.active { display: block; }

/* ── Success ── */
.jr-success {
    display: none; flex-direction: column; align-items: center;
    text-align: center; padding: 4rem 2rem;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius);
}
.jr-success.active { display: flex; }
.jr-success-icon {
    width: 68px; height: 68px; border-radius: 50%; background: var(--brand-light);
    display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;
}

/* ── Validation error alert box ── */
.jr-alert-errors {
    background: var(--danger-light); border: 1px solid #fecaca;
    border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;
    font-size: 13px; color: #b91c1c;
}
.jr-alert-errors ul { padding-left: 1.2rem; margin-top: 6px; }
.jr-alert-errors li { margin-bottom: 2px; }

/* ── Button reset (theme override) ── */
.btn, button, input[type="submit"], input[type="reset"], input[type="button"] {
    letter-spacing: 0.2rem;
}

/* ── Animations ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes slideIn {
    from { opacity: 0; transform: translateX(-6px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* ════════════════════════════════════
   RESPONSIVE
════════════════════════════════════ */

/* Tablet — 768px */
@media (max-width: 768px) {
    .jr-wrap { padding: 2rem 1.5rem 4rem; }
    .jr-header h1 { font-size: 26px; }
    .jr-card { padding: 1.5rem; }
    .jr-review-key { min-width: 120px; }
}

/* Large mobile — 640px */
@media (max-width: 640px) {
    .jr-grid { grid-template-columns: 1fr; }
    .jr-wrap { padding: 1.75rem 1.25rem 3.5rem; }
    .jr-header h1 { font-size: 24px; }
    .jr-card { padding: 1.25rem; }
}

/* Small mobile — 540px */
@media (max-width: 540px) {
    .jr-steps {
        flex-wrap: wrap;
        border-radius: 12px;
        gap: 4px;
        padding: 6px;
    }
    .jr-step-btn {
        flex: 1 1 calc(50% - 4px);
        font-size: 12px;
        padding: 8px 6px;
        border-radius: 8px;
        justify-content: center;
        white-space: nowrap;
    }
    .jr-radio-group { flex-direction: column; }
    .jr-nav { gap: 8px; }
    .jr-btn-ghost,
    .jr-btn-primary {
        flex: 1;
        justify-content: center;
        padding: 10px 16px;
    }
    .jr-review-row { flex-direction: column; gap: 4px; }
    .jr-review-val { text-align: left; }
    .jr-review-key { min-width: unset; }
    .s-home { padding-top: 80px; }
}

/* Extra small — 380px */
@media (max-width: 380px) {
    .jr-wrap { padding: 1.25rem 1rem 3rem; }
    .jr-step-btn .jr-step-num { display: none; }
    .jr-step-btn { font-size: 11px; padding: 8px 4px; }
    .jr-btn-ghost,
    .jr-btn-primary { font-size: 13px; padding: 10px 12px; }
    .jr-header h1 { font-size: 22px; }
    .jr-card { padding: 1rem; }
}
</style>
<section id="home" class="s-home target-section d-flex align-items-start justify-content-center">
<div class="jr-wrap">
{{-- Wrap the entire form section --}}
@if(!session('success'))
    {{-- Laravel validation errors --}}
    @if ($errors->any())
    <div class="jr-alert-errors">
        <strong>{{ __('joinUs.validation.fix_errors') }}</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Header --}}
    <div class="jr-header">
        <div class="jr-tag"><span></span>  {{ __('joinUs.header.tag') }}</div>
        <h1>{{ __('joinUs.header.title') }}</h1>
        <p>{{ __('joinUs.header.desc') }}</p>
    </div>

    {{-- Progress bar --}}
    <div class="jr-progress">
        <div class="jr-progress-fill" id="jr-progress" style="width:33%"></div>
    </div>

    {{-- Step pills --}}
    <div class="jr-steps">
        <button type="button" class="jr-step-btn active" id="sb1" onclick="jrGoTo(1)">
            <span class="jr-step-num">1</span> {{ __('joinUs.steps.basic') }}
        </button>
        <button type="button" class="jr-step-btn" id="sb2" onclick="jrGoTo(2)">
            <span class="jr-step-num">2</span> {{ __('joinUs.steps.professional') }}
        </button>
        <button type="button" class="jr-step-btn" id="sb3" onclick="jrGoTo(3)">
            <span class="jr-step-num">3</span> {{ __('joinUs.steps.documents') }}
        </button>
        <button type="button" class="jr-step-btn" id="sb4" onclick="jrGoTo(4)">
            <span class="jr-step-num">4</span> {{ __('joinUs.steps.review') }}
        </button>
    </div>

    <form action="{{ route('join-us.store') }}" method="POST" enctype="multipart/form-data" id="jr-form" novalidate>
        @csrf

        {{-- ══════════════════ STEP 1 — Basic Info ══════════════════ --}}
        <div class="jr-panel active" id="panel1">

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> {{ __('joinUs.sections.personal') }}</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">

                    <div class="jr-grid">
                        <div class="jr-field @error('name_fr') has-error @enderror">
                            <label for="name_fr">{{ __('joinUs.fields.name_fr') }} <span class="req">*</span></label>
                            <input type="text" id="name_fr" name="name_fr"
                                   value="{{ old('name_fr') }}"
                                   placeholder="{{ __('joinUs.placeholders.name_fr') }}"
                                   data-required="true" />
                            <span class="error-msg">
                                @error('name_fr') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror
                            </span>
                        </div>
                        <div class="jr-field @error('name_ar') has-error @enderror">
                            <label for="name_ar">{{ __('joinUs.fields.name_ar') }} <span class="req">*</span></label>
                            <input type="text" id="name_ar" name="name_ar"
                                   value="{{ old('name_ar') }}"
                                   placeholder="{{ __('joinUs.placeholders.name_ar') }}"
                                   data-required="true" />
                            <span class="error-msg">
                                @error('name_ar') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror
                            </span>
                        </div>
                    </div>

                    <div class="jr-grid">
                        <div class="jr-field @error('email') has-error @enderror">
                            <label for="email">{{ __('joinUs.fields.email') }} <span class="req">*</span></label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="{{ __('joinUs.placeholders.email') }}"
                                   data-required="true" />
                            <span class="error-msg">
                                @error('email') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror
                            </span>
                        </div>
                        <div class="jr-field @error('phone') has-error @enderror">
                            <label for="phone">{{ __('joinUs.fields.phone') }} <span class="req">*</span></label>
                            <input type="tel" id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="{{ __('joinUs.placeholders.phone') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('phone') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                    </div>

                    <div class="jr-field @error('nationality') has-error @enderror">
                        <label id="nationality_label">{{ __('joinUs.fields.nationality') }} <span class="req">*</span></label>
                        <div class="jr-radio-group">
                            <label class="jr-radio-option {{ old('nationality', 'jordanian') === 'jordanian' ? 'selected' : '' }}"
                                   id="r_jo" onclick="jrSelectNat('jordanian')">
                                <input type="radio" name="nationality" value="jordanian"
                                       {{ old('nationality', 'jordanian') === 'jordanian' ? 'checked' : '' }} />
                                <span class="jr-radio-dot"></span>
                                <span class="jr-radio-label">{{ __('joinUs.fields.jordanian') }}</span>
                            </label>
                            <label class="jr-radio-option {{ old('nationality') === 'non_jordanian' ? 'selected' : '' }}"
                                   id="r_nj" onclick="jrSelectNat('non_jordanian')">
                                <input type="radio" name="nationality" value="non_jordanian"
                                       {{ old('nationality') === 'non_jordanian' ? 'checked' : '' }} />
                                <span class="jr-radio-dot"></span>
                                <span class="jr-radio-label">{{ __('joinUs.fields.non_jordanian') }}</span>
                            </label>
                        </div>
                        @error('nationality')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>

            <div class="jr-nav">
                <div></div>
                <button type="button" class="jr-btn-primary" onclick="jrNext(1)">
                    {{ __('joinUs.buttons.continue') }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- ══════════════════ STEP 2 — Professional ══════════════════ --}}
        <div class="jr-panel" id="panel2">

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> {{ __('joinUs.sections.academic') }}</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div class="jr-grid">
                        <div class="jr-field @error('specialization_fr') has-error @enderror">
                            <label for="specialization_fr">{{ __('joinUs.fields.specialization_fr') }} <span class="req">*</span></label>
                            <input type="text" id="specialization_fr" name="specialization_fr"
                                   value="{{ old('specialization_fr') }}"
                                   placeholder="{{ __('joinUs.placeholders.specialization_fr') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('specialization_fr') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                        <div class="jr-field @error('specialization_ar') has-error @enderror">
                            <label for="specialization_ar">{{ __('joinUs.fields.specialization_ar') }} <span class="req">*</span></label>
                            <input type="text" id="specialization_ar" name="specialization_ar"
                                   value="{{ old('specialization_ar') }}"
                                   placeholder="{{ __('joinUs.placeholders.specialization_ar') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('specialization_ar') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                    </div>
                    <div class="jr-grid">

                        <div class="jr-field @error('graduation_university_fr') has-error @enderror">
                            <label for="graduation_university_fr">{{ __('joinUs.fields.university_fr') }} <span class="req">*</span></label>
                            <input type="text" id="graduation_university_fr" name="graduation_university_fr"
                                   value="{{ old('graduation_university_fr') }}"
                                   placeholder="{{ __('joinUs.placeholders.university_fr') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('graduation_university_fr') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                        <div class="jr-field @error('graduation_university_ar') has-error @enderror">
                            <label for="graduation_university_ar">{{ __('joinUs.fields.university_ar') }} <span class="req">*</span></label>
                            <input type="text" id="graduation_university_ar" name="graduation_university_ar"
                                   value="{{ old('graduation_university_ar') }}"
                                   placeholder="{{ __('joinUs.placeholders.university_ar') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('graduation_university_ar') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                    </div>

                     <div class="jr-field @error('degree') has-error @enderror">
                            <label for="degree">{{ __('joinUs.fields.degree') }} <span class="req">*</span></label>
                            <select id="degree" name="degree" data-required="true">
                                <option value="">{{ __('joinUs.fields.select_degree') }}</option>
                              @foreach(['bachelor', 'master', 'phd', 'postdoctoral', 'other'] as $deg)
                                    <option value="{{ $deg }}" {{ old('degree') === $deg ? 'selected' : '' }}>
                                        {{ __('members.degrees.' . $deg) }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="error-msg">@error('degree') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                </div>
            </div>

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> {{ __('joinUs.sections.current_position') }}</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div class="jr-grid">
                        <div class="jr-field @error('current_job_fr') has-error @enderror">
                            <label for="current_job_fr">{{ __('joinUs.fields.job_fr') }} <span class="req">*</span></label>
                            <input type="text" id="current_job_fr" name="current_job_fr"
                                   value="{{ old('current_job_fr') }}"
                                   placeholder="{{ __('joinUs.placeholders.job_fr') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('current_job_fr') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                        <div class="jr-field @error('current_job_ar') has-error @enderror">
                            <label for="current_job_ar">{{ __('joinUs.fields.job_ar') }} <span class="req">*</span></label>
                            <input type="text" id="current_job_ar" name="current_job_ar"
                                   value="{{ old('current_job_ar') }}"
                                   placeholder="{{ __('joinUs.placeholders.job_ar') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('current_job_ar') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                    </div>
                    <div class="jr-grid">
                        <div class="jr-field @error('workplace_fr') has-error @enderror">
                            <label for="workplace_fr">{{ __('joinUs.fields.workplace_fr') }} <span class="req">*</span></label>
                            <input type="text" id="workplace_fr" name="workplace_fr"
                                   value="{{ old('workplace_fr') }}"
                                   placeholder="{{ __('joinUs.placeholders.workplace_fr') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('workplace_fr') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                        <div class="jr-field @error('workplace_ar') has-error @enderror">
                            <label for="workplace_ar">{{ __('joinUs.fields.workplace_ar') }} <span class="req">*</span></label>
                            <input type="text" id="workplace_ar" name="workplace_ar"
                                   value="{{ old('workplace_ar') }}"
                                   placeholder="{{ __('joinUs.placeholders.workplace_ar') }}"
                                   data-required="true" />
                            <span class="error-msg">@error('workplace_ar') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> {{ __('joinUs.sections.about') }}</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div class="jr-field @error('interests_fr') has-error @enderror">
                        <label for="interests_fr">{{ __('joinUs.fields.interests_fr') }} <span class="req">*</span></label>
                        <textarea id="interests_fr" name="interests_fr" placeholder="{{ __('joinUs.placeholders.interests_fr') }}" data-required="true">{{ old('interests_fr') }}</textarea>
                        <span class="error-msg">@error('interests_fr') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                    </div>
                    <div class="jr-field @error('interests_ar') has-error @enderror">
                        <label for="interests_ar">{{ __('joinUs.fields.interests_ar') }} <span class="req">*</span></label>
                        <textarea id="interests_ar" name="interests_ar" placeholder="{{ __('joinUs.placeholders.interests_ar') }}" data-required="true">{{ old('interests_ar') }}</textarea>
                        <span class="error-msg">@error('interests_ar') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                    </div>
                    <div class="jr-field @error('bio_fr') has-error @enderror">
                        <label for="bio_fr">{{ __('joinUs.fields.bio_fr') }} <span class="req">*</span></label>
                        <textarea id="bio_fr" name="bio_fr" placeholder="{{ __('joinUs.placeholders.bio_fr') }}" data-required="true">{{ old('bio_fr') }}</textarea>
                        <span class="error-msg">@error('bio_fr') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                    </div>
                    <div class="jr-field @error('bio_ar') has-error @enderror">
                        <label for="bio_ar">{{ __('joinUs.fields.bio_ar') }} <span class="req">*</span></label>
                        <textarea id="bio_ar" name="bio_ar" placeholder="{{ __('joinUs.placeholders.bio_ar') }}" data-required="true">{{ old('bio_ar') }}</textarea>
                        <span class="error-msg">@error('bio_ar') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                    </div>
                </div>
            </div>

            <div class="jr-nav">
                <button type="button" class="jr-btn-ghost" onclick="jrGoTo(1)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    {{ __('joinUs.buttons.back') }}
                </button>
                <button type="button" class="jr-btn-primary" onclick="jrNext(2)">
                    {{ __('joinUs.buttons.continue') }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- ══════════════════ STEP 3 — Documents ══════════════════ --}}
        <div class="jr-panel" id="panel3">

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> {{ __('joinUs.sections.profile_documents') }}</div>
                <div class="jr-grid">
                    {{-- Photo --}}
                    <div class="jr-field @error('photo') has-error @enderror">
                        <label id="photo_label">{{ __('joinUs.upload.photo_label') }} <span class="req">*</span></label>
                        <div class="jr-upload-zone" id="zone_photo">
                            <input type="file" name="photo" id="inp_photo"
                                   accept="image/jpeg,image/png,image/webp"
                                   onchange="jrSingleFile('photo', this)"
                                   data-required="true" />
                            <div class="jr-upload-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#191231" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                            </div>
                            <div class="jr-upload-title">{{ __('joinUs.upload.photo') }}</div>
                            <div class="jr-upload-sub">{{ __('joinUs.upload.photo_hint') }}</div>
                            <div class="jr-file-name" id="photo_name"></div>
                        </div>
                        <span class="error-msg">@error('photo') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                    </div>

                    {{-- CV --}}
                    <div class="jr-field @error('cv') has-error @enderror">
                        <label id="cv_label">{{ __('joinUs.upload.cv_label') }} <span class="req">*</span></label>
                        <div class="jr-upload-zone" id="zone_cv">
                            <input type="file" name="cv" id="inp_cv"
                                   accept=".pdf,.doc,.docx"
                                   onchange="jrSingleFile('cv', this)"
                                   data-required="true" />
                            <div class="jr-upload-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#191231" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            </div>
                            <div class="jr-upload-title">{{ __('joinUs.upload.cv') }}</div>
                            <div class="jr-upload-sub">{{ __('joinUs.upload.cv_hint') }}</div>
                            <div class="jr-file-name" id="cv_name"></div>
                        </div>
                        <span class="error-msg">@error('cv') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror</span>
                    </div>
                </div>
            </div>

            {{-- Multi-doc upload --}}
            <div class="jr-card">
                <div class="jr-card-title" id="additional_docs_label"><span class="dot"></span> {{ __('joinUs.upload.docs') }} <span class="req">*</span></div>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:1rem;line-height:1.6;">
                    {{ __('joinUs.upload.docs_desc') }}
                </p>

                @error('documents')
                    <div style="font-size:12px;color:var(--danger);margin-bottom:8px">{{ $message }}</div>
                @enderror
                @error('documents.*')
                    <div style="font-size:12px;color:var(--danger);margin-bottom:8px">{{ $message }}</div>
                @enderror

                <div class="jr-multi-zone" id="multi_zone"
                     ondragover="jrDragOver(event)" ondragleave="jrDragLeave(event)" ondrop="jrDrop(event)">
                    <input type="file" id="inp_docs"name="documents[]" multiple
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp"
                           onchange="jrAddDocs(this.files)" />
                    <div class="jr-multi-zone-inner">
                        <div class="jr-multi-zone-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#191231" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <div class="jr-multi-zone-title">{{ __('joinUs.upload.docs_drop') }}</div>
                        <div class="jr-multi-zone-sub">{{ __('joinUs.upload.docs_hint') }}</div>
                    </div>
                </div>
                <div class="jr-field @error('documents') has-error @enderror @error('documents.*') has-error @enderror" id="docs_field">
                    <span class="error-msg">@error('documents') {{ $message }} @else @error('documents.*') {{ $message }} @else {{ __('joinUs.validation.required') }} @enderror @enderror</span>
                </div>

                <div id="docs_list" class="jr-docs-list" data-remove="{{ __('joinUs.actions.remove') }}"></div>
                <div id="docs_count" class="jr-docs-count" style="display:none"
                     data-file="{{ __('joinUs.units.file') }}"
                     data-files="{{ __('joinUs.units.files') }}"
                     data-selected="{{ __('joinUs.units.selected') }}"></div>

                {{-- Hidden inputs injected by JS --}}
                <div id="docs_inputs"></div>
            </div>

            <div class="jr-nav">
                <button type="button" class="jr-btn-ghost" onclick="jrGoTo(2)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    {{ __('joinUs.buttons.back') }}
                </button>
                <button type="button" class="jr-btn-primary" onclick="jrNext(3)">
                    {{ __('joinUs.buttons.review') }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- ══════════════════ STEP 4 — Review ══════════════════ --}}
        <div class="jr-panel" id="panel4">
            <div class="jr-card" id="jr-review-card"
                 data-empty="{{ __('joinUs.review.empty') }}"
                 data-not-uploaded="{{ __('joinUs.review.not_uploaded') }}"
                 data-none="{{ __('joinUs.review.none') }}">
                <div class="jr-card-title"><span class="dot"></span> {{ __('joinUs.review.title') }}</div>

                <div class="jr-section-label">{{ __('joinUs.sections.personal') }}</div>
                <div id="rv_personal"></div>

                <div class="jr-section-label" style="margin-top:1.5rem">{{ __('joinUs.review.professional') }}</div>
                <div id="rv_professional"></div>

                <div class="jr-section-label" style="margin-top:1.5rem">{{ __('joinUs.review.documents') }}</div>
                <div id="rv_documents"></div>
            </div>

            <div class="jr-nav">
                <button type="button" class="jr-btn-ghost" onclick="jrGoTo(3)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    {{ __('joinUs.buttons.back') }}
                </button>
                <button type="submit" class="jr-btn-primary jr-btn-submit">
                    {{ __('joinUs.buttons.submit') }}
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
            </div>
        </div>

    </form>{{-- end form --}}
@else
    {{-- ══════════════════ Success (shown after redirect with session) ══════════════════ --}}

    <div class="jr-success active">
        <div class="jr-success-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#191231" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h2 style="font-family:'Syne',sans-serif;font-size:24px;font-weight:700;margin-bottom:.75rem;">{{ __('joinUs.success.title') }}</h2>
        <p style="color:var(--text-muted);font-size:15px;line-height:1.6;max-width:380px;margin-bottom:2rem;">
            {{ __('joinUs.success.desc') }}
        </p>
        <span class="jr-badge jr-badge-green">{{ __('joinUs.success.status') }}</span>
    </div>
    @endif

</div>
</div>

<script>
(function () {
    // ── Translations ──
    const translations = {
        required: '{{ __("joinUs.validation.required") }}',
        french_only: '{{ __("joinUs.validation.french_only") }}',
        arabic_only: '{{ __("joinUs.validation.arabic_only") }}',
    };

    // ── State ──
    let current = 1;
    const totalSteps = 4;
    let docsFiles = []; // DataTransfer-backed file list

    // ── Nationality radio ──
    function jrSelectNat(v) {
        document.getElementById('r_jo').classList.toggle('selected', v === 'jordanian');
        document.getElementById('r_nj').classList.toggle('selected', v === 'non_jordanian');
        document.querySelector('input[name="nationality"][value="' + v + '"]').checked = true;
    }
    window.jrSelectNat = jrSelectNat;

    // ── Navigation ──
    function jrGoTo(n) {
        if (n > current) {
            for (let step = current; step < n; step++) {
                if (!validateStep(step)) {
                    if (step !== current) showStep(step);
                    focusFirstInvalid(step);
                    return false;
                }
                document.getElementById('sb' + step).classList.add('done');
            }
        }
        showStep(n);
        return true;
    }
    window.jrGoTo = jrGoTo;

    function showStep(n) {
        document.getElementById('panel' + current).classList.remove('active');
        document.getElementById('sb' + current).classList.remove('active');
        current = n;
        document.getElementById('panel' + current).classList.add('active');
        document.getElementById('sb' + current).classList.add('active');
        document.getElementById('jr-progress').style.width = (n / totalSteps * 100) + '%';
        if (n === totalSteps) buildReview();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function jrNext(from) {
        if (validateStep(from)) {
            document.getElementById('sb' + from).classList.add('done');
            jrGoTo(from + 1);
        } else {
            focusFirstInvalid(from);
        }
    }
    window.jrNext = jrNext;

    function validateStep(step) {
        const panel = document.getElementById('panel' + step);
        let ok = true;

        panel.querySelectorAll('[data-required="true"]').forEach((field) => {
            const fieldOk = isRequiredFieldFilled(field);
            setFieldError(field, !fieldOk, 'required');
            if (!fieldOk) ok = false;
        });

        // Also validate language for all fields in this step
        panel.querySelectorAll('[name*="_fr"], [name*="_ar"]').forEach((field) => {
            if (field.value.trim()) { // only validate if field has content
                if (!validateLanguage(field)) {
                    ok = false;
                }
            }
        });

        if (step === 3) {
            const docsOk = docsFiles.length > 0 || document.getElementById('inp_docs').files.length > 0;
            document.getElementById('docs_field').classList.toggle('has-error', !docsOk);
            if (!docsOk) ok = false;
        }

        return ok;
    }

    function isRequiredFieldFilled(field) {
        if (field.type === 'file') return field.files && field.files.length > 0;
        if (field.type === 'radio') return !!document.querySelector('input[name="' + field.name + '"]:checked');
        return field.value.trim() !== '';
    }

    function setFieldError(field, hasError, msgType = 'required') {
        const wrap = field.closest('.jr-field');
        if (wrap) {
            wrap.classList.toggle('has-error', hasError);
            // Update error message based on type using translations
            const errorMsg = wrap.querySelector('.error-msg');
            if (errorMsg && hasError) {
                if (msgType === 'french') {
                    errorMsg.textContent = translations.french_only;
                } else if (msgType === 'arabic') {
                    errorMsg.textContent = translations.arabic_only;
                } else {
                    errorMsg.textContent = translations.required;
                }
            }
        }
    }

    function focusFirstInvalid(step) {
        const invalid = document.querySelector('#panel' + step + ' .jr-field.has-error input, #panel' + step + ' .jr-field.has-error select, #panel' + step + ' .jr-field.has-error textarea');
        if (invalid) invalid.focus({ preventScroll: true });
    }

    document.querySelectorAll('[data-required="true"]').forEach((field) => {
        field.addEventListener('input', () => setFieldError(field, !isRequiredFieldFilled(field), 'required'));
        field.addEventListener('change', () => setFieldError(field, !isRequiredFieldFilled(field), 'required'));
    });

    // ── Language validation ──
    const frenchRegex = /^[a-zA-Z0-9\s\-'àâäæçéèêëïîôöœûüùß.,!?;:()&%]*$/i;
    const arabicRegex = /^[\u0600-\u06FF0-9\s\-'.,!?;:()&%]*$/;

    function validateLanguage(field) {
        const fieldName = field.name;
        const value = field.value.trim();

        if (!value) return true; // empty is ok (required check handles it)

        if (fieldName.includes('_fr')) {
            // French field: should only contain Latin characters
            if (!frenchRegex.test(value)) {
                setFieldError(field, true, 'french');
                return false;
            } else {
                setFieldError(field, false);
            }
        } else if (fieldName.includes('_ar')) {
            // Arabic field: should only contain Arabic characters
            if (!arabicRegex.test(value)) {
                setFieldError(field, true, 'arabic');
                return false;
            } else {
                setFieldError(field, false);
            }
        }
        return true;
    }

    // Attach language validation to all language-specific fields
    document.querySelectorAll('[name*="_fr"], [name*="_ar"]').forEach((field) => {
        field.addEventListener('input', () => validateLanguage(field));
        field.addEventListener('blur', () => validateLanguage(field));
        field.addEventListener('change', () => validateLanguage(field));
    });

    document.getElementById('jr-form').addEventListener('submit', function (event) {
        for (let step = 1; step < totalSteps; step++) {
            if (!validateStep(step)) {
                event.preventDefault();
                showStep(step);
                focusFirstInvalid(step);
                return;
            }
        }
    });

    // ── Single file (photo / cv) ──
    function jrSingleFile(type, input) {
        if (!input.files.length) return;
        const name = input.files[0].name;
        document.getElementById(type + '_name').textContent = name;
        document.getElementById('zone_' + type).classList.add('has-file');
    }
    window.jrSingleFile = jrSingleFile;

    // ── Multi-doc upload ──
    function jrAddDocs(newFiles) {
        for (let i = 0; i < newFiles.length; i++) {
            const f = newFiles[i];
            if (!docsFiles.find(x => x.name === f.name && x.size === f.size)) docsFiles.push(f);
        }
        renderDocsList();
        syncDocsInput();
        document.getElementById('docs_field').classList.toggle('has-error', docsFiles.length === 0);
    }
    window.jrAddDocs = jrAddDocs;

    function removeDoc(idx) {
        docsFiles.splice(idx, 1);
        renderDocsList();
        syncDocsInput();
        document.getElementById('docs_field').classList.toggle('has-error', docsFiles.length === 0);
    }
    window.removeDoc = removeDoc;

    function renderDocsList() {
        const list  = document.getElementById('docs_list');
        const count = document.getElementById('docs_count');
        const removeLabel = list.dataset.remove;
        list.innerHTML = '';
        docsFiles.forEach((f, i) => {
            const size = f.size < 1024 * 1024 ? Math.round(f.size / 1024) + ' KB' : (f.size / (1024*1024)).toFixed(1) + ' MB';
            const ext  = f.name.split('.').pop().toUpperCase();
            const item = document.createElement('div');
            item.className = 'jr-doc-item';
            item.innerHTML = `
                <div class="jr-doc-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#191231" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="jr-doc-info">
                    <div class="jr-doc-name" title="${f.name}">${f.name}</div>
                    <div class="jr-doc-size">${ext} · ${size}</div>
                </div>
                <button type="button" class="jr-doc-remove" onclick="removeDoc(${i})" title="${removeLabel}">&#x2715;</button>
            `;
            list.appendChild(item);
        });
        if (docsFiles.length) {
            count.style.display = 'block';
            count.textContent = docsFiles.length + ' ' + (docsFiles.length > 1 ? count.dataset.files : count.dataset.file) + ' ' + count.dataset.selected;
        } else {
            count.style.display = 'none';
        }
    }

    // Rebuild a new DataTransfer and assign to a <input type=file name="documents[]">
    function syncDocsInput() {
        const container = document.getElementById('docs_inputs');
        container.innerHTML = '';
        // We use a hidden input per file approach via DataTransfer
        const dt = new DataTransfer();
        docsFiles.forEach(f => dt.items.add(f));
        const inp = document.createElement('input');
        inp.type  = 'file';
        inp.name  = 'documents[]';
        inp.multiple = true;
        inp.style.display = 'none';
        inp.files; // getter
        container.appendChild(inp);
        inp.files = dt.files; // assign DataTransfer files
    }

    // ── Drag & drop ──
    function jrDragOver(e) { e.preventDefault(); document.getElementById('multi_zone').classList.add('drag-over'); }
    function jrDragLeave()  { document.getElementById('multi_zone').classList.remove('drag-over'); }
    function jrDrop(e)      { e.preventDefault(); jrDragLeave(); jrAddDocs(e.dataTransfer.files); }
    window.jrDragOver  = jrDragOver;
    window.jrDragLeave = jrDragLeave;
    window.jrDrop      = jrDrop;

    // ── Review builder ──
    function reviewText(key) {
        return document.getElementById('jr-review-card').dataset[key];
    }

    function cleanLabel(text) {
        return text.replace('*', '').trim();
    }

    function labelFor(id) {
        const label = document.querySelector('label[for="' + id + '"]');
        return label ? cleanLabel(label.textContent) : id;
    }

    function textFor(id) {
        const node = document.getElementById(id);
        return node ? cleanLabel(node.textContent) : id;
    }

    function gv(id) { return document.getElementById(id)?.value || reviewText('empty'); }

    function rv(key, val) {
        return `<div class="jr-review-row">
            <span class="jr-review-key">${key}</span>
            <span class="jr-review-val">${val}</span>
        </div>`;
    }

    function buildReview() {
        const checkedNat = document.querySelector('input[name="nationality"]:checked');
        const nat    = checkedNat?.closest('.jr-radio-option')?.querySelector('.jr-radio-label')?.textContent || reviewText('empty');
        const photo  = document.getElementById('photo_name').textContent || reviewText('notUploaded');
        const cv     = document.getElementById('cv_name').textContent    || reviewText('notUploaded');
        const docsSummary = docsFiles.length ? docsFiles.map(f => f.name).join(', ') : reviewText('none');

        document.getElementById('rv_personal').innerHTML =
            rv(labelFor('name_fr'), gv('name_fr')) +
            rv(labelFor('name_ar'), gv('name_ar')) +
            rv(labelFor('email'), gv('email')) +
            rv(labelFor('phone'), gv('phone')) +
            rv(textFor('nationality_label'), `<span class="jr-badge jr-badge-green">${nat}</span>`);

        document.getElementById('rv_professional').innerHTML =
            rv(labelFor('specialization_fr'), gv('specialization_fr')) +
            rv(labelFor('specialization_ar'), gv('specialization_ar')) +
            rv(labelFor('degree'), gv('degree')) +
            rv(labelFor('graduation_university_fr'), gv('graduation_university_fr')) +
            rv(labelFor('graduation_university_ar'), gv('graduation_university_ar')) +
            rv(labelFor('current_job_fr'), gv('current_job_fr')) +
            rv(labelFor('current_job_ar'), gv('current_job_ar')) +
            rv(labelFor('workplace_fr'), gv('workplace_fr')) +
            rv(labelFor('workplace_ar'), gv('workplace_ar')) +
            rv(labelFor('interests_fr'), `<span style="max-width:280px;display:inline-block;text-align:right">${gv('interests_fr')}</span>`) +
            rv(labelFor('interests_ar'), `<span style="max-width:280px;display:inline-block;text-align:right">${gv('interests_ar')}</span>`) +
            rv(labelFor('bio_fr'), `<span style="max-width:280px;display:inline-block;text-align:right">${gv('bio_fr')}</span>`) +
            rv(labelFor('bio_ar'), `<span style="max-width:280px;display:inline-block;text-align:right">${gv('bio_ar')}</span>`);

        document.getElementById('rv_documents').innerHTML =
            rv(textFor('photo_label'), photo) +
            rv(textFor('cv_label'), cv) +
            rv(textFor('additional_docs_label'), `<span style="max-width:280px;display:inline-block;text-align:right;font-weight:400;color:var(--text-muted)">${docsSummary}</span>`);
    }

    // ── If Laravel returned errors, jump to step 1 ──
    @if ($errors->any())
    document.addEventListener('DOMContentLoaded', function () {
        jrGoTo(1);
    });
    @endif

})();
</script>

@endsection
