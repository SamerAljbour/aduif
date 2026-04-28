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
                <li class="current"><a class="smoothscroll" href="#home" title="intro">Intro</a></li>
                <li><a class="smoothscroll" href="#about" title="about">About</a></li>
                <li><a class="smoothscroll" href="#features" title="features">Features</a></li>
                <li><a class="smoothscroll" href="#pricing" title="pricing">Pricing</a></li>
                <li><a class="smoothscroll" href="{{ route('managements.showManagers') }}" title="managers">Managers</a></li>
                <li><a href="{{ route('members.showMembers') }}" title="Members">Members</a></li>
                <li>
                    <a href="{{ route('register') }}" title="register">Register</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" title="blog">Login</a>
                </li>
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

