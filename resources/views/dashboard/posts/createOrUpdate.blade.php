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
        <h1 class="mgmt-title">{{ isset($post) ? 'Edit Post' : 'Add Post' }}</h1>
        <a href="{{ route('posts.index') }}" class="btn-add">
            <span class="btn-add__icon">←</span> Back to list
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="mgmt-card">

        @if (isset($post))
            <form action="{{ route('posts.update', $post->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('posts.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
        @endif
        @csrf

        <div class="mgmt-form__body">

            {{-- ROW 1: TITLE (AR / FR) --}}
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

            {{-- ROW 3: DATE + TYPE --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Event Date</label>
                    <input type="date"
                           name="event_date"
                           class="mgmt-form__control @error('event_date') is-invalid @enderror"
                           value="{{ old('event_date', $post->event_date ?? '') }}">
                    @error('event_date')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Type</label>
                    <select name="type"
                            class="mgmt-form__control @error('type') is-invalid @enderror">

                        <option value="">Select Type</option>

                        <option value="news"
                            {{ (old('type', $post->type ?? '') == 'news') ? 'selected' : '' }}>
                            News
                        </option>

                        <option value="memory"
                            {{ (old('type', $post->type ?? '') == 'memory') ? 'selected' : '' }}>
                            Memory
                        </option>

                    </select>

                    @error('type')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- ROW 4: IMAGE --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Image</label>
                    <input type="file"
                           name="image"
                           class="mgmt-form__control @error('image') is-invalid @enderror"
                           onchange="previewImage(event)">
                    @error('image')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group mgmt-form__group--preview">
                    <label class="mgmt-form__label">Preview</label>
                    <div class="mgmt-avatar-wrap">
                        <img id="preview"
                             src="{{ isset($post->image)
                                ? asset('storage/'.$post->image)
                                : 'https://via.placeholder.com/130' }}"
                             class="mgmt-avatar mgmt-avatar--preview"
                             style="max-height:130px; object-fit:cover;">
                    </div>
                </div>

            </div>

            {{-- ACTIONS --}}
            <div class="mgmt-form__actions">
                <button type="submit" class="btn-add">
                    {{ isset($post) ? 'Update Post' : 'Save Post' }}
                </button>
            </div>

        </div>

        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
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
