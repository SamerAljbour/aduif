@extends('userLayouts.app')

@section('content')
    @php
        $locale = app()->getLocale() === 'ar' ? 'ar' : 'fr';
        $dir = $locale === 'ar' ? 'rtl' : 'ltr';
    @endphp
    <div class="members-page" dir="{{ $dir }}" lang="{{ $locale }}">
        <section class="page-header">
        <div class="row page-header__content narrower text-center">
            <div class="col-full">
                <h1 class="display-1">
                    {{ __('members.title') }}
                </h1>
            </div>
        </div>
    </section>

    <section class="blog-content-wrap">
        <div class="row entries-wrap add-top-padding">
            <div class="entries members-grid">
                @forelse($members as $member)
                    @php
                        $translation = $member['translation'] ?? [];
                        $name = $translation['name'] ?? __('members.default_member');
                    @endphp

                    <article class="member-card" role="button" tabindex="0" onclick="openMemberModal(this)" onkeydown="if(event.key === 'Enter' || event.key === ' ') openMemberModal(this)" data-aos="fade-up" data-member='{!! json_encode($member, JSON_HEX_APOS | JSON_HEX_QUOT) !!}'>
                        <div class="member-card__media">
                            @if(!empty($member['photo']))
                                <img src="{{ asset('storage/'.$member['photo']) }}" alt="{{ $name }}">
                            @else
                                <div class="member-card__avatar-placeholder" aria-label="{{ $name }}">
                                    {{ mb_strtoupper(mb_substr($name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="member-card__media-overlay"></div>
                            <div class="member-card__meta">
                                <span class="member-card__status">{{ __('members.status') }}</span>
                                @if(!empty($translation['degree']))
                                    <span class="member-card__degree">
                                        {{ __('members.degrees.' . $translation['degree']) }}
                                    </span>
                                        @endif
                            </div>
                        </div>

                        <div class="member-card__content">
                            <h2 class="member-card__title">{{ $name }}</h2>
                            @if(!empty($translation['specialization']))
                                <p class="member-card__subtitle">{{ $translation['specialization'] }}</p>
                            @endif

                            <div class="member-card__quick-info">
                                @if(!empty($member['email']))
                                    <span>{{ __('members.email') }}: {{ $member['email'] }}</span>
                                @endif
                                @if(!empty($member['phone']))
                                    <span>{{ __('members.phone') }}: {{ $member['phone'] }}</span>
                                @endif
                            </div>

                            <div class="member-card__footer">
                                <span class="member-card__cv-indicator">{{ __('members.cv_available') }}</span>
                                <button type="button" class="member-card__button" onclick="event.stopPropagation(); openMemberModal(this.closest('.member-card'))" data-member='{!! json_encode($member, JSON_HEX_APOS | JSON_HEX_QUOT) !!}'>
                                    {{ __('members.show_details') }}
                                </button>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-full">
                        <p class="members-empty">
                            {{ __('members.no_members') }}
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        @if($members->hasPages())
            <div class="row pagination-wrap members-pagination">
                <div class="col-full">
                    <div>
                        {{ $members->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        @endif
    </section>

    <div id="memberModal" class="member-modal hidden" aria-hidden="true">
        <div class="member-modal__overlay" onclick="closeMemberModal()"></div>
        <div class="member-modal__dialog">
            <button type="button" class="member-modal__close" onclick="closeMemberModal()">×</button>
            <div class="member-modal__header">
                <div id="memberModalPhoto" class="member-modal__photo"></div>
                <div class="member-modal__header-text">
                    <span class="member-modal__label">{{ __('members.modal.title') }}</span>
                    <h2 id="memberModalName"></h2>
                    <p id="memberModalSpecialization" class="member-modal__subtitle"></p>
                </div>
            </div>

            <div class="member-modal__body">
                <div class="member-modal__section">
                    <h3>{{ __('members.modal.bio') }}</h3>
                    <p id="memberModalBio"></p>
                </div>

                <div class="member-modal__grid">
                    <div class="member-modal__field">
                        <span>{{ __('members.modal.email') }}</span>
                        <strong id="memberModalEmail"></strong>
                    </div>
                    <div class="member-modal__field">
                        <span>{{ __('members.modal.degree') }}</span>
                        <strong id="memberModalDegree"></strong>
                    </div>
                    //REMOVE IT
                    <div class="member-modal__field">
                        <span>{{ __('members.modal.phone') }}</span>
                        <strong id="memberModalPhone"></strong>
                    </div>
                    <div class="member-modal__field member-modal__field--full">
                        <span>{{ __('members.modal.university') }}</span>
                        <strong id="memberModalUniversity"></strong>
                    </div>
                    <div class="member-modal__field">
                        <span>{{ __('members.modal.job') }}</span>
                        <strong id="memberModalJob"></strong>
                    </div>
                    <div class="member-modal__field">
                        <span>{{ __('members.modal.workplace') }}</span>
                        <strong id="memberModalWorkplace"></strong>
                    </div>
                    <div class="member-modal__field">
                        <span>{{ __('members.modal.interests') }}</span>
                        <strong id="memberModalInterests"></strong>
                    </div>
                </div>

                <a id="memberModalCv" class="member-modal__cv-link hidden" target="_blank" rel="noopener noreferrer">
                    {{ __('members.modal.download_cv') }}
                </a>
            </div>
        </div>
    </div>
    </div>

    <style>
        .members-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(260px, 1fr));
            gap: 2rem;
        }

        .member-card {
            background: #fff;
            border: 1px solid rgba(17, 17, 17, .08);
            border-radius: 1.4rem;
            overflow: hidden;
            box-shadow: 0 16px 45px rgba(0, 0, 0, .08);
            display: flex;
            flex-direction: column;
            min-height: 100%;
            cursor: pointer;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .member-card:hover,
        .member-card:focus-visible {
            transform: translateY(-6px);
            box-shadow: 0 26px 55px rgba(0, 0, 0, .12);
            outline: none;
        }

        .member-card__media {
            position: relative;
            min-height: 260px;
            overflow: hidden;
            background: #f8f8f8;
        }

        .member-card__media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .35s ease;
        }

        .member-card:hover .member-card__media img,
        .member-card:focus-visible .member-card__media img {
            transform: scale(1.03);
        }

        .member-card__avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #111;
            color: #fff;
            font-size: 5rem;
            letter-spacing: .06em;
            font-weight: 700;
        }

        .member-card__media-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,.03) 0%, rgba(0,0,0,.2) 100%);
            pointer-events: none;
        }

        .member-card__meta {
            position: absolute;
            inset-inline-start: 1.5rem;
            inset-inline-end: 1.5rem;
            bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: center;
            color: #fff;
            font-size: 1.1rem;
            z-index: 1;
        }

        .member-card__status,
        .member-card__degree {
            background: rgba(0,0,0,.55);
            padding: .55rem .9rem;
            border-radius: .8rem;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            font-weight: 600;
        }

        .member-card__content {
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            text-align: start;
        }

        [dir="rtl"] .member-card__content {
            text-align: right;
        }

        [dir="rtl"] .member-modal__header-text,
        [dir="rtl"] .member-modal__field,
        [dir="rtl"] .member-modal__body {
            text-align: right;
        }

        [dir="rtl"] .member-card__quick-info span,
        [dir="rtl"] .member-card__status,
        [dir="rtl"] .member-card__degree {
            text-align: right;
        }

        .member-card__title {
            margin: 0;
            font-size: clamp(1.9rem, 2.3vw, 2.4rem);
            line-height: 1.1;
        }

        .member-card__subtitle {
            margin: 0;
            color: #555;
            font-size: 1.4rem;
            line-height: 1.5;
        }

        .member-card__quick-info {
            display: grid;
            gap: .55rem;
            font-size: 1.25rem;
            color: #555;
            padding-top: .4rem;
            border-top: 1px solid #f0f0f0;
        }

        .member-card__quick-info span {
            display: block;
            overflow-wrap: anywhere;
        }

        .member-card__footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f0f0f0;
        }

        .member-card__cv-indicator {
            color: #111;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .member-card__button {
    margin-inline-start: auto;
    border: none;
    background: #111;
    color: #fff;
    padding: 1rem 1.4rem;
    border-radius: .8rem;
    cursor: pointer;
    font-size: 1.3rem;

    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

        .member-card__button:hover {
            background: #00a650;
        }

        .member-modal.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .member-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: grid;
            place-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .member-modal:not(.hidden) {
            opacity: 1;
            visibility: visible;
        }

        .member-modal__overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,.55);
            transition: opacity 0.3s ease;
        }

        .member-modal__dialog {
            position: relative;
            width: min(100%, 980px);
            max-height: 90vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 1.4rem;
            box-shadow: 0 30px 80px rgba(0,0,0,.18);
            padding: 2rem;
            z-index: 1;
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .member-modal:not(.hidden) .member-modal__dialog {
            transform: scale(1);
        }

        .member-modal__close {
            position: absolute;
            top: 1.4rem;
            inset-inline-end: 1.4rem;
            border: none;
            background: transparent;
            color: #111;
            font-size: 3rem;
            line-height: 1;
            cursor: pointer;
        }

        .member-modal__header {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 2rem;
            align-items: start;
            margin-bottom: 2rem;
        }

        .member-modal__photo {
            width: 150px;
            height: 150px;
            border-radius: 1.2rem;
            overflow: hidden;
            background: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #111;
        }

        .member-modal__photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .member-modal__label {
            display: inline-block;
            color: #666;
            font-size: 1.2rem;
            margin-bottom: .5rem;
        }

        .member-modal__header-text h2 {
            margin: .2rem 0 1rem;
            font-size: 2.8rem;
        }

        .member-modal__subtitle {
            margin: 0;
            color: #555;
            font-size: 1.5rem;
        }

        .member-modal__body {
            display: grid;
            gap: 1.6rem;
        }

        .member-modal__section h3 {
            margin: 0 0 .8rem;
            font-size: 1.6rem;
        }

        .member-modal__section p {
            margin: 0;
            color: #444;
            line-height: 1.8;
            white-space: pre-line;
        }

        .member-modal__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.2rem;
        }

        .member-modal__field {
            background: #f9f9f9;
            padding: 1rem 1.2rem;
            border-radius: 1rem;
        }

        .member-modal__field span {
            display: block;
            color: #777;
            margin-bottom: .45rem;
            font-size: 1.2rem;
        }

        .member-modal__field strong {
            display: block;
            color: #111;
            font-size: 1.25rem;
        }

        .member-modal__field--full {
            grid-column: 1 / -1;
        }

        .member-modal__cv-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #111;
            color: #fff;
            text-decoration: none;
            padding: 1rem 1.2rem;
            border-radius: .85rem;
            font-size: 1.3rem;
            width: fit-content;
        }

        .member-modal__cv-link.hidden {
            display: none;
        }
        .member-modal__cv-link:hover {
            background: #00a650;
        }
        .member-card,
        .member-modal__dialog,
        .member-modal__field {
            transition: all .2s ease;
        }

        @media screen and (max-width: 1024px) {
            .members-grid {
                grid-template-columns: repeat(2, minmax(220px, 1fr));
            }

            .member-modal__header {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 720px) {
            .members-grid {
                grid-template-columns: 1fr;
            }

            .member-card__content {
                padding: 1.5rem;
            }
        }
    </style>

    <script>
        const memberModal = document.getElementById('memberModal');
        const storageBase = "{{ asset('storage') }}";
        const degreesTranslations = @json(__('members.degrees'));
        function openMemberModal(button) {
            const member = button.dataset.member ? JSON.parse(button.dataset.member) : null;
            if (!member) {
                return;
            }

            const translation = member.translation || {};
            document.getElementById('memberModalName').textContent = translation.name || '{{ $locale === 'ar' ? 'عضو' : 'Membre' }}';
            document.getElementById('memberModalSpecialization').textContent = translation.specialization || '';
            document.getElementById('memberModalBio').textContent = translation.bio || '';
            document.getElementById('memberModalEmail').textContent = member.email || '';
            document.getElementById('memberModalPhone').textContent = member.phone || '';
            document.getElementById('memberModalDegree').textContent = degreesTranslations[translation.degree] || '';
            document.getElementById('memberModalJob').textContent = translation.current_job || '';
            document.getElementById('memberModalWorkplace').textContent = translation.workplace || '';
            document.getElementById('memberModalInterests').textContent = translation.interests || '';
            document.getElementById('memberModalUniversity').textContent = translation.graduation_university || '';

            const photoWrapper = document.getElementById('memberModalPhoto');
            photoWrapper.innerHTML = '';
            if (member.photo) {
                const image = document.createElement('img');
                image.src = `${storageBase}/${member.photo}`;
                image.alt = translation.name || '';
                photoWrapper.appendChild(image);
            } else {
                photoWrapper.textContent = (translation.name || '{{ $locale === 'ar' ? 'عضو' : 'Membre' }}').slice(0, 1).toUpperCase();
            }

            const cvLink = document.getElementById('memberModalCv');
            if (member.cv) {
                cvLink.classList.remove('hidden');
                cvLink.href = `${storageBase}/${member.cv}`;
            } else {
                cvLink.classList.add('hidden');
            }

            memberModal.classList.remove('hidden');
            memberModal.setAttribute('aria-hidden', 'false');
        }

        function closeMemberModal() {
            memberModal.classList.add('hidden');
            memberModal.setAttribute('aria-hidden', 'true');
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !memberModal.classList.contains('hidden')) {
                closeMemberModal();
            }
        });
    </script>
@endsection
