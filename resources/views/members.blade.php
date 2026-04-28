@extends('userLayouts.app')

@section('content')
    @php
        $locale = app()->getLocale() === 'ar' ? 'ar' : 'fr';
        $fallbackLocale = $locale === 'fr' ? 'ar' : 'fr';
    @endphp
    <section class="page-header">

        <div class="row page-header__content narrower text-center">
            <div class="col-full">

                {{-- <h3 class="subhead">{{ __('members.title') }}</h3> --}}
                <h1 class="display-1">
                    {{ __('members.title') }}
                </h1>

                {{-- <a href="#0" class="page-header__search-trigger">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span>Search the blog</span>
                </a>
                <div class="page-header__search">
                    <form role="search" method="get" class="page-header__search-form" action="#">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>

                    <a href="#0" title="Close Search" class="page-header__overlay-close">Close</a>
                </div>  <!-- end page-header__search --> --}}

            </div>
        </div>

    </section>
    <section class="blog-content-wrap">

        <div class="row entries-wrap add-top-padding">
            <div class="entries">

                @forelse($members as $member)
                    @php
                        $name = optional($member->translations->firstWhere('locale', $locale))->name
                            ?: optional($member->translations->firstWhere('locale', $fallbackLocale))->name;
                    @endphp

                    <article class="col-block">
                        <div class="item-entry" data-aos="fade-up">
                            <div class="item-entry__thumb">
                                @if($member->photo)
                                    <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $name }}">
                                @else
                                    <div class="member-photo-placeholder" aria-label="{{ $name }}">
                                        {{ mb_strtoupper(mb_substr($name ?? 'M', 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <div class="item-entry__text">
                                <h1 class="item-entry__title member-name">{{ $name }}</h1>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-full">
                        <p class="members-empty">
                            {{ $locale === 'ar' ? 'لا يوجد أعضاء حالياً.' : 'Aucun membre pour le moment.' }}
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

    <style>
        .member-name {
            margin-bottom: 0;
        }

        .member-photo-placeholder {
            width: 100%;
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f2f2;
            color: #111;
            font-size: 5.6rem;
            font-weight: 700;
            line-height: 1;
        }

        .members-empty {
            margin: 0;
            padding: 4rem 0;
            text-align: center;
            color: #777;
        }

        .members-pagination nav > div:first-child {
            display: none;
        }

        .members-pagination nav > div:last-child {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .members-pagination nav > div:last-child > div:first-child {
            display: none;
        }

        .members-pagination nav > div:last-child > div:last-child > span {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            box-shadow: none !important;
        }

        .members-pagination a,
        .members-pagination span[aria-current="page"] span,
        .members-pagination span[aria-disabled="true"] span {
            min-width: 4.2rem;
            height: 4.2rem;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0 1.2rem !important;
            border: 1px solid #d8d8d8 !important;
            border-radius: 0;
            background: #fff !important;
            color: #111 !important;
            font-size: 1.4rem;
            font-weight: 600;
            line-height: 1;
            text-decoration: none;
            transition: all .2s ease-in-out;
        }

        .members-pagination a:hover {
            border-color: #111 !important;
            background: #111 !important;
            color: #fff !important;
        }

        .members-pagination span[aria-current="page"] span {
            border-color: #111 !important;
            background: #111 !important;
            color: #fff !important;
        }

        .members-pagination span[aria-disabled="true"] span {
            cursor: not-allowed;
            opacity: .35;
        }

        .members-pagination svg {
            width: 1.6rem;
            height: 1.6rem;
        }

        @media screen and (max-width: 600px) {
            .members-pagination nav > div:first-child {
                display: flex;
                justify-content: space-between;
                gap: 1rem;
            }

            .members-pagination nav > div:last-child {
                display: none;
            }

            .members-pagination nav > div:first-child a,
            .members-pagination nav > div:first-child span {
                flex: 1;
                max-width: none;
            }
        }
    </style>
@endsection
