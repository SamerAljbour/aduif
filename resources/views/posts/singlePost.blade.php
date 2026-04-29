@extends('userLayouts.app')

@section('content')
{{-- {{ dd( $post) }} --}}
@php
    $locale = app()->getLocale();

    $t = $post->translations->firstWhere('locale', $locale)
        ?? $post->translations->first(); // fallback
@endphp

<!-- ================= ARTICLE ================= -->
<article class="blog-single">

    <!-- ================= HEADER ================= -->
    <div class="page-header page-header--single"
         style="background-image:url('{{ $post->image ? asset($post->image) : asset('images/blog/blog-bg-01.jpg') }}')">

        <div class="row page-header__content">
            <div class="col-full">

                <h1 class="display-1">
                    {{ $t->title ?? 'No title' }}
                </h1>

                <ul class="page-header__meta">
                    <li class="author">Type: {{ ucfirst($post->type) }}</li>

                    <li class="date">
                        {{ $post->event_date ? \Carbon\Carbon::parse($post->event_date)->format('F d, Y') : 'No date' }}
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
                    $prevT = $prev->translation(app()->getLocale())->first()
                        ?? $prev->translations->first();
                @endphp

                <a href="{{ route('post.singlePost', $prev->id) }}" rel="prev">
                    <span>Prev</span>
                    {{ $prevT?->title ?? 'No title' }}
                </a>
            @else
                <span style="color:#94a3b8; font-size:14px;">
                    No previous {{ $post->type }}
                </span>
            @endif
        </div>

        {{-- NEXT --}}
        <div class="col-six blog-single-nav__next">
            @if($next)
                @php
                    $nextT = $next->translation(app()->getLocale())->first()
                        ?? $next->translations->first();
                @endphp

                <a href="{{ route('post.singlePost', $next->id) }}" rel="next">
                    <span>Next</span>
                    {{ $nextT?->title ?? 'No title' }}
                </a>
            @else
                <span style="color:#94a3b8; font-size:14px;">
                    No next {{ $post->type }}
                </span>
            @endif
        </div>

    </div>
</div>
@endsection
