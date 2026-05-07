@extends('userLayouts.app')

@section('content')
{{-- {{ app()->getLocale() }} --}}

<!-- home
    ================================================== -->
    <section id="home" class="s-home target-section">

        <div class="home-image-part"></div>

        <div class="home-content">

            <div class="row home-content__main wide">

                 <h1>
            {{ __('home-page.hero-title-line1') }} <br>
            {{ __('home-page.hero-title-line2') }}
        </h1>

        <h3>
            {{ __('home-page.hero-description') }}
        </h3>
                <div class="home-content__button">
                    {{-- <a class="btn-video" href="https://player.vimeo.com/video/14592941?color=00a650&title=0&byline=0&portrait=0" data-lity>
                        <span class="video-icon"></span>
                    </a> --}}
                    <a href="{{ route('join-us.index') }}" class="smoothscroll btn btn--primary btn--large">
                        {{ __('home-page.join-us') }}
                    </a>
                </div>

            </div> <!-- end home-content__main -->

            <a href="#about" class="home-scroll smoothscroll">
                <span class="home-scroll__text">Scroll Down</span>
                <span class="home-scroll__icon"></span>
            </a>

        </div> <!-- end home-content -->

    </section> <!-- end s-home -->


    <!-- About us
    ================================================== -->
    <section id="download" class="s-download">

        <div class="row download-content @if(app()->getLocale() !== 'ar') flex-row-reverse @endif">
            <div class="col-six md-seven download-content__text @if(app()->getLocale() !== 'ar') pull-right @endif" data-aos="fade-up">
                <h1 class="display-2">
                    {{ __('home-page.about-us.title') }}
                </h1>
                <p>
                  {{ __('home-page.about-us.description') }}
                </p>
                {{-- <ul class="download-content__badges">
                    <li><a href="#0" title="" class="badge-appstore">App Store</a></li>
                    <li><a href="#0" title="" class="badge-googleplay">Play Store</a></li>
                </ul> --}}
            </div>
            <div class="download-content__image" data-aos="fade-up">
                <img src="{{ asset('user/images/about-us-final.png') }}"
     srcset="{{ asset('user/images/about-us-final.png') }} 1x, {{ asset('user/images/about-us-final.png') }} 2x"
     alt="Home Photo">
            </div>
        </div>

    </section> <!-- end about us -->

        <!-- process
    ================================================== -->
   <!-- process / mission
================================================== -->
<section id="process" class="s-process">

    <div class="row">
        <div class="col-full text-center" data-aos="fade-up">
            {{-- <span class="mission-eyebrow">{{ __('home-page.mission.eyebrow') }}</span> --}}
            <h2 class="display-2">{{ __('home-page.mission.eyebrow') }}</h2>
            <div class="mission-divider"></div>
        </div>
    </div>

    <div class="row mission-grid" data-aos="fade-up">

        <div class="col-block mission-card">
            <div class="mission-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <span class="mission-card__num">{{ __('home-page.mission.items.0.number') }}</span>
            <h3>{{ __('home-page.mission.items.0.title') }}</h3>
            <p>{{ __('home-page.mission.items.0.description') }}</p>
        </div>

        <div class="col-block mission-card">
            <div class="mission-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                </svg>
            </div>
            <span class="mission-card__num">{{ __('home-page.mission.items.1.number') }}</span>
            <h3>{{ __('home-page.mission.items.1.title') }}</h3>
            <p>{{ __('home-page.mission.items.1.description') }}</p>
        </div>

        <div class="col-block mission-card">
            <div class="mission-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </div>
            <span class="mission-card__num">{{ __('home-page.mission.items.2.number') }}</span>
            <h3>{{ __('home-page.mission.items.2.title') }}</h3>
            <p>{{ __('home-page.mission.items.2.description') }}</p>
        </div>

        <div class="col-block mission-card">
            <div class="mission-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <span class="mission-card__num">{{ __('home-page.mission.items.3.number') }}</span>
            <h3>{{ __('home-page.mission.items.3.title') }}</h3>
            <p>{{ __('home-page.mission.items.3.description') }}</p>
        </div>

    </div>

    <div class="row process-bottom-image" data-aos="fade-up">
        <img src="images/phone-app-screens-1000.png"
             srcset="images/phone-app-screens-600.png 600w,
                     images/phone-app-screens-1000.png 1000w,
                     images/phone-app-screens-2000.png 2000w"
             sizes="(max-width: 2000px) 100vw, 2000px"
             alt="App Screenshots">
    </div>

</section> <!-- end s-process -->
    <!-- about
    ================================================== -->
    <section id="about" class="s-about target-section">

        <div class="row section-header narrower align-center" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    {{ __('home-page.vision.title') }}
                </h1>
                            <div class="mission-divider" style="background-color: #fff; margin-bottom: 3rem;"></div>

                <p class="lead">
                    {{ __('home-page.vision.description') }}
                </p>
            </div>
        </div> <!-- end section-header -->

        {{-- <div class="row about-desc" data-aos="fade-up">
            <div class="col-full slick-slider about-desc__slider">

                <div class="about-desc__slide">
                    <h3 class="item-title">Smart.</h3>

                    <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
                    </p>
                </div>  <!-- end about-desc__slide -->

                <div class="about-desc__slide">
                    <h3 class="item-title">User-Friendly.</h3>

                    <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
                    </p>
                </div>  <!-- end about-desc__slide -->

                <div class="about-desc__slide">
                    <h3 class="item-title">Powerful.</h3>

                    <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
                    </p>
                </div>  <!-- end about-desc__slide -->

                <div class="about-desc__slide">
                    <h3 class="item-title">Secure.</h3>

                    <p>
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea aut cumque eos.
                    </p>
                </div>  <!-- end about-desc__slide -->

            </div> <!-- end about-desc__slider -->
        </div> <!-- end about-desc --> --}}

        <div class="row about-bottom-image" data-aos="fade-up">
            <img src="images/app-screen-1400.png"
                 srcset="images/app-screen-600.png 600w,
                         images/app-screen-1400.png 1400w,
                         images/app-screen-2800.png 2800w"
                 sizes="(max-width: 2800px) 100vw, 2800px"
                 alt="App Screenshots">
         </div>

    </section> <!-- end s-about -->





    <!-- features
    ================================================== -->
    <section id="features" class="s-features target-section">

        <div class="row section-header narrower align-center has-bottom-sep" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    {{ __('home-page.goals.title') }}
                </h1>
                            <div class="mission-divider" style=" margin-bottom: 3rem;"></div>

                <p class="lead">
                    {{ __('home-page.goals.description') }}
                </p>
                </p>
            </div>
        </div> <!-- end section-header -->

        {{-- <div class="row bit-narrow features block-1-2 block-mob-full">

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-upload"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Cloud Based</h3>
                    <p>Nemo cupiditate ab quibusdam quaerat impedit magni. Earum suscipit ipsum laudantium.
                    Quo delectus est. Maiores voluptas ab sit natus veritatis ut. Debitis nulla cumque veritatis.
                    Sunt suscipit voluptas ipsa in tempora esse soluta sint.
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-video-camera"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Voice & Video</h3>
                    <p>Nemo cupiditate ab quibusdam quaerat impedit magni. Earum suscipit ipsum laudantium.
                    Quo delectus est. Maiores voluptas ab sit natus veritatis ut. Debitis nulla cumque veritatis.
                    Sunt suscipit voluptas ipsa in tempora esse soluta sint.
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-shield"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Always Secure</h3>
                    <p>Nemo cupiditate ab quibusdam quaerat impedit magni. Earum suscipit ipsum laudantium.
                    Quo delectus est. Maiores voluptas ab sit natus veritatis ut. Debitis nulla cumque veritatis.
                    Sunt suscipit voluptas ipsa in tempora esse soluta sint.
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-lego-block"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Play Games</h3>
                    <p>Nemo cupiditate ab quibusdam quaerat impedit magni. Earum suscipit ipsum laudantium.
                    Quo delectus est. Maiores voluptas ab sit natus veritatis ut. Debitis nulla cumque veritatis.
                    Sunt suscipit voluptas ipsa in tempora esse soluta sint.
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-chat"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Group Chat</h3>
                    <p>Nemo cupiditate ab quibusdam quaerat impedit magni. Earum suscipit ipsum laudantium.
                    Quo delectus est. Maiores voluptas ab sit natus veritatis ut. Debitis nulla cumque veritatis.
                    Sunt suscipit voluptas ipsa in tempora esse soluta sint.
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-wallet"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Payments</h3>
                    <p>Nemo cupiditate ab quibusdam quaerat impedit magni. Earum suscipit ipsum laudantium.
                    Quo delectus est. Maiores voluptas ab sit natus veritatis ut. Debitis nulla cumque veritatis.
                    Sunt suscipit voluptas ipsa in tempora esse soluta sint.
                    </p>
                </div>
            </div>

        </div> <!-- end features --> --}}

        <div class="testimonials-wrap" data-aos="fade-up">

            <div class="row">
                <div class="col-full testimonials-header">
                    <h2 class="display-2">1 Million+ Users Can't Be Wrong.</h2>
                </div>
            </div>

            <div class="row testimonials">

                <div class="col-full slick-slider testimonials__slider">

                    <div class="testimonials__slide">
                        <img src="images/avatars/user-01.jpg" alt="Author image" class="testimonials__avatar">
                        <div class="testimonials__author">
                            <span class="testimonials__name">Naruto Uzumaki</span>
                            <a href="#0" class="testimonials__link">@narutouzumaki</a>
                        </div>
                        <p>Qui ipsam temporibus quisquam velMaiores eos cumque distinctio nam accusantium ipsum.
                        Laudantium quia consequatur molestias delectus culpa facere hic dolores aperiam. Accusantium praesentium corpori.</p>
                    </div> <!-- end testimonials__slide -->

                    <div class="testimonials__slide">
                        <img src="images/avatars/user-02.jpg" alt="Author image" class="testimonials__avatar">
                        <div class="testimonials__author">
                            <span class="testimonials__name">Sasuke Uchiha</span>
                            <a href="#0" class="testimonials__link">@sasukeuchiha</a>
                        </div>
                        <p>Excepturi nam cupiditate culpa doloremque deleniti repellat. Veniam quos repellat voluptas animi adipisci.
                        Nisi eaque consequatur. Quasi voluptas eius distinctio. Atque eos maxime. Qui ipsam temporibus quisquam vel.</p>
                    </div> <!-- end testimonials__slide -->

                    <div class="testimonials__slide">
                        <img src="images/avatars/user-03.jpg" alt="Author image" class="testimonials__avatar">
                        <div class="testimonials__author">
                            <span class="testimonials__name">Shikamaru Nara</span>
                            <a href="#0" class="testimonials__link">@shikamarunara</a>
                        </div>
                        <p>Repellat dignissimos libero. Qui sed at corrupti expedita voluptas odit. Nihil ea quia nesciunt. Ducimus aut sed ipsam.
                        Autem eaque officia cum exercitationem sunt voluptatum accusamus. Quasi voluptas eius distinctio.</p>
                    </div> <!-- end testimonials__slide -->

                </div> <!-- end testimonials__slider -->

            </div> <!-- end testimonials -->

        </div> <!-- end testimonials-wrap -->

    </section> <!-- end s-features -->


    <!-- pricing
    ================================================== -->
    {{-- <section id="pricing" class="s-pricing target-section">

        <div class="row section-header narrower align-center" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                   Our Easy Pricing Plans For Everyone.
                </h1>
                <p class="lead">
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea.
                </p>
            </div>
        </div> <!-- end section-header -->

        <div class="row plans block-1-3 block-m-1-2 block-tab-full stack">

            <div class="col-block item-plan" data-aos="fade-up">
                <div class="item-plan__block">

                    <div class="item-plan__top-part">
                        <h3 class="item-plan__title">Basic</h3>
                        <p class="item-plan__price">Free</p>
                    </div>

                    <div class="item-plan__bottom-part">
                        <ul class="item-plan__features disc">
                            <li><span>5GB</span> Storage</li>
                            <li><span>10GB</span> Bandwidth</li>
                            <li><span>5</span> Databases</li>
                            <li><span>30</span> Email Accounts</li>
                        </ul>

                        <a class="btn btn--primary large full-width" href="#0">Get Started</a>
                    </div>

                </div>
            </div> <!-- end item-plan -->

            <div class="col-block item-plan item-plan--popular" data-aos="fade-up">
                <div class="item-plan__block">

                    <div class="item-plan__top-part">
                        <h3 class="item-plan__title">Pro Plan</h3>
                        <p class="item-plan__price">$10</p>
                        <p class="item-plan__per">Per Month</p>
                    </div>

                    <div class="item-plan__bottom-part">
                        <ul class="item-plan__features disc">
                            <li><span>500GB</span> Storage</li>
                            <li><span>Unlimited</span> Bandwidth</li>
                            <li><span>50</span> Databases</li>
                            <li><span>50</span> Email Accounts</li>
                        </ul>

                        <a class="btn btn--primary large full-width" href="#0">Get Started</a>
                    </div>

                </div>
            </div> <!-- end item-plan -->

            <div class="col-block item-plan" data-aos="fade-up">
                <div class="item-plan__block">

                    <div class="item-plan__top-part">
                        <h3 class="item-plan__title">Ultimate Plan</h3>
                        <p class="item-plan__price">$20</p>
                        <p class="item-plan__per">Per Month</p>
                    </div>

                    <div class="item-plan__bottom-part">
                        <ul class="item-plan__features disc">
                            <li><span>1TB</span> Storage</li>
                            <li><span>Unlimited</span> Bandwidth</li>
                            <li><span>100</span> Databases</li>
                            <li><span>100</span> Email Accounts</li>
                        </ul>

                        <a class="btn btn--primary large full-width" href="#0">Get Started</a>
                    </div>

                </div>
            </div> <!-- end item-plan -->

        </div> <!-- end plans -->

    </section> <!-- end s-pricing --> --}}


@endsection
