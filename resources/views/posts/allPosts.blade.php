@extends('userLayouts.app')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="page-header">
    <div class="row page-header__content narrower text-center">
        <div class="col-full">
            <h3 class="subhead">{{ __('posts.page_title') }}</h3>
            <h1 class="display-1">
                {{ __('posts.title') }}
            </h1>
        </div>
    </div>
</section>

{{-- ================= CONTENT ================= --}}
<section class="blog-content-wrap">

    {{-- TABS --}}
    <div class="row text-center" style="margin-bottom:40px;">
        <div class="col-full">
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('news')"> {{ __('posts.news') }} </button>
                <button class="tab-btn" onclick="switchTab('memories')"> {{ __('posts.memories') }} </button>
            </div>
        </div>
    </div>

    {{-- ================= NEWS ================= --}}
    <div id="newsTab" class="tab-content active">
        <div class="row entries-wrap add-top-padding">
            <div class="entries">

                @forelse($news as $post)
                    <article class="col-block">

                        <div class="item-entry" data-aos="fade-up">

                            {{-- IMAGE --}}
                            <div class="item-entry__thumb">
                                <a href="{{ route('post.singlePost', $post->id) }}" class="item-entry__thumb-link">
                                    <img
                                        src="{{ $post->image ?? asset('images/thumbs/post/default.jpg') }}"
                                        srcset="{{ $post->image ?? asset('images/thumbs/post/default.jpg') }} 1x"
                                        alt="{{ $post->translation?->title ?? 'post image' }}">
                                </a>
                            </div>

                            {{-- TEXT --}}
                            <div class="item-entry__text">

                                <div class="item-entry__cat">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->event_date?->format('M d, Y') ?? 'No date' }}
                                    </a>
                                </div>

                                <h1 class="item-entry__title">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->translation?->title ?? 'No title' }}
                                    </a>
                                </h1>

                                <div class="item-entry__content">
                                    <p>
                                        {{ Str::limit($post->translation?->description, 120) }}
                                    </p>

                                    <a class="more-link" href="{{ route('post.singlePost', $post->id) }}">
                                        Read More
                                    </a>
                                </div>

                            </div>
                        </div>

                    </article>
                @empty
                    <p style="text-align:center;">{{ __('posts.No_news_found') }}</p>
                @endforelse

            </div>
        </div>
    </div>

    {{-- ================= MEMORIES ================= --}}
    <div id="memoriesTab" class="tab-content">
        <div class="row entries-wrap add-top-padding">
            <div class="entries">

                @forelse($memories as $post)
                    <article class="col-block">

                        <div class="item-entry" data-aos="fade-up">

                            {{-- IMAGE --}}
                            <div class="item-entry__thumb">
                                <a href="{{ route('post.singlePost', $post->id) }}" class="item-entry__thumb-link">
                                    <img
                                        src="{{ $post->image ?? asset('images/thumbs/post/default.jpg') }}"
                                        srcset="{{ $post->image ?? asset('images/thumbs/post/default.jpg') }} 1x"
                                        alt="{{ $post->translation?->title ?? 'post image' }}">
                                </a>
                            </div>

                            {{-- TEXT --}}
                            <div class="item-entry__text">

                                <div class="item-entry__cat">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->event_date?->format('M d, Y') ?? 'No date' }}
                                    </a>
                                </div>

                                <h1 class="item-entry__title">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->translation?->title ?? 'No title' }}
                                    </a>
                                </h1>

                                <div class="item-entry__content">
                                    <p>
                                        {{ Str::limit($post->translation?->description, 120) }}
                                    </p>

                                    <a class="more-link" href="{{ route('post.singlePost', $post->id) }}">
                                        Read More
                                    </a>
                                </div>

                            </div>
                        </div>

                    </article>
                @empty
                    <p style="text-align:center;">{{ __('posts.No_memories_found') }}</p>
                @endforelse

            </div>
        </div>
    </div>

</section>

{{-- ================= STYLES ================= --}}
<style>
.tabs {
    display: inline-flex;
    gap: 10px;
    background: #f1f5f9;
    padding: 6px;
    border-radius: 999px;
    line-height: 1;
}

.tab-btn {
    border: none;
    padding: 10px 20px;
    border-radius: 999px;
    background: transparent;
    cursor: pointer;
    font-weight: 600;
    line-height: 0;
    padding: 0 3.2rem;
    margin: 0.5rem 0.6rem 0.2rem 0.5rem;
}

.tab-btn.active {
    background: #0f172a;
    color: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}
/* FORCE SAME IMAGE HEIGHT */
.item-entry__thumb {
    width: 100%;
    height: 220px; /* you control this */
    overflow: hidden;
    border-radius: 6px;
}

/* IMAGE COVER */
.item-entry__thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* 🔥 key line */
    display: block;
}

/* MAKE CARDS SAME HEIGHT */
.col-block {
    display: flex;
}

.item-entry {
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* PUSH CONTENT TO FILL */
.item-entry__text {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* KEEP "READ MORE" AT BOTTOM */
.item-entry__content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.item-entry__content p {
    flex: 1;
}
</style>

{{-- ================= SCRIPT ================= --}}
<script>
function switchTab(tab) {

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

    if (tab === 'news') {
        document.querySelectorAll('.tab-btn')[0].classList.add('active');
        document.getElementById('newsTab').classList.add('active');
    } else {
        document.querySelectorAll('.tab-btn')[1].classList.add('active');
        document.getElementById('memoriesTab').classList.add('active');
    }
}
</script>

@endsection
