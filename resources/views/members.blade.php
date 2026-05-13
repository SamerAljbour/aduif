@extends('userLayouts.app')

@section('content')
    @php
        $locale = app()->getLocale() === 'ar' ? 'ar' : 'fr';
        $dir    = $locale === 'ar' ? 'rtl' : 'ltr';
    @endphp

    <style>
        /* ─────────────────────────────────────────
           Design tokens  (mirrors management page)
        ───────────────────────────────────────── */
        :root {
            --mem-ink:    #111827;
            --mem-muted:  #667085;
            --mem-line:   #d8dee8;
            --mem-soft:   #f6f7f9;
            --mem-gold:   #b9933f;
            --mem-green:  #191231;
            --mem-blue:   #234d73;
        }

        .members-page { background: #fff; color: var(--mem-ink); }

        /* ── List ── */
        .members-list { display: flex; flex-direction: column; gap: 34px; }

        /* ── Card ── */
        .mem-card {
            border-top: 1px solid var(--mem-ink);
            padding-top: 14px;
        }

        /* ── Main row  (same structure as .mgmt-row-card) ── */
        .mem-card__row {
            display: flex;
            flex-direction: row;
            gap: 28px;
            align-items: stretch;
            cursor: pointer;
        }

        /* ── Photo side ── */
        .mem-card__media {
            flex: 0 0 48%;
            min-width: 280px;
            position: relative;
            overflow: hidden;
            background: #6d6f73;
            min-height: 330px;
            max-height: 430px;
        }
        .mem-card__media img {
            width: 100%; height: 100%;
            object-fit: cover; object-position: center top;
            display: block;
            transition: transform .4s ease;
        }
        .mem-card__row:hover .mem-card__media img { transform: scale(1.03); }
        .mem-card__avatar {
            width: 100%; height: 100%; min-height: 330px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 6rem; font-weight: 800;
        }
        .mem-card__badges {
            position: absolute; bottom: 1rem;
            inset-inline-start: 1rem; inset-inline-end: 1rem;
            display: flex; gap: .5rem; flex-wrap: wrap;
        }
        .mem-badge {
            background: rgba(0,0,0,.6); color: #fff;
            font-size: 1rem; font-weight: 700;
            padding: .3rem .75rem; border-radius: .45rem;
            backdrop-filter: blur(4px);
        }
        .mem-badge--green { background: rgba(25,18,49,.82); }

        /* ── Content side ── */
        .mem-card__content {
            flex: 1 1 0; min-width: 0;
            display: flex; flex-direction: column;
            justify-content: flex-start;
            padding: 2px 0 0;
        }

        /* Head — badge + name / specialization */
        .mem-card__head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            border-bottom: 1px solid var(--mem-line);
            padding-bottom: 10px;
            margin-bottom: 13px;
        }
        .mem-card__badge    { color: var(--mem-gold); font-size: 1.05rem; font-weight: 800; }
        .mem-card__position { color: var(--mem-blue); font-size: 1.05rem; font-weight: 800; white-space: nowrap; }
        .mem-card__name {
            font-size: clamp(1.8rem, 2.4vw, 2.5rem);
            line-height: 1.25; margin: 5px 0 0; font-weight: 800;
        }

        /* Bio — always visible, fills available space */
        .mem-card__bio {
            color: var(--mem-ink); font-size: 1.35rem;
            line-height: 1.9; margin: 0 0 18px;
            flex: 1;
        }

        /* Quick contacts */
        .mem-card__quick {
            display: flex; flex-wrap: wrap;
            gap: .4rem 1.6rem;
            font-size: 1.2rem; color: var(--mem-muted);
            padding-top: .8rem;
            border-top: 1px solid var(--mem-line);
            margin-top: auto;
        }
        .mem-card__quick span { display: inline-flex; align-items: center; gap: .4rem; }

        /* ── Arrow button — top-end corner of content side ── */
        .mem-card__content { position: relative; }

        .mem-card__arrow {
            position: absolute;
            top: 19px;
            inset-inline-end: 0;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: .3rem;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: .2rem .4rem .4rem;
            color: var(--mem-muted);
            user-select: none;
            transition: color .2s;
        }
        .mem-card__arrow-lbl {
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: .02em;
            white-space: nowrap;
        }
        .mem-card__arrow svg {
            display: block;
            transition: transform .35s cubic-bezier(.4,0,.2,1);
        }
        .mem-card__arrow:hover { color: var(--mem-ink); }

        /* Flip arrow up when open */
        .mem-card.is-open .mem-card__arrow svg { transform: rotate(180deg); }
        .mem-card.is-open .mem-card__arrow { color: var(--mem-ink);  }

        /* ── Collapsible extra panel ── */
        .mem-card__extra {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows .35s ease;
        }
        .mem-card.is-open .mem-card__extra { grid-template-rows: 1fr; }
        .mem-card__extra-inner { overflow: hidden; }
        .mem-card__extra-body {
            background: var(--mem-soft);
            border-top: 1px solid var(--mem-line);
            padding: 2rem 0 .5rem;
            display: flex; flex-direction: column; gap: 1.2rem;
        }

        /* Fields grid (same as mgmt-row-card__details) */
        .mem-extra__fields {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
        }
        .mem-extra__field {
            background: #fff;
            border: 1px solid #ebedf1;
            border-radius: 6px;
            padding: 12px 14px;
        }
        .mem-extra__field dt {
            color: var(--mem-muted); font-size: 1rem;
            font-weight: 800; margin-bottom: 4px;
        }
        .mem-extra__field dd {
            margin: 0; color: var(--mem-ink);
            font-size: 1.12rem; font-weight: 700;
            overflow-wrap: anywhere;
        }
        .mem-extra__field--full { grid-column: 1 / -1; }

        .mem-extra__cv-link {
            display: inline-flex; align-items: center; gap: .6rem;
            background: var(--mem-ink); color: #fff;
            text-decoration: none;
            padding: .9rem 1.6rem; border-radius: .8rem;
            font-size: 1.25rem; font-weight: 700;
            width: fit-content;
            transition: background .2s;
        }
        .mem-extra__cv-link:hover { background: var(--mem-green); }

        /* Empty */
        .members-empty {
            color: var(--mem-muted); background: var(--mem-soft);
            border: 1px solid var(--mem-line); border-radius: 6px;
            padding: 2.8rem; text-align: center; font-size: 1.3rem;
        }

        /* ── Responsive ── */
        @media (max-width: 820px) {
            .mem-card__row { flex-direction: column; gap: 16px; }
            .mem-card__media { flex-basis: auto; min-width: 0; min-height: 260px; max-height: none; }
            .mem-card__head { flex-direction: column; gap: 6px; }
            .mem-card__position { white-space: normal; }
            .mem-extra__fields { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 480px) {
            .mem-extra__fields { grid-template-columns: 1fr; }
        }
    </style>

    <div class="members-page" dir="{{ $dir }}" lang="{{ $locale }}">
        <section class="page-header">
            <div class="row page-header__content narrower text-center">
                <div class="col-full">
                    <h1 class="display-1">{{ __('members.title') }}</h1>
                </div>
            </div>
        </section>

        <section class="blog-content-wrap">
            <div class="row entries-wrap add-top-padding">
                <div class="members-list">
                    @forelse($members as $member)
                        @php
                            $translation = $member['translation'] ?? [];
                            $name        = $translation['name'] ?? __('members.default_member');
                            $cardId      = 'mem-' . ($member['id'] ?? $loop->index);

                            $hasExtra = !empty($translation['degree'])
                                     || !empty($translation['current_job'])
                                     || !empty($translation['workplace'])
                                     || !empty($translation['interests'])
                                     || !empty($translation['graduation_university'])
                                     || !empty($member['cv']);
                        @endphp

                        <article class="mem-card" id="{{ $cardId }}" data-aos="fade-up">

                            {{-- ── Clickable row ── --}}
                            <div class="mem-card__row"
                                 role="button" tabindex="0"
                                 aria-expanded="false"
                                 onclick="toggleMem(this)"
                                 onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();toggleMem(this)}">

                                {{-- Photo --}}
                                <div class="mem-card__media">
                                    @if(!empty($member['photo']))
                                        <img src="{{ asset('storage/'.$member['photo']) }}" alt="{{ $name }}">
                                    @else
                                        <div class="mem-card__avatar" aria-hidden="true">
                                            {{ mb_strtoupper(mb_substr($name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="mem-card__badges">
                                        <span class="mem-badge">{{ __('members.status') }}</span>
                                        @if(!empty($translation['degree']))
                                            <span class="mem-badge mem-badge--green">
                                                {{ __('members.degrees.' . $translation['degree']) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="mem-card__content">

                                    {{-- Arrow button — top-end corner, only if extras exist --}}
                                    @if($hasExtra)
                                        <button type="button"
                                                class="mem-card__arrow"
                                                onclick="event.stopPropagation(); toggleMem(this.closest('.mem-card').querySelector('.mem-card__row'))"
                                                tabindex="0"
                                                aria-label="{{ __('members.show_details') }}">
                                            <span class="mem-card__arrow-lbl">{{ __('members.show_details') }}</span>
                                            <svg width="20" height="12" viewBox="0 0 22 13" fill="none"
                                                 stroke="currentColor" stroke-width="2.6"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="1,1 11,11 21,1"/>
                                            </svg>
                                        </button>
                                    @endif
                                    <div class="mem-card__head">
                                        <div>
                                            <span class="mem-card__badge">{{ __('members.status') }}</span>
                                            <h2 class="mem-card__name">{{ $name }}</h2>
                                        </div>
                                        @if(!empty($translation['specialization']))
                                            <span class="mem-card__position">{{ $translation['specialization'] }}</span>
                                        @endif
                                    </div>

                                    @if(!empty($translation['bio']))
                                        <p class="mem-card__bio">{{ $translation['bio'] }}</p>
                                    @endif

                                    @if(!empty($member['email']) || !empty($member['phone']))
                                        <div class="mem-card__quick">
                                            @if(!empty($member['email']))
                                                <span>
                                                    <svg width="13" height="11" viewBox="0 0 20 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="1" width="18" height="14" rx="2"/><polyline points="1,1 10,9 19,1"/></svg>
                                                    {{ $member['email'] }}
                                                </span>
                                            @endif
                                            @if(!empty($member['phone']))
                                                <span>
                                                    <svg width="12" height="12" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 1h3l1.5 4-2 1.2A11 11 0 0 0 13.8 12.5L15 10.5l4 1.5v3a2 2 0 0 1-2 2A17 17 0 0 1 3 3a2 2 0 0 1 2-2z"/></svg>
                                                    {{ $member['phone'] }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                </div>

                            </div>{{-- /.mem-card__row --}}

                            {{-- ── Collapsible extra details ── --}}
                            @if($hasExtra)
                                <div class="mem-card__extra" id="{{ $cardId }}-extra" aria-hidden="true">
                                    <div class="mem-card__extra-inner">
                                        <div class="mem-card__extra-body">

                                            <dl class="mem-extra__fields">
                                                @if(!empty($member['email']))
                                                    <div class="mem-extra__field">
                                                        <dt>{{ __('members.modal.email') }}</dt>
                                                        <dd>{{ $member['email'] }}</dd>
                                                    </div>
                                                @endif
                                                @if(!empty($member['phone']))
                                                    <div class="mem-extra__field">
                                                        <dt>{{ __('members.modal.phone') }}</dt>
                                                        <dd>{{ $member['phone'] }}</dd>
                                                    </div>
                                                @endif
                                                @if(!empty($translation['degree']))
                                                    <div class="mem-extra__field">
                                                        <dt>{{ __('members.modal.degree') }}</dt>
                                                        <dd>{{ __('members.degrees.' . $translation['degree']) }}</dd>
                                                    </div>
                                                @endif
                                                @if(!empty($translation['current_job']))
                                                    <div class="mem-extra__field">
                                                        <dt>{{ __('members.modal.job') }}</dt>
                                                        <dd>{{ $translation['current_job'] }}</dd>
                                                    </div>
                                                @endif
                                                @if(!empty($translation['workplace']))
                                                    <div class="mem-extra__field">
                                                        <dt>{{ __('members.modal.workplace') }}</dt>
                                                        <dd>{{ $translation['workplace'] }}</dd>
                                                    </div>
                                                @endif
                                                @if(!empty($translation['interests']))
                                                    <div class="mem-extra__field">
                                                        <dt>{{ __('members.modal.interests') }}</span>
                                                        <dd>{{ $translation['interests'] }}</dd>
                                                    </div>
                                                @endif
                                                @if(!empty($translation['graduation_university']))
                                                    <div class="mem-extra__field">
                                                        <dt>{{ __('members.modal.university') }}</dt>
                                                        <dd>{{ $translation['graduation_university'] }}</dd>
                                                    </div>
                                                @endif
                                            </dl>

                                            @if(!empty($member['cv']))
                                                <a href="{{ asset('storage/'.$member['cv']) }}"
                                                   class="mem-extra__cv-link"
                                                   target="_blank" rel="noopener noreferrer">
                                                    ↓ {{ __('members.modal.download_cv') }}
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </article>
                    @empty
                        <div class="col-full">
                            <p class="members-empty">{{ __('members.no_members') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($members->hasPages())
                <div class="row pagination-wrap members-pagination">
                    <div class="col-full">
                        {{ $members->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        </section>
    </div>

    <script>
        function toggleMem(rowEl) {
            const card   = rowEl.closest('.mem-card');
            const isOpen = card.classList.contains('is-open');

            document.querySelectorAll('.mem-card.is-open').forEach(c => {
                if (c === card) return;
                c.classList.remove('is-open');
                c.querySelector('.mem-card__row')?.setAttribute('aria-expanded', 'false');
                c.querySelector('.mem-card__extra')?.setAttribute('aria-hidden', 'true');
            });

            card.classList.toggle('is-open', !isOpen);
            rowEl.setAttribute('aria-expanded', String(!isOpen));
            card.querySelector('.mem-card__extra')?.setAttribute('aria-hidden', String(isOpen));
        }
    </script>
@endsection
