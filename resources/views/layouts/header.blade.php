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
                    <a class="smoothscroll" href="#home" title="intro"> {{ __('header.home') }} </a>
                </li>
                <li>
                    <a class="smoothscroll" href="#about" title="about"> {{ __('header.about_us') }} </a>
                </li>
                {{-- <li>
                    <a class="smoothscroll" href="#features" title="features"> {{ __('header.goals') }} </a>
                </li>
                <li>
                    <a class="smoothscroll" href="#pricing" title="pricing"> {{ __('header.vision') }} </a>
                </li> --}}
                <li class="{{ request()->routeIs('posts.allPosts') ? 'current' : '' }}">
                    <a href="{{ route('posts.allPosts') }}" title="managers"> {{ __('header.posts') }} </a>
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

    <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
    <li><a href="#0"><i class="fab fa-instagram"></i></a></li>

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

