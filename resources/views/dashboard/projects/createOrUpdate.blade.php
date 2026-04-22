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
        <h1 class="mgmt-title">{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h1>
        <a href="{{ route('projects.index') }}" class="btn-add">
            <span class="btn-add__icon">←</span> Back to list
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="mgmt-card">

        @if (isset($project))
            <form action="{{ route('projects.update', $project->id) }}"
                  method="POST">
            @method('PUT')
        @else
            <form action="{{ route('projects.store') }}"
                  method="POST">
        @endif
        @csrf

        <div class="mgmt-form__body">

            {{-- ROW 1: TITLE --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Title (Arabic)</label>
                    <input type="text"
                           name="title_ar"
                           class="mgmt-form__control @error('title_ar') is-invalid @enderror"
                           value="{{ old('title_ar', $ar->title ?? '') }}">
                    @error('title_ar')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Title (French)</label>
                    <input type="text"
                           name="title_fr"
                           class="mgmt-form__control @error('title_fr') is-invalid @enderror"
                           value="{{ old('title_fr', $fr->title ?? '') }}">
                    @error('title_fr')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- ROW 2: DESCRIPTION --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Description (Arabic)</label>
                    <textarea name="description_ar"
                              class="mgmt-form__control @error('description_ar') is-invalid @enderror"
                              rows="3">{{ old('description_ar', $ar->description ?? '') }}</textarea>
                    @error('description_ar')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Description (French)</label>
                    <textarea name="description_fr"
                              class="mgmt-form__control @error('description_fr') is-invalid @enderror"
                              rows="3">{{ old('description_fr', $fr->description ?? '') }}</textarea>
                    @error('description_fr')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

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
document.querySelectorAll('.alert-toast').forEach(function(el) {
    setTimeout(function() {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    }, 4000);
});
</script>

@endsection
