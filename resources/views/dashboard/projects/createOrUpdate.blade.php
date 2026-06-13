@extends('adminLayouts.app')

@section('content')
@php
    $locales = [
        'en' => 'English',
        'ar' => 'Arabic',
        'fr' => 'French',
    ];
    $translationsByLocale = $translationsByLocale ?? collect();
@endphp

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
        <h1 class="mgmt-title">{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h1>
        <a href="{{ route('projects.index') }}" class="btn-add">
            <span class="btn-add__icon">←</span> Back to list
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="mgmt-card">

        @if (isset($project))
            <form action="{{ route('projects.update', $project->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('projects.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
        @endif
        @csrf

        <div class="mgmt-form__body">

            @if(isset($project))
                @foreach($locales as $locale => $label)
                    @php
                        $localeTranslation = $translationsByLocale->get($locale);
                        $titleError = "translations.$locale.title";
                        $descriptionError = "translations.$locale.description";
                    @endphp

                    <div class="mgmt-card__header" style="margin: 0 0 16px; border-radius: 8px;">
                        <span class="mgmt-card__label">{{ $label }} Content</span>
                    </div>

                    <div class="mgmt-form__row">
                        <div class="mgmt-form__group">
                            <label class="mgmt-form__label">Title ({{ strtoupper($locale) }})</label>
                            <input type="text"
                                   name="translations[{{ $locale }}][title]"
                                   class="mgmt-form__control @error($titleError) is-invalid @enderror"
                                   required
                                   value="{{ old("translations.$locale.title", $localeTranslation->title ?? '') }}">
                            @error($titleError)
                                <small class="mgmt-form__error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mgmt-form__row">
                        <div class="mgmt-form__group">
                            <label class="mgmt-form__label">Description ({{ strtoupper($locale) }})</label>
                            <textarea name="translations[{{ $locale }}][description]"
                                      class="mgmt-form__control @error($descriptionError) is-invalid @enderror"
                                      required
                                      rows="3">{{ old("translations.$locale.description", $localeTranslation->description ?? '') }}</textarea>
                            @error($descriptionError)
                                <small class="mgmt-form__error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mgmt-form__row">
                    <div class="mgmt-form__group">
                        <label class="mgmt-form__label">Title</label>
                        <input type="text"
                               name="title"
                               class="mgmt-form__control @error('title') is-invalid @enderror"
                               required
                               value="{{ old('title') }}">
                        @error('title')
                            <small class="mgmt-form__error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mgmt-form__row">
                    <div class="mgmt-form__group">
                        <label class="mgmt-form__label">Description</label>
                        <textarea name="description"
                                  class="mgmt-form__control @error('description') is-invalid @enderror"
                                  required
                                  rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="mgmt-form__error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            @endif

            {{-- ROW 3: STATUS --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Status</label>

                    <select name="status"
                            class="mgmt-form__control @error('status') is-invalid @enderror">

                        <option value="">Select Status</option>

                        <option value="coming_soon"
                            {{ (old('status', $project->status ?? '') == 'coming_soon') ? 'selected' : '' }}>
                            Coming Soon
                        </option>

                        <option value="active"
                            {{ (old('status', $project->status ?? '') == 'active') ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="completed"
                            {{ (old('status', $project->status ?? '') == 'completed') ? 'selected' : '' }}>
                            Completed
                        </option>

                    </select>

                    @error('status')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- ROW 4: IMAGE --}}
            <div class="mgmt-form__row">
                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Project Photo</label>
                    <input type="file"
                           name="image"
                           accept="image/*"
                           class="mgmt-form__control @error('image') is-invalid @enderror"
                           onchange="previewImage(event)">
                    @error('image')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror

                    <div style="margin-top:12px;">
                        <img id="imagePreview"
                             src="{{ isset($project) && $project->image ? asset('storage/'.$project->image) : '' }}"
                             alt="Project photo preview"
                             style="{{ isset($project) && $project->image ? '' : 'display:none;' }} max-height:130px; object-fit:cover; border-radius:8px;">
                    </div>
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="mgmt-form__actions">
                <button type="submit" class="btn-add">
                    {{ isset($project) ? 'Update Project' : 'Save Project' }}
                </button>
            </div>

        </div>

        </form>
    </div>
</div>

{{-- IMAGE PREVIEW SCRIPT (kept empty but unchanged structure style) --}}
<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files && event.target.files[0];

    if (!file) {
        preview.style.display = 'none';
        preview.src = '';
        return;
    }

    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
}

document.querySelectorAll('.alert-toast').forEach(function(el) {
    setTimeout(function() {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    }, 4000);
});
</script>

@endsection
