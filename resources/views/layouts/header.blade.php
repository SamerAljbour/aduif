 <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="index.html">
                <img src="images/logo.svg" alt="Homepage">
            </a>
        </div>

        <nav class="row header-nav-wrap wide">
            <ul class="header-main-nav">
                <li class="{{ request()->is('/') ? 'current' : '' }}">
                    <a class="smoothscroll"  href="{{ url('/') }}#home" title="intro"> {{ __('header.home') }} </a>
                </li>
                <li>
                    <a class="smoothscroll" href="{{ url('/') }}#about-us" title="about"> {{ __('header.about_us') }} </a>
                </li>
                <li>
                    <a class="smoothscroll" href="{{ url('/') }}#mission" title="mission"> {{ __('header.mission') }} </a>
                </li>
                <li>
                    <a class="smoothscroll" href="{{ url('/') }}#vision" title="vision"> {{ __('header.vision') }} </a>
                </li>
                <li>
                    <a class="smoothscroll" href="{{ url('/') }}#goals" title="goals"> {{ __('header.goals') }} </a>
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

