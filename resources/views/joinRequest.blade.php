@extends('userLayouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
:root {
    --brand: #22c55e;
    --brand-dark: #16a34a;
    --brand-light: #dcfce7;
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

.jr-wrap {
    position: relative;
    z-index: 3;
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    max-width: 720px;
    margin: 0 auto;
    padding: 2.5rem 2rem 5rem;
    border-radius: 2%;
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
.jr-tag span { width: 7px; height: 7px; border-radius: 50%; background: var(--brand); display: inline-block; }
.jr-header h1 {
    font-family: 'Syne', sans-serif; font-size: 30px; font-weight: 700;
    color: var(--text); line-height: 1.2; margin-bottom: 0.5rem;
}
.jr-header p { color: var(--text-muted); font-size: 15px; line-height: 1.6; }

/* ── Progress ── */
.jr-progress { height: 3px; background: var(--border); border-radius: 100px; margin-bottom: 2rem; overflow: hidden; }
.jr-progress-fill { height: 100%; background: var(--brand); border-radius: 100px; transition: width 0.4s cubic-bezier(.4,0,.2,1); }

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
.jr-card-title .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--brand); flex-shrink: 0; }

/* ── Section label ── */
.jr-section-label {
    font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;
    color: var(--text-muted); margin-bottom: 1rem; padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
}

/* ── Fields ── */
.jr-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.jr-grid.full { grid-template-columns: 1fr; }
.jr-field { display: flex; flex-direction: column; gap: 6px; }
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
    outline: none; width: 100%;
}
.jr-field textarea { resize: vertical; min-height: 90px; line-height: 1.6; }
.jr-field input:focus,
.jr-field select:focus,
.jr-field textarea:focus { border-color: var(--brand); background: #fff; }
.jr-field input::placeholder,
.jr-field textarea::placeholder { color: #94a3b8; }
.jr-field input.invalid { border-color: var(--danger) !important; }
.jr-field .error-msg { font-size: 12px; color: var(--danger); display: none; }
.jr-field.has-error .error-msg { display: block; }
.jr-field.has-error input,
.jr-field.has-error select { border-color: var(--danger); }
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
.jr-radio-option:hover { border-color: var(--brand); background: #f0fdf4; }
.jr-radio-option.selected { border-color: var(--brand); background: var(--brand-light); }
.jr-radio-option input[type=radio] { display: none; }
.jr-radio-dot {
    width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--border);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s;
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
.jr-upload-zone:hover { border-color: var(--brand); background: #f0fdf4; }
.jr-upload-zone.has-file { border-color: var(--brand); border-style: solid; background: var(--brand-light); }
.jr-upload-zone input[type=file] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
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
    padding: 1.5rem; background: var(--bg); transition: all 0.2s; position: relative;
    cursor: pointer;
}
.jr-multi-zone:hover,
.jr-multi-zone.drag-over { border-color: var(--brand); background: #f0fdf4; }
.jr-multi-zone input[type=file] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.jr-multi-zone-inner {
    display: flex; flex-direction: column; align-items: center; gap: 6px; pointer-events: none;
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
.jr-docs-count {
    font-size: 12px; color: var(--text-muted); margin-top: 8px; text-align: right;
}

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
.jr-btn-primary:hover { background: var(--brand-dark); }
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

/* ── Panels ── */
.jr-panel { display: none; animation: fadeUp 0.3s ease; }
.jr-panel.active { display: block; }
.jr-success { display: none; flex-direction: column; align-items: center; text-align: center; padding: 4rem 2rem; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); }
.jr-success.active { display: flex; }
.jr-success-icon { width: 68px; height: 68px; border-radius: 50%; background: var(--brand-light); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; }

@keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
@keyframes slideIn { from { opacity: 0; transform: translateX(-6px); } to { opacity: 1; transform: translateX(0); } }

@media (max-width: 540px) {
    .jr-grid { grid-template-columns: 1fr; }
    .jr-steps { flex-wrap: wrap; border-radius: 12px; }
    .jr-step-btn { font-size: 12px; padding: 8px 4px; }
}

/* ── Validation errors from Laravel ── */
.jr-alert-errors {
    background: var(--danger-light); border: 1px solid #fecaca;
    border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.5rem;
    font-size: 13px; color: #b91c1c;
}
.jr-alert-errors ul { padding-left: 1.2rem; margin-top: 6px; }
.jr-alert-errors li { margin-bottom: 2px; }
/* background */
.s-home::after {
    background-color: transparent;
}
.s-home {
    display: flex;
    justify-content: center;
    align-items: flex-start; /* instead of center */
    padding-top: 120px; /* space under navbar */
    min-height: 130vh;
    height: auto;
}
</style>
<section id="home" class="s-home target-section d-flex align-items-start justify-content-center">
<div class="jr-wrap">

    {{-- Laravel validation errors --}}
    @if ($errors->any())
    <div class="jr-alert-errors">
        <strong>Please fix the following errors:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Header --}}
    <div class="jr-header">
        <div class="jr-tag"><span></span> Membership Application</div>
        <h1>Join Our Network</h1>
        <p>Fill out the form below to submit your join request. Fields marked <span style="color:var(--brand)">*</span> are required.</p>
    </div>

    {{-- Progress bar --}}
    <div class="jr-progress">
        <div class="jr-progress-fill" id="jr-progress" style="width:33%"></div>
    </div>

    {{-- Step pills --}}
    <div class="jr-steps">
        <button type="button" class="jr-step-btn active" id="sb1" onclick="jrGoTo(1)">
            <span class="jr-step-num">1</span> Basic Info
        </button>
        <button type="button" class="jr-step-btn" id="sb2" onclick="jrGoTo(2)">
            <span class="jr-step-num">2</span> Professional
        </button>
        <button type="button" class="jr-step-btn" id="sb3" onclick="jrGoTo(3)">
            <span class="jr-step-num">3</span> Documents
        </button>
        <button type="button" class="jr-step-btn" id="sb4" onclick="jrGoTo(4)">
            <span class="jr-step-num">4</span> Review
        </button>
    </div>

    <form action="{{ route('join-us.store') }}" method="POST" enctype="multipart/form-data" id="jr-form" novalidate>
        @csrf

        {{-- ══════════════════ STEP 1 — Basic Info ══════════════════ --}}
        <div class="jr-panel active" id="panel1">

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> Personal Information</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">

                    <div class="jr-grid">
                        <div class="jr-field @error('name') has-error @enderror">
                            <label for="name">Full Name <span class="req">*</span></label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Ahmad Al-Hassan"
                                   data-required="true" />
                            <span class="error-msg">
                                @error('name') {{ $message }} @else Name is required @enderror
                            </span>
                        </div>
                        <div class="jr-field @error('email') has-error @enderror">
                            <label for="email">Email Address <span class="req">*</span></label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="ahmad@example.com"
                                   data-required="true" />
                            <span class="error-msg">
                                @error('email') {{ $message }} @else Valid email is required @enderror
                            </span>
                        </div>
                    </div>

                    <div class="jr-field @error('phone') has-error @enderror">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone"
                               value="{{ old('phone') }}"
                               placeholder="+962 7X XXX XXXX" />
                        @error('phone')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                    </div>

                    <div class="jr-field @error('nationality') has-error @enderror">
                        <label>Nationality <span class="req">*</span></label>
                        <div class="jr-radio-group">
                            <label class="jr-radio-option {{ old('nationality', 'jordanian') === 'jordanian' ? 'selected' : '' }}"
                                   id="r_jo" onclick="jrSelectNat('jordanian')">
                                <input type="radio" name="nationality" value="jordanian"
                                       {{ old('nationality', 'jordanian') === 'jordanian' ? 'checked' : '' }} />
                                <span class="jr-radio-dot"></span>
                                <span class="jr-radio-label">Jordanian</span>
                            </label>
                            <label class="jr-radio-option {{ old('nationality') === 'non_jordanian' ? 'selected' : '' }}"
                                   id="r_nj" onclick="jrSelectNat('non_jordanian')">
                                <input type="radio" name="nationality" value="non_jordanian"
                                       {{ old('nationality') === 'non_jordanian' ? 'checked' : '' }} />
                                <span class="jr-radio-dot"></span>
                                <span class="jr-radio-label">Non-Jordanian</span>
                            </label>
                        </div>
                        @error('nationality')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>

            <div class="jr-nav">
                <div></div>
                <button type="button" class="jr-btn-primary" onclick="jrNext(1)">
                    Continue
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- ══════════════════ STEP 2 — Professional ══════════════════ --}}
        <div class="jr-panel" id="panel2">

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> Academic Background</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div class="jr-grid">
                        <div class="jr-field @error('specialization') has-error @enderror">
                            <label for="specialization">Specialization</label>
                            <input type="text" id="specialization" name="specialization"
                                   value="{{ old('specialization') }}"
                                   placeholder="e.g. Computer Science" />
                            @error('specialization')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                        </div>
                        <div class="jr-field @error('degree') has-error @enderror">
                            <label for="degree">Highest Degree</label>
                            <select id="degree" name="degree">
                                <option value="">Select degree</option>
                                @foreach(["Bachelor's", "Master's", "PhD", "Postdoctoral", "Other"] as $deg)
                                    <option value="{{ $deg }}" {{ old('degree') === $deg ? 'selected' : '' }}>{{ $deg }}</option>
                                @endforeach
                            </select>
                            @error('degree')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="jr-field @error('graduation_university') has-error @enderror">
                        <label for="graduation_university">Graduation University (France)</label>
                        <input type="text" id="graduation_university" name="graduation_university"
                               value="{{ old('graduation_university') }}"
                               placeholder="e.g. Université Paris-Saclay" />
                        @error('graduation_university')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> Current Position</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div class="jr-grid">
                        <div class="jr-field @error('current_job') has-error @enderror">
                            <label for="current_job">Current Job Title</label>
                            <input type="text" id="current_job" name="current_job"
                                   value="{{ old('current_job') }}"
                                   placeholder="e.g. Senior Engineer" />
                            @error('current_job')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                        </div>
                        <div class="jr-field @error('workplace') has-error @enderror">
                            <label for="workplace">Workplace / Organization</label>
                            <input type="text" id="workplace" name="workplace"
                                   value="{{ old('workplace') }}"
                                   placeholder="e.g. Ministry of Education" />
                            @error('workplace')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> About You</div>
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div class="jr-field @error('interests') has-error @enderror">
                        <label for="interests">Areas of Interest</label>
                        <textarea id="interests" name="interests" placeholder="Research areas, hobbies, professional interests...">{{ old('interests') }}</textarea>
                        @error('interests')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                    </div>
                    <div class="jr-field @error('bio') has-error @enderror">
                        <label for="bio">Short Bio</label>
                        <textarea id="bio" name="bio" placeholder="A brief paragraph introducing yourself to the network...">{{ old('bio') }}</textarea>
                        @error('bio')<span class="error-msg" style="display:block">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="jr-nav">
                <button type="button" class="jr-btn-ghost" onclick="jrGoTo(1)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button type="button" class="jr-btn-primary" onclick="jrNext(2)">
                    Continue
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- ══════════════════ STEP 3 — Documents ══════════════════ --}}
        <div class="jr-panel" id="panel3">

            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> Profile Photo & CV</div>
                <div class="jr-grid">
                    {{-- Photo --}}
                    <div class="jr-field @error('photo') has-error @enderror">
                        <label>Profile Photo</label>
                        <div class="jr-upload-zone" id="zone_photo">
                            <input type="file" name="photo" id="inp_photo"
                                   accept="image/jpeg,image/png,image/webp"
                                   onchange="jrSingleFile('photo', this)" />
                            <div class="jr-upload-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                            </div>
                            <div class="jr-upload-title">Upload photo</div>
                            <div class="jr-upload-sub">JPG, PNG, WEBP — max 5MB</div>
                            <div class="jr-file-name" id="photo_name"></div>
                        </div>
                        @error('photo')<span class="error-msg" style="display:block;margin-top:4px">{{ $message }}</span>@enderror
                    </div>

                    {{-- CV --}}
                    <div class="jr-field @error('cv') has-error @enderror">
                        <label>CV / Résumé</label>
                        <div class="jr-upload-zone" id="zone_cv">
                            <input type="file" name="cv" id="inp_cv"
                                   accept=".pdf,.doc,.docx"
                                   onchange="jrSingleFile('cv', this)" />
                            <div class="jr-upload-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            </div>
                            <div class="jr-upload-title">Upload CV</div>
                            <div class="jr-upload-sub">PDF, DOC, DOCX — max 10MB</div>
                            <div class="jr-file-name" id="cv_name"></div>
                        </div>
                        @error('cv')<span class="error-msg" style="display:block;margin-top:4px">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Multi-doc upload --}}
            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> Additional Documents</div>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:1rem;line-height:1.6;">
                    Attach any supporting documents: certificates, recommendation letters, research papers, etc.
                    You can upload multiple files at once.
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
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <div class="jr-multi-zone-title">Drop files here or click to browse</div>
                        <div class="jr-multi-zone-sub">PDF, DOC, DOCX, JPG, PNG — max 10MB each</div>
                    </div>
                </div>

                <div id="docs_list" class="jr-docs-list"></div>
                <div id="docs_count" class="jr-docs-count" style="display:none"></div>

                {{-- Hidden inputs injected by JS --}}
                <div id="docs_inputs"></div>
            </div>

            <div class="jr-nav">
                <button type="button" class="jr-btn-ghost" onclick="jrGoTo(2)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button type="button" class="jr-btn-primary" onclick="jrNext(3)">
                    Review
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- ══════════════════ STEP 4 — Review ══════════════════ --}}
        <div class="jr-panel" id="panel4">
            <div class="jr-card">
                <div class="jr-card-title"><span class="dot"></span> Review Your Application</div>

                <div class="jr-section-label">Personal Details</div>
                <div id="rv_personal"></div>

                <div class="jr-section-label" style="margin-top:1.5rem">Professional Details</div>
                <div id="rv_professional"></div>

                <div class="jr-section-label" style="margin-top:1.5rem">Documents</div>
                <div id="rv_documents"></div>
            </div>

            <div class="jr-nav">
                <button type="button" class="jr-btn-ghost" onclick="jrGoTo(3)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button type="submit" class="jr-btn-primary jr-btn-submit">
                    Submit Application
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
            </div>
        </div>

    </form>{{-- end form --}}

    {{-- ══════════════════ Success (shown after redirect with session) ══════════════════ --}}
    @if(session('success'))
    <div class="jr-success active">
        <div class="jr-success-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h2 style="font-family:'Syne',sans-serif;font-size:24px;font-weight:700;margin-bottom:.75rem;">Application Submitted!</h2>
        <p style="color:var(--text-muted);font-size:15px;line-height:1.6;max-width:380px;margin-bottom:2rem;">
            Thank you for your application. We'll review your request and get back to you via email within 3–5 business days.
        </p>
        <span class="jr-badge jr-badge-green">Status: Pending Review</span>
    </div>
    @endif

</div>
</div>

<script>
(function () {
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
        document.getElementById('panel' + current).classList.remove('active');
        document.getElementById('sb' + current).classList.remove('active');
        current = n;
        document.getElementById('panel' + current).classList.add('active');
        document.getElementById('sb' + current).classList.add('active');
        document.getElementById('jr-progress').style.width = (n / totalSteps * 100) + '%';
        if (n === totalSteps) buildReview();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    window.jrGoTo = jrGoTo;

    function jrNext(from) {
        if (from === 1) {
            const name  = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            let ok = true;
            setFieldError('name',  !name,  'Name is required');
            setFieldError('email', !email, 'Valid email is required');
            if (!name || !email) return;
        }
        document.getElementById('sb' + from).classList.add('done');
        jrGoTo(from + 1);
    }
    window.jrNext = jrNext;

    function setFieldError(id, hasError, msg) {
        const wrap = document.getElementById(id).closest('.jr-field');
        wrap.classList.toggle('has-error', hasError);
    }

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
            if (f.size > 10 * 1024 * 1024) { alert(f.name + ' exceeds 10MB and was skipped.'); continue; }
            if (!docsFiles.find(x => x.name === f.name && x.size === f.size)) docsFiles.push(f);
        }
        renderDocsList();
        syncDocsInput();
    }
    window.jrAddDocs = jrAddDocs;

    function removeDoc(idx) {
        docsFiles.splice(idx, 1);
        renderDocsList();
        syncDocsInput();
    }
    window.removeDoc = removeDoc;

    function renderDocsList() {
        const list  = document.getElementById('docs_list');
        const count = document.getElementById('docs_count');
        list.innerHTML = '';
        docsFiles.forEach((f, i) => {
            const size = f.size < 1024 * 1024 ? Math.round(f.size / 1024) + ' KB' : (f.size / (1024*1024)).toFixed(1) + ' MB';
            const ext  = f.name.split('.').pop().toUpperCase();
            const item = document.createElement('div');
            item.className = 'jr-doc-item';
            item.innerHTML = `
                <div class="jr-doc-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="jr-doc-info">
                    <div class="jr-doc-name" title="${f.name}">${f.name}</div>
                    <div class="jr-doc-size">${ext} · ${size}</div>
                </div>
                <button type="button" class="jr-doc-remove" onclick="removeDoc(${i})" title="Remove">&#x2715;</button>
            `;
            list.appendChild(item);
        });
        if (docsFiles.length) {
            count.style.display = 'block';
            count.textContent = docsFiles.length + ' file' + (docsFiles.length > 1 ? 's' : '') + ' selected';
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
    function gv(id) { return document.getElementById(id)?.value || '—'; }

    function rv(key, val) {
        return `<div class="jr-review-row">
            <span class="jr-review-key">${key}</span>
            <span class="jr-review-val">${val}</span>
        </div>`;
    }

    function buildReview() {
        const nat    = document.querySelector('input[name="nationality"]:checked')?.value === 'jordanian' ? 'Jordanian' : 'Non-Jordanian';
        const photo  = document.getElementById('photo_name').textContent || 'Not uploaded';
        const cv     = document.getElementById('cv_name').textContent    || 'Not uploaded';
        const docsSummary = docsFiles.length ? docsFiles.map(f => f.name).join(', ') : 'None';

        document.getElementById('rv_personal').innerHTML =
            rv('Full Name', gv('name')) +
            rv('Email', gv('email')) +
            rv('Phone', gv('phone') || '—') +
            rv('Nationality', `<span class="jr-badge jr-badge-green">${nat}</span>`);

        document.getElementById('rv_professional').innerHTML =
            rv('Specialization', gv('specialization')) +
            rv('Highest Degree', gv('degree')) +
            rv('University (France)', gv('graduation_university')) +
            rv('Current Job', gv('current_job')) +
            rv('Workplace', gv('workplace')) +
            rv('Interests', `<span style="max-width:280px;display:inline-block;text-align:right">${gv('interests')}</span>`) +
            rv('Bio', `<span style="max-width:280px;display:inline-block;text-align:right">${gv('bio')}</span>`);

        document.getElementById('rv_documents').innerHTML =
            rv('Profile Photo', photo) +
            rv('CV / Résumé', cv) +
            rv('Additional Docs', `<span style="max-width:280px;display:inline-block;text-align:right;font-weight:400;color:var(--text-muted)">${docsSummary}</span>`);
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
