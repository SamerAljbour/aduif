    @php
        $isHomePage = request()->is('/');
    @endphp

    <!-- header
        ================================================== -->
        <header class="s-header">

            <div class="header-logo">
                <a class="site-logo" href="{{ url('/') }}">
                    <img src="{{ asset('user/images/aduif-white.png') }}"
     alt="Homepage"
     style="width: auto; height: 64px; max-width: 160px; object-fit: contain; border-radius: 50%;">
                </a>
            </div>

            <nav class="row header-nav-wrap wide">
                <ul class="header-main-nav">
                    <li class="{{ request()->is('/') ? 'current' : '' }}">
                    <a class="smoothscroll" href="{{ url('/') }}#home" title="intro">
                        {{ __('header.home') }}
                    </a>
                </li>
                    <li class="{{ request()->routeIs('managements.showManagers') ? 'current' : '' }}">
                        <a href="{{ route('managements.showManagers') }}" title="managers"> {{ __('header.management') }} </a>
                    </li>
                    <li class="{{ request()->routeIs('members.showMembers') ? 'current' : '' }}">
                        <a href="{{ route('members.showMembers') }}" title="Members"> {{ __('header.members') }} </a>
                    </li>
                    <li class="{{ request()->routeIs('posts.allPosts') ? 'current' : '' }}">
                        <a href="{{ route('posts.allPosts') }}" title="Posts"> {{ __('header.posts') }} </a>
                    </li>
                    <li class="{{ request()->routeIs('join-us.index') ? 'current' : '' }}">
                        <a href="{{ route('join-us.index') }}" title="Join Us"> {{ __('home-page.join-us') }} </a>
                    </li>
                    <li>
                        <a class="smoothscroll" href="#site-footer" title="Contact Us"> {{ __('header.contact_us') }} </a>
                    </li>

                    @auth
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'current' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" title="dashboard"> {{ __('header.dashboard') }} </a>
                    </li>
                    @endauth
                    @guest
                    <li class="{{ request()->routeIs('register') ? 'current' : '' }}">
                        <a href="{{ route('register') }}" title="register"> {{ __('header.register') }} </a>
                    </li>
                    <li class="{{ request()->routeIs('login') ? 'current' : '' }}">
                        <a href="{{ route('login') }}" title="login"> {{ __('header.login') }} </a>
                    </li>
                    @endguest
        </ul>

                <ul class="header-social">

<li>
    <a href="https://www.facebook.com/people/ADUIF-Jordanie/100064318494988/" target="_blank" aria-label="Facebook">
        <i class="fab fa-facebook"></i>
    </a>
</li>        {{-- <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#0"><i class="fab fa-instagram"></i></a></li> --}}

        @foreach(['en' => 'EN', 'fr' => 'FR', 'ar' => 'AR'] as $locale => $label)
            @if(app()->getLocale() !== $locale)
                <li>
                    <a href="{{ route('set.locale', $locale) }}">{{ $label }}</a>
                </li>
            @endif
        @endforeach

    </ul>
            </nav>

            <a class="header-menu-toggle" href="#"><span>Menu</span></a>

        </header> <!-- end header -->

        @if($isHomePage)
            <nav class="home-section-tabs" aria-label="{{ __('header.home') }}">
                <div class="home-section-tabs__inner">
                    <a class="home-section-tab smoothscroll is-active" href="{{ url('/') }}#about-us" title="about">
                        {{ __('header.about_us') }}
                    </a>
                    <a class="home-section-tab smoothscroll" href="{{ url('/') }}#mission" title="mission">
                        {{ __('header.mission') }}
                    </a>
                    <a class="home-section-tab smoothscroll" href="{{ url('/') }}#vision" title="vision">
                        {{ __('header.vision') }}
                    </a>
                    <a class="home-section-tab smoothscroll" href="{{ url('/') }}#goals" title="goals">
                        {{ __('header.goals') }}
                    </a>
                </div>
            </nav>
        @endif

    <style>
        .home-section-tabs {
            position: fixed;
            top: 78px;
            right: 0;
            left: 0;
            z-index: 110;
            background: var(--color-surface);
            border-block: 1px solid var(--color-accent-light);
            box-shadow: 0 12px 28px rgba(17,24,39,.1);
            padding: 14px 22px;
            opacity: 0;
            pointer-events: none;
            transform: translateY(-100%);
            transition: opacity .22s ease, transform .22s ease;
        }

        .home-section-tabs.is-visible {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .home-section-tabs__inner {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            max-width: 1160px;
            margin: 0 auto;
        }

        .home-section-tab {
            border: 1px solid var(--color-accent-light);
            border-radius: 6px;
            color: var(--color-primary);
            background: var(--color-surface);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 9px 18px;
            font-size: 1.25rem;
            font-weight: 800;
            white-space: nowrap;
            text-decoration: none;
            transition: background .2s ease, color .2s ease, border-color .2s ease, transform .2s ease;
        }

        .home-section-tab:hover,
        .home-section-tab.is-active {
            background: var(--color-primary);
            border-color: var(--color-primary);
            color: var(--color-surface);
            transform: translateY(-1px);
        }

        @media (max-width: 820px) {
            .home-section-tabs {
                padding-inline: 16px;
            }

            .home-section-tabs__inner {
                justify-content: stretch;
            }

            .home-section-tab {
                flex: 1 1 210px;
                font-size: 1.1rem;
                padding-inline: 12px;
            }
        }
    </style>

@if($isHomePage)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const homeTabsBar   = document.querySelector('.home-section-tabs');
            const aboutSection  = document.querySelector('#about-us');
            const homeSectionTabs   = Array.from(document.querySelectorAll('.home-section-tab'));
            const homeTabTargets    = homeSectionTabs
                .map(tab => document.querySelector(new URL(tab.href).hash))
                .filter(Boolean);

            const headerOffset = () => document.querySelector('.s-header')?.offsetHeight || 78;

            const updateHomeTabs = () => {
                if (!homeTabsBar || !aboutSection) return;

                // Show when the top of #about-us scrolls into view (hits the header bottom)
                const showAt = aboutSection.getBoundingClientRect().top;
                const shouldShow = showAt <= headerOffset() + 1;

                homeTabsBar.classList.toggle('is-visible', shouldShow);

                if (!shouldShow) return;

                // Highlight active tab
                const probe = window.scrollY + headerOffset() + homeTabsBar.offsetHeight + 24;
                let activeId = homeTabTargets[0]?.id || '';

                homeTabTargets.forEach(section => {
                    if (section.offsetTop <= probe) activeId = section.id;
                });

                homeSectionTabs.forEach(tab => {
                    tab.classList.toggle('is-active', new URL(tab.href).hash === '#' + activeId);
                });
            };

            homeSectionTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    homeSectionTabs.forEach(item => item.classList.toggle('is-active', item === tab));
                });
            });

            window.addEventListener('scroll', updateHomeTabs, { passive: true });
            window.addEventListener('resize', updateHomeTabs);
            updateHomeTabs();
        });
    </script>
@endif
