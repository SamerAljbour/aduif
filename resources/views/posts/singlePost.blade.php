@extends('userLayouts.app')

@section('content')

@php
$locale = app()->getLocale();


$t = $post->translations->firstWhere('locale', $locale)
    ?? $post->translations->first(); // fallback


@endphp
<style>
[dir="rtl"] .drop-cap::first-letter {
    float: right;
    margin-right: 0;
    margin-left: 0.9rem;
}
</style>
<!-- ================= ARTICLE ================= -->

<article class="blog-single">


<!-- ================= HEADER ================= -->
<div class="page-header page-header--single"
     style="background-image:url('{{ $post->image ? asset($post->image) : asset('images/blog/blog-bg-01.jpg') }}')">

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

            {{-- DESCRIPTION --}}
            <p class="lead drop-cap">
                {{ $t->description }}
            </p>

            {{-- MAIN IMAGE --}}
            @if($post->image)
            <p>
                <img src="{{ asset($post->image) }}"
                     style="width:100%; border-radius:10px; object-fit:cover; max-height:500px;">
            </p>
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
