@extends('adminLayouts.app')

@section('content')

@if (session('success'))
    <div class="alert-toast alert-toast--success" id="successAlert">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        {{ session('success') }}
        <button class="alert-toast__close" onclick="this.parentElement.remove()">&#x2715;</button>
    </div>
@endif

@if (session('error'))
    <div class="alert-toast alert-toast--error" id="errorAlert">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M8 5v3M8 10.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        {{ session('error') }}
        <button class="alert-toast__close" onclick="this.parentElement.remove()">&#x2715;</button>
    </div>
@endif

<div class="mgmt-wrap">

    {{-- PAGE HEADER --}}
    <div class="mgmt-header">
        <h1 class="mgmt-title">{{ isset($management) ? 'Edit Manager' : 'Add Manager' }}</h1>
        <a href="{{ route('managements.index') }}" class="btn-add">
            <span class="btn-add__icon">←</span> Back to list
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="mgmt-card">

        @if (isset($management))
            <form action="{{ route('managements.update', $management->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('managements.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
        @endif
        @csrf

        <div class="mgmt-form__body">

            {{-- ROW 1: NAMES --}}
            <div class="mgmt-form__row">
                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Name (Arabic)</label>
                    <input type="text"
                           name="name_ar"
                           class="mgmt-form__control @error('name_ar') is-invalid @enderror"
                           value="{{ old('name_ar', $ar->name ?? '') }}">
                    @error('name_ar')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Name (French)</label>
                    <input type="text"
                           name="name_fr"
                           class="mgmt-form__control @error('name_fr') is-invalid @enderror"
                           value="{{ old('name_fr', $fr->name ?? '') }}">
                    @error('name_fr')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- ROW 2: BIO --}}
            <div class="mgmt-form__row">
                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Bio (Arabic)</label>
                    <textarea name="bio_ar"
                              class="mgmt-form__control @error('bio_ar') is-invalid @enderror"
                              rows="3">{{ old('bio_ar', $ar->bio ?? '') }}</textarea>
                    @error('bio_ar')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Bio (French)</label>
                    <textarea name="bio_fr"
                              class="mgmt-form__control @error('bio_fr') is-invalid @enderror"
                              rows="3">{{ old('bio_fr', $fr->bio ?? '') }}</textarea>
                    @error('bio_fr')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- ROW 3: EMAIL, PHONE, POSITION, TYPE --}}
            <div class="mgmt-form__row">
                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Email</label>
                    <input type="email"
                           name="email"
                           class="mgmt-form__control @error('email') is-invalid @enderror"
                           value="{{ old('email', $management->email ?? '') }}">
                    @error('email')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Phone</label>
                    <input type="tel"
                           name="phone"
                           class="mgmt-form__control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $management->phone ?? '') }}">
                    @error('phone')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Position</label>
                    <select name="position"
                            class="mgmt-form__control @error('position') is-invalid @enderror">
                        <option value="">Select Position</option>
                        @foreach([
                            'president' => 'President',
                            'vice_president' => 'Vice President',
                            'secretary' => 'Secretary',
                            'treasurer' => 'Treasurer',
                            'board_member' => 'Board Member'
                        ] as $key => $label)
                            <option value="{{ $key }}"
                                {{ (old('position', $management->position ?? '') == $key) ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('position')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Type</label>
                    <select name="type"
                            class="mgmt-form__control @error('type') is-invalid @enderror">
                        <option value="">Select Type</option>
                        <option value="current"
                            {{ (old('type', $management->type ?? '') == 'current') ? 'selected' : '' }}>
                            Current
                        </option>
                        <option value="former"
                            {{ (old('type', $management->type ?? '') == 'former') ? 'selected' : '' }}>
                            Former
                        </option>
                        <option value="honorary"
                            {{ (old('type', $management->type ?? '') == 'honorary') ? 'selected' : '' }}>
                            Honorary
                        </option>
                        <option value="consultant"
                            {{ (old('type', $management->type ?? '') == 'consultant') ? 'selected' : '' }}>
                            Consultant
                        </option>
                    </select>
                    @error('type')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- ROW 4: PHOTO WITH PREVIEW --}}
            <div class="mgmt-form__row">
                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Photo</label>
                    <input type="file"
                           name="photo"
                           class="mgmt-form__control @error('photo') is-invalid @enderror"
                           onchange="previewImage(event)">
                    @error('photo')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group mgmt-form__group--preview">
                    <label class="mgmt-form__label">Preview</label>
                    <div class="mgmt-avatar-wrap">
                        <img id="preview"
                             src="{{ isset($management->photo)
                                ? asset('storage/'.$management->photo)
                                : 'https://via.placeholder.com/130' }}"
                             class="mgmt-avatar mgmt-avatar--preview"
                             style="max-height:130px; object-fit:cover;">
                    </div>
                </div>
            </div>

            {{-- FORM ACTIONS --}}
            <div class="mgmt-form__actions">
                <button type="submit" class="btn-add">
                    {{ isset($management) ? 'Update Manager' : 'Save Manager' }}
                </button>
            </div>

        </div>

        </form>
    </div>
</div>

{{-- STYLES (extended from index) --}}
<style>
</style>

{{-- IMAGE PREVIEW + AUTO-DISMISS SCRIPT --}}
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

// Auto-dismiss toasts after 4 seconds
document.querySelectorAll('.alert-toast').forEach(function(el) {
    setTimeout(function() {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    }, 4000);
});
</script>

@endsection
