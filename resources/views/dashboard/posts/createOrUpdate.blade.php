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

            {{-- ROW 1: TITLE --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Title</label>
                    <input type="text"
                           name="title"
                           class="mgmt-form__control @error('title') is-invalid @enderror"
                           required
                           value="{{ old('title', $translation->title ?? '') }}">
                    @error('title')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- ROW 2: DESCRIPTION --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Description</label>
                    <textarea name="description"
                              class="mgmt-form__control @error('description') is-invalid @enderror"
                              required
                              rows="3">{{ old('description', $translation->description ?? '') }}</textarea>
                    @error('description')
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
                           required
                           value="{{ old('event_date', isset($post) && $post->event_date ? $post->event_date->format('Y-m-d') : '') }}">
                    @error('event_date')
                        <small class="mgmt-form__error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Type</label>
                    <select name="type"
                            class="mgmt-form__control @error('type') is-invalid @enderror"
                            required>

                        <option value="">Select Type</option>

                        <option value="event"
                            {{ (old('type', $post->type ?? '') == 'event') ? 'selected' : '' }}>
                            Event
                        </option>

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

            {{-- ROW 4: SIGNATURE PHOTO --}}
            <div class="mgmt-form__row">

                <div class="mgmt-form__group">
                    <label class="mgmt-form__label">Signature Photo</label>
                    <input type="file"
                           name="image"
                           accept="image/*"
                           class="mgmt-form__control @error('image') is-invalid @enderror"
                           {{ isset($post) && $post->image ? '' : 'required' }}
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

            {{-- ROW 5: PHOTOS --}}
            <div class="mgmt-form__group">
                <label class="mgmt-form__label">Photos</label>
                <input type="file"
                       id="photosInput"
                       name="photos[]"
                       accept="image/*"
                       multiple
                       class="mgmt-form__control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror">

                @error('photos')
                    <small class="mgmt-form__error">{{ $message }}</small>
                @enderror
                @error('photos.*')
                    <small class="mgmt-form__error">{{ $message }}</small>
                @enderror

                <div id="photosPreview" class="media-preview-grid">
                    @foreach(($post->photos ?? []) as $photo)
                        <div class="media-preview-card" data-existing-media="photo">
                            <input type="hidden" name="existing_photos[]" value="{{ $photo }}">
                            <button type="button" class="media-remove" aria-label="Remove photo">&times;</button>
                            <img src="{{ asset('storage/'.$photo) }}" alt="Post photo">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ROW 6: VIDEOS --}}
            <div class="mgmt-form__group">
                <label class="mgmt-form__label">Videos</label>
                <input type="file"
                       id="videosInput"
                       name="videos[]"
                       accept="video/*"
                       multiple
                       class="mgmt-form__control @error('videos') is-invalid @enderror @error('videos.*') is-invalid @enderror">

                @error('videos')
                    <small class="mgmt-form__error">{{ $message }}</small>
                @enderror
                @error('videos.*')
                    <small class="mgmt-form__error">{{ $message }}</small>
                @enderror

                <small id="videoLoadingStatus" class="mgmt-form__hint" style="display:none;">
                    Loading selected videos...
                </small>

                <div id="videosPreview" class="media-preview-grid media-preview-grid--videos">
                    @foreach(($post->videos ?? []) as $video)
                        @php
                            $extension = strtolower(pathinfo($video, PATHINFO_EXTENSION));
                            $mimeType = match ($extension) {
                                'mp4' => 'video/mp4',
                                'webm' => 'video/webm',
                                'ogg' => 'video/ogg',
                                'mov' => 'video/quicktime',
                                'avi' => 'video/x-msvideo',
                                'wmv' => 'video/x-ms-wmv',
                                default => 'video/*',
                            };
                        @endphp
                        <div class="media-preview-card media-preview-card--video" data-existing-media="video">
                            <input type="hidden" name="existing_videos[]" value="{{ $video }}">
                            <button type="button" class="media-remove" aria-label="Remove video">&times;</button>
                            <video controls preload="metadata" playsinline>
                                <source src="{{ asset('storage/'.$video) }}" type="{{ $mimeType }}">
                                {{ __('posts.video_unsupported') ?? 'Your browser does not support this video format.' }}
                            </video>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="mgmt-form__actions">
                <button type="submit" class="btn-add" id="submitButton">
                    {{ isset($post) ? 'Update Post' : 'Save Post' }}
                </button>
            </div>

        </div>

        </form>
    </div>
</div>

<style>
.media-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 14px;
    margin-top: 14px;
}

.media-preview-card {
    position: relative;
    overflow: hidden;
    border: 1px solid var(--color-accent-light);
    border-radius: 8px;
    background: var(--color-bg);
    aspect-ratio: 4 / 3;
}

.media-preview-card img,
.media-preview-card video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.media-preview-card--video {
    aspect-ratio: 16 / 9;
}

.media-remove {
    position: absolute;
    top: 8px;
    right: 8px;
    z-index: 2;
    width: 28px;
    height: 28px;
    border: 0;
    border-radius: 50%;
    background: rgba(var(--color-primary-rgb), 0.86);
    color: var(--color-surface);
    cursor: pointer;
    font-size: 18px;
    line-height: 1;
}

.mgmt-form__hint {
    display: block;
    margin-top: 8px;
    color: var(--color-muted);
    font-size: 13px;
}
</style>

<script>
function previewImage(event) {
    if (!event.target.files.length) return;
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

const submitButton = document.getElementById('submitButton');
const videoLoadingStatus = document.getElementById('videoLoadingStatus');
const videoLoadingUrls = new Set();

function setSubmitState() {
    const isLoading = videoLoadingUrls.size > 0;
    submitButton.disabled = isLoading;
    submitButton.style.opacity = isLoading ? '.65' : '1';
    submitButton.style.cursor = isLoading ? 'not-allowed' : 'pointer';
    videoLoadingStatus.style.display = isLoading ? 'block' : 'none';
}

function setupMediaInput(inputId, previewId, type) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const transfer = new DataTransfer();

    input.addEventListener('change', function () {
        Array.from(input.files).forEach(function (file) {
            transfer.items.add(file);
        });

        input.files = transfer.files;
        renderNewMedia();
    });

    preview.addEventListener('click', function (event) {
        const removeButton = event.target.closest('.media-remove');
        if (!removeButton) return;

        const card = removeButton.closest('.media-preview-card');

        if (card.dataset.existingMedia) {
            card.remove();
            return;
        }

        const index = Number(card.dataset.index);
        transfer.items.remove(index);
        input.files = transfer.files;
        renderNewMedia();
    });

    function renderNewMedia() {
        preview.querySelectorAll('[data-new-media="true"]').forEach(function (node) {
            if (node.dataset.objectUrl) {
                URL.revokeObjectURL(node.dataset.objectUrl);
                videoLoadingUrls.delete(node.dataset.objectUrl);
            }
            node.remove();
        });

        Array.from(transfer.files).forEach(function (file, index) {
            const objectUrl = URL.createObjectURL(file);
            const card = document.createElement('div');
            card.className = type === 'video'
                ? 'media-preview-card media-preview-card--video'
                : 'media-preview-card';
            card.dataset.newMedia = 'true';
            card.dataset.index = index;
            card.dataset.objectUrl = objectUrl;

            const remove = document.createElement('button');
            remove.type = 'button';
            remove.className = 'media-remove';
            remove.setAttribute('aria-label', 'Remove ' + type);
            remove.innerHTML = '&times;';
            card.appendChild(remove);

            if (type === 'video') {
                const media = document.createElement('video');
                media.controls = true;
                media.preload = 'metadata';
                media.playsInline = true;

                const source = document.createElement('source');
                source.src = objectUrl;
                source.type = file.type || 'video/mp4';
                media.appendChild(source);

                videoLoadingUrls.add(objectUrl);
                media.addEventListener('loadedmetadata', function () {
                    videoLoadingUrls.delete(objectUrl);
                    setSubmitState();
                }, { once: true });
                media.addEventListener('error', function () {
                    videoLoadingUrls.delete(objectUrl);
                    setSubmitState();
                }, { once: true });
                card.appendChild(media);
            } else {
                const media = document.createElement('img');
                media.src = objectUrl;
                media.alt = 'Selected photo';
                card.appendChild(media);
            }

            preview.appendChild(card);
        });

        setSubmitState();
    }
}

setupMediaInput('photosInput', 'photosPreview', 'photo');
setupMediaInput('videosInput', 'videosPreview', 'video');
setSubmitState();

document.querySelectorAll('.alert-toast').forEach(function(el) {
    setTimeout(function() {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 400);
    }, 4000);
});
</script>

@endsection
