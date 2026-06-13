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
                <button class="tab-btn active" onclick="switchTab('events')"> {{ __('posts.events') }} </button>
                <button class="tab-btn" onclick="switchTab('news')"> {{ __('posts.news') }} </button>
                <button class="tab-btn" onclick="switchTab('memories')"> {{ __('posts.memories') }} </button>
            </div>
        </div>
    </div>

    {{-- ================= EVENTS ================= --}}
    <div id="eventsTab" class="tab-content active">
        <div class="row entries-wrap add-top-padding">
            <div class="entries">

                @forelse($events as $post)
                    @php
                        $image = $post->image
                            ? (Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/'.$post->image))
                            : asset('images/thumbs/post/default.jpg');
                    @endphp
                    <article class="col-block">

                        <div class="item-entry" data-aos="fade-up">

                            {{-- IMAGE --}}
                            <div class="item-entry__thumb">
                                <a href="{{ route('post.singlePost', $post->id) }}" class="item-entry__thumb-link">
                                    <img
                                        src="{{ $image }}"
                                        srcset="{{ $image }} 1x"
                                        alt="{{ $post->translation?->title ?? __('posts.post_image_alt') }}">
                                </a>
                            </div>

                            {{-- TEXT --}}
                            <div class="item-entry__text">

                                <div class="item-entry__cat">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->event_date?->translatedFormat('d F Y') ?? __('posts.no_date') }}
                                    </a>
                                </div>

                                <h1 class="item-entry__title">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->translation?->title ?? __('posts.no_title') }}
                                    </a>
                                </h1>

                                <div class="item-entry__content">
                                    <p>
                                        {{ Str::limit($post->translation?->description, 120) }}
                                    </p>

                                    <a class="more-link" href="{{ route('post.singlePost', $post->id) }}">
                                        {{ __('posts.read_more') }}
                                    </a>
                                </div>

                            </div>
                        </div>

                    </article>
                @empty
                    <p style="text-align:center;">{{ __('posts.no_events_found') }}</p>
                @endforelse

            </div>
        </div>
    </div>

    {{-- ================= NEWS ================= --}}
    <div id="newsTab" class="tab-content">
        <div class="row entries-wrap add-top-padding">
            <div class="entries">

                @forelse($news as $post)
                    @php
                        $image = $post->image
                            ? (Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/'.$post->image))
                            : asset('images/thumbs/post/default.jpg');
                    @endphp
                    <article class="col-block">

                        <div class="item-entry" data-aos="fade-up">

                            {{-- IMAGE --}}
                            <div class="item-entry__thumb">
                                <a href="{{ route('post.singlePost', $post->id) }}" class="item-entry__thumb-link">
                                    <img
                                        src="{{ $image }}"
                                        srcset="{{ $image }} 1x"
                                        alt="{{ $post->translation?->title ?? __('posts.post_image_alt') }}">
                                </a>
                            </div>

                            {{-- TEXT --}}
                            <div class="item-entry__text">

                                <div class="item-entry__cat">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->event_date?->translatedFormat('d F Y') ?? __('posts.no_date') }}
                                    </a>
                                </div>

                                <h1 class="item-entry__title">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->translation?->title ?? __('posts.no_title') }}
                                    </a>
                                </h1>

                                <div class="item-entry__content">
                                    <p>
                                        {{ Str::limit($post->translation?->description, 120) }}
                                    </p>

                                    <a class="more-link" href="{{ route('post.singlePost', $post->id) }}">
                                        {{ __('posts.read_more') }}
                                    </a>
                                </div>

                            </div>
                        </div>

                    </article>
                @empty
                    <p style="text-align:center;">{{ __('posts.no_news_found') }}</p>
                @endforelse

            </div>
        </div>
    </div>

    {{-- ================= MEMORIES ================= --}}
    <div id="memoriesTab" class="tab-content">
        <div class="row entries-wrap add-top-padding">
            <div class="entries">

                @forelse($memories as $post)
                    @php
                        $image = $post->image
                            ? (Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/'.$post->image))
                            : asset('images/thumbs/post/default.jpg');
                    @endphp
                    <article class="col-block">

                        <div class="item-entry" data-aos="fade-up">

                            {{-- IMAGE --}}
                            <div class="item-entry__thumb">
                                <a href="{{ route('post.singlePost', $post->id) }}" class="item-entry__thumb-link">
                                    <img
                                        src="{{ $image }}"
                                        srcset="{{ $image }} 1x"
                                        alt="{{ $post->translation?->title ?? __('posts.post_image_alt') }}">
                                </a>
                            </div>

                            {{-- TEXT --}}
                            <div class="item-entry__text">

                                <div class="item-entry__cat">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->event_date?->translatedFormat('d F Y') ?? __('posts.no_date') }}
                                    </a>
                                </div>

                                <h1 class="item-entry__title">
                                    <a href="{{ route('post.singlePost', $post->id) }}">
                                        {{ $post->translation?->title ?? __('posts.no_title') }}
                                    </a>
                                </h1>

                                <div class="item-entry__content">
                                    <p>
                                        {{ Str::limit($post->translation?->description, 120) }}
                                    </p>

                                    <a class="more-link" href="{{ route('post.singlePost', $post->id) }}">
                                        {{ __('posts.read_more') }}
                                    </a>
                                </div>

                            </div>
                        </div>

                    </article>
                @empty
                    <p style="text-align:center;">{{ __('posts.no_memories_found') }}</p>
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
    background: var(--color-bg);
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
    background: var(--color-primary);
    color: var(--color-surface);
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

/* Blog.html card treatment, scoped to this page and recolored with site variables. */
.blog-content-wrap .entries {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 4.8rem 3.2rem;
}

.blog-content-wrap .col-block {
    float: none;
    width: auto;
    padding: 0;
}

.blog-content-wrap .item-entry {
    height: 100%;
    display: flex;
    flex-direction: column;
    background: var(--color-surface);
    border: 1px solid rgba(var(--color-primary-rgb), 0.16);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 24px rgba(var(--color-primary-rgb), 0.08);
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}

.blog-content-wrap .item-entry:hover {
    border-color: rgba(var(--color-accent-rgb), 0.45);
    box-shadow: 0 18px 38px rgba(var(--color-primary-rgb), 0.14);
    transform: translateY(-3px);
}

.blog-content-wrap .item-entry__thumb {
    height: auto;
    aspect-ratio: 4 / 3;
    border-radius: 0;
    background: var(--color-bg);
    border-bottom: 1px solid rgba(var(--color-primary-rgb), 0.12);
    box-shadow: none;
}

.blog-content-wrap .item-entry__thumb-link {
    display: block;
    width: 100%;
    height: 100%;
}

.blog-content-wrap .item-entry__thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.blog-content-wrap .item-entry__text {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 2.4rem;
    position: relative;
}

.blog-content-wrap .item-entry__text::before {
    content: "";
    width: 44px;
    height: 3px;
    border-radius: 999px;
    background: var(--color-accent);
    margin-bottom: 1.6rem;
}

.blog-content-wrap .item-entry__cat {
    margin-bottom: 0.6rem;
}

.blog-content-wrap .item-entry__cat a {
    color: var(--color-accent);
    font-weight: 700;
}

.blog-content-wrap .item-entry__title {
    font-size: 2.8rem;
    line-height: 1.2;
    margin: 0 0 1.8rem;
}

.blog-content-wrap .item-entry__title a {
    color: var(--color-primary);
}

.blog-content-wrap .item-entry__title a:hover,
.blog-content-wrap .item-entry__title a:focus {
    color: var(--color-accent);
    border-bottom-color: rgba(var(--color-accent-rgb), 0.45);
}

.blog-content-wrap .item-entry__content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.blog-content-wrap .item-entry__content p {
    flex: 1;
    color: var(--color-muted);
}

.blog-content-wrap .more-link {
    align-self: flex-start;
    color: var(--color-primary);
    margin-top: auto;
    border: 1px solid rgba(var(--color-primary-rgb), 0.20);
    border-radius: 999px;
    padding: 0.7rem 1.4rem;
    background: rgba(var(--color-primary-rgb), 0.04);
    line-height: 1;
    transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

.blog-content-wrap .more-link:hover,
.blog-content-wrap .more-link:focus {
    color: var(--color-accent);
    border-color: rgba(var(--color-accent-rgb), 0.45);
    background: rgba(var(--color-accent-rgb), 0.08);
}

@media only screen and (max-width: 1000px) {
    .blog-content-wrap .entries {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media only screen and (max-width: 640px) {
    .blog-content-wrap .entries {
        grid-template-columns: 1fr;
        gap: 4rem;
    }
}
</style>

{{-- ================= SCRIPT ================= --}}
<script>
function switchTab(tab) {

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

    const tabs = ['events', 'news', 'memories'];
    const index = tabs.indexOf(tab);
    const activeIndex = index === -1 ? 0 : index;
    const activeTab = tabs[activeIndex];

    document.querySelectorAll('.tab-btn')[activeIndex].classList.add('active');
    document.getElementById(activeTab + 'Tab').classList.add('active');
}
</script>

@endsection
