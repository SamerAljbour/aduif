@extends('userLayouts.app')

@section('content')

@php
$locale = app()->getLocale();


$t = $post->translations->firstWhere('locale', $locale)
    ?? $post->translations->first(); // fallback

$photos = $post->photos ?? [];
$videos = $post->videos ?? [];

@endphp
<style>
[dir="rtl"] .drop-cap::first-letter {
    float: right;
    margin-right: 0;
    margin-left: 0.9rem;
}

.single-post-section {
    margin-bottom: 3.2rem;
}

.single-post-signature img {
    width: 100%;
    max-height: 560px;
    object-fit: cover;
    display: block;
    border-radius: 10px;
}

.single-post-media-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.4rem;
}

.single-post-media-card {
    overflow: hidden;
    border-radius: 10px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
}

.single-post-media-card:only-child {
    grid-column: 1 / -1;
}

.single-post-media-card img,
.single-post-media-card video {
    width: 100%;
    height: 100%;
    min-height: 320px;
    max-height: 620px;
    object-fit: cover;
    display: block;
}

.single-post-media-card video {
    aspect-ratio: 16 / 9;
    background: #020617;
}

.single-post-section-title {
    margin: 0 0 1.2rem;
    color: #0f172a;
    font-size: 2rem;
    line-height: 1.2;
}

@media screen and (max-width: 760px) {
    .single-post-media-grid {
        grid-template-columns: 1fr;
    }

    .single-post-media-card img,
    .single-post-media-card video {
        min-height: 220px;
    }
}
</style>
<!-- ================= ARTICLE ================= -->

<article class="blog-single">


<!-- ================= HEADER ================= -->
<div class="page-header page-header--single"
     style="background-image:url('{{ $post->image ? asset('storage/'.$post->image) : asset('images/blog/blog-bg-01.jpg') }}')">

    <div class="row page-header__content">
        <div class="col-full">

            <h1 class="display-1">
                {{ $t->title ?? __('posts.no_title') }}
            </h1>

            <ul class="page-header__meta">
                <li class="author">
                    {{ __('posts.type') }}: {{ __('posts.type_' . $post->type) }}
                </li>

                <li class="date">
                    {{ $post->event_date
                        ? \Carbon\Carbon::parse($post->event_date)->translatedFormat('d F Y')
                        : __('posts.no_date')
                    }}
                </li>
            </ul>

        </div>
    </div>
</div>


<!-- ================= CONTENT ================= -->
<div class="blog-content-wrap">

    <div class="row blog-content">
        <div class="col-full blog-content__main">

            {{-- SIGNATURE PHOTO --}}
            @if($post->image)
                <div class="single-post-section single-post-signature">
                    <img src="{{ asset('storage/'.$post->image) }}"
                         alt="{{ $t->title ?? __('posts.no_title') }}">
                </div>
            @endif

            {{-- DESCRIPTION --}}
            <div class="single-post-section">
                <p class="lead drop-cap">
                    {{ $t->description }}
                </p>
            </div>

            {{-- VIDEOS --}}
            @if(count($videos))
                <div class="single-post-section">
                    <div class="single-post-media-grid">
                        @foreach($videos as $video)
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
                            <div class="single-post-media-card">
                                <video controls preload="metadata" playsinline>
                                    <source src="{{ asset('storage/'.$video) }}" type="{{ $mimeType }}">
                                    {{ __('posts.video_unsupported') ?? 'Your browser does not support this video format.' }}
                                </video>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- PHOTOS --}}
            @if(count($photos))
                <div class="single-post-section">
                    <div class="single-post-media-grid">
                        @foreach($photos as $photo)
                            <div class="single-post-media-card">
                                <img src="{{ asset('storage/'.$photo) }}"
                                     alt="{{ $t->title ?? __('posts.no_title') }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>


</article>

<!-- ================= NAVIGATION ================= -->

<div class="blog-single-nav-wrap">
    <div class="row blog-single-nav">


    {{-- PREVIOUS --}}
    <div class="col-six blog-single-nav__prev">
        @if($prev)
            @php
                $prevT = $prev->translations->firstWhere('locale', app()->getLocale())
                    ?? $prev->translations->first();
            @endphp

            <a href="{{ route('post.singlePost', $prev->id) }}" rel="prev">
                <span>{{ __('posts.prev') }}</span>
                {{ $prevT?->title ?? __('posts.no_title') }}
            </a>
        @else
            <span style="color:#94a3b8; font-size:14px;">
                {{ __('posts.no_previous') }}
                {{-- {{ __('posts.type_' . $post->type) }} --}}
            </span>
        @endif
    </div>

    {{-- NEXT --}}
    <div class="col-six blog-single-nav__next">
        @if($next)
            @php
                $nextT = $next->translations->firstWhere('locale', app()->getLocale())
                    ?? $next->translations->first();
            @endphp

            <a href="{{ route('post.singlePost', $next->id) }}" rel="next">
                <span>{{ __('posts.next') }}</span>
                {{ $nextT?->title ?? __('posts.no_title') }}
            </a>
        @else
            <span style="color:#94a3b8; font-size:14px;">
                {{ __('posts.no_next') }}
                {{-- {{ __('posts.type_' . $post->type) }} --}}
            </span>
        @endif
    </div>

</div>


</div>

@endsection
