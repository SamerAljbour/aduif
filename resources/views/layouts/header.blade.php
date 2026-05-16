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
                    <li class="{{ request()->is('/') ? 'current' : '' }} has-children">
                    <a class="smoothscroll" href="{{ url('/') }}#home" title="intro">
                        {{ __('header.home') }}
                        <span class="dropdown-arrow" aria-hidden="true">▾</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a class="smoothscroll" href="{{ url('/') }}#about-us" title="about">
                                {{ __('header.about_us') }}
                            </a>
                        </li>
                        <li>
                            <a class="smoothscroll" href="{{ url('/') }}#mission" title="mission">
                                {{ __('header.mission') }}
                            </a>
                        </li>
                        <li>
                            <a class="smoothscroll" href="{{ url('/') }}#vision" title="vision">
                                {{ __('header.vision') }}
                            </a>
                        </li>
                        <li>
                            <a class="smoothscroll" href="{{ url('/') }}#goals" title="goals">
                                {{ __('header.goals') }}
                            </a>
                        </li>
                    </ul>
                </li>
                    <li class="{{ request()->routeIs('managements.showManagers') ? 'current' : '' }}">
                        <a href="{{ route('managements.showManagers') }}" title="managers"> {{ __('header.management') }} </a>
                    </li>
                    <li class="{{ request()->routeIs('members.showMembers') ? 'current' : '' }}">
                        <a href="{{ route('members.showMembers') }}" title="Members"> {{ __('header.members') }} </a>
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

        <li><a href="https://www.facebook.com/people/ADUIF-Jordanie/100064318494988/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
        {{-- <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#0"><i class="fab fa-instagram"></i></a></li> --}}

        <li>
            @if(app()->getLocale() == 'fr')
                <a href="{{ route('set.locale', 'ar') }}">
                    AR
                </a>
            @else
                <a href="{{ route('set.locale', 'fr') }}">
                    FR
                </a>
            @endif
        </li>

    </ul>
            </nav>

            <a class="header-menu-toggle" href="#"><span>Menu</span></a>

        </header> <!-- end header -->

    <style>
        .header-main-nav .has-children {
            position: relative;
        }

        .header-main-nav .has-children > a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding-right: 4px;
        }

        .dropdown-arrow {
            font-size: 11px;
            line-height: 1;
            transition: transform 0.18s ease;
            color: rgba(255,255,255,0.9);
        }

        .header-main-nav .has-children:hover > a .dropdown-arrow {
            transform: rotate(180deg);
        }

        .header-main-nav .has-children .sub-menu {
            /* use opacity/transform for smooth transitions instead of display */
            display: block;
            position: absolute;
            top: calc(100% - 32px); /* slight overlap so there's no mouse gap */
            left: 50%;
            transform: translateX(-50%) translateY(-6px);
            background: #191231;

            list-style: none;
            padding: 4px 0;
            border-radius: 6px;
            z-index: 1000;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
            text-align: center; /* center the dropdown text */

            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 220ms cubic-bezier(.2,.9,.2,1), transform 220ms cubic-bezier(.2,.9,.2,1);
        }

        .header-main-nav .has-children:hover .sub-menu,
        .header-main-nav .has-children:focus-within .sub-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        .header-main-nav .has-children .sub-menu li {
            width: 100%;
        }

        .header-main-nav .has-children .sub-menu li a {
            display: block;
            width: 100%;
            padding: 6px 12px;
            color: rgba(255,255,255,0.85);
            font-size: 12px;
            white-space: nowrap;
            transition: background 0.12s, color 0.12s;
            border-radius: 4px;
            text-align: center; /* ensure link text is centered */
        }

        .header-main-nav .has-children .sub-menu li a:hover {
            color: #ffffff;
            background: rgba(255,255,255,0.03);
        }

        /* Focus styles for keyboard/touch users */
        .header-main-nav .has-children > a:focus + .sub-menu,
        .header-main-nav .has-children > a:active + .sub-menu {
            display: block;
        }
    </style>
