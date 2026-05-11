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
    <section id="about-us" class="s-download">

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
<section id="mission" class="s-process">

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
        {{-- <img src="images/phone-app-screens-1000.png"
             srcset="images/phone-app-screens-600.png 600w,
                     images/phone-app-screens-1000.png 1000w,
                     images/phone-app-screens-2000.png 2000w"
             sizes="(max-width: 2000px) 100vw, 2000px"
             alt="App Screenshots"> --}}
    </div>

</section> <!-- end s-process -->
    <!-- about
    ================================================== -->
    <section id="vision" class="s-about target-section">

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
            {{-- <img src="images/app-screen-1400.png"
                 srcset="images/app-screen-600.png 600w,
                         images/app-screen-1400.png 1400w,
                         images/app-screen-2800.png 2800w"
                 sizes="(max-width: 2800px) 100vw, 2800px"
                 alt="App Screenshots"> --}}
         </div>

    </section> <!-- end s-about -->





    <!-- features
    ================================================== -->
    <section id="goals" class="s-features target-section">

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
        </div>
    </section>


    <!-- end section-header -->


{{-- contact us section
================================================== --}}
<section id="contact" class="s-contact">

    {{-- background decoration --}}
    <div class="contact__bg-circle contact__bg-circle--1"></div>
    <div class="contact__bg-circle contact__bg-circle--2"></div>

    <div class="row contact__inner">

        {{-- LEFT — info side --}}
        <div class="col-six md-full contact__info">

            <span class="contact__label">{{ __('home-page.get_in_touch') }}</span>

            <h1 class="contact__heading">
                {{ __('home-page.stay_in_touch') }}
            </h1>

            <div class="contact__rule"></div>

            <p class="contact__desc">
                {!! __('home-page.contact_desc') !!}
            </p>

            <ul class="contact__meta">
                <li>
                    <span class="contact__meta-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </span>
                    <a href="mailto:support@standout.com">support@standout.com</a>
                </li>
                {{-- <li>
                    <span class="contact__meta-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                        </svg>
                    </span>
                    <span>{{ __('home-page.contact.location') }}</span>
                </li> --}}
            </ul>

        </div>

        {{-- RIGHT — form card --}}
        <div class="col-six md-full contact__form-col">

            <div class="contact-card">

                @if (session('success'))
                    <div class="contact-alert contact-alert--success" role="alert">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form
                    id="contact-form"
                    action="{{ route('contact.store') }}"
                    method="POST"
                    novalidate
                >
                    @csrf

                    <div class="cf-row">
                        <div class="contact-field-group">
                            <label class="cf-label" for="contact-name">{{ __('home-page.full_name') }} <span>*</span></label>
                            <input
                                type="text"
                                name="name"
                                id="contact-name"
                                class="contact-input @error('name') is-invalid @enderror"
                                placeholder="{{ __('home-page.placeholder_name') }}"
                                value="{{ old('name') }}"
                                required
                            >
                            @error('name')
                                <span class="contact-error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="contact-field-group">
                            <label class="cf-label" for="contact-email">{{ __('home-page.email_address') }} <span>*</span></label>
                            <input
                                type="email"
                                name="email"
                                id="contact-email"
                                class="contact-input @error('email') is-invalid @enderror"
                                placeholder="{{ __('home-page.placeholder_email') }}"
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <span class="contact-error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="contact-field-group">
                        <label class="cf-label" for="contact-subject">{{ __('home-page.subject') }}</label>
                        <input
                            type="text"
                            name="subject"
                            id="contact-subject"
                            class="contact-input @error('subject') is-invalid @enderror"
                            placeholder="{{ __('home-page.placeholder_subject') }}"
                            value="{{ old('subject') }}"
                        >
                    </div>

                    <div class="contact-field-group">
                        <label class="cf-label" for="contact-message">{{ __('home-page.message') }} <span>*</span></label>
                        <textarea
                            name="message"
                            id="contact-message"
                            class="contact-input contact-textarea @error('message') is-invalid @enderror"
                            placeholder="{{ __('home-page.placeholder_message') }}"
                            rows="5"
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <span class="contact-error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-submit-row">
                        <button type="submit" id="contact-submit" class="contact-btn">
                            <span class="contact-btn__text">{{ __('home-page.send_message') }}</span>
                            <span class="contact-btn__icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                </svg>
                            </span>
                            <span class="contact-btn__spinner" hidden>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                                </svg>
                            </span>
                        </button>
                        <span class="contact-feedback" id="contact-feedback"></span>
                    </div>

                </form>
            </div>
        </div>

    </div>

</section><!-- end s-contact -->


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

        {{-- <div class="testimonials-wrap" data-aos="fade-up">

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

        </div> <!-- end testimonials-wrap --> --}}

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

{{-- ======= STYLES ======= --}}
<style>
:root {
    --c-green:      #00a650;
    --c-green-dark: #008f44;
    --c-green-glow: rgba(0, 166, 80, 0.18);
    --c-dark:       #111314;
    --c-dark-2:     #1a1d1e;
    --c-white:      #ffffff;
    --c-red:        #e53935;
}

/* ── Section ────────────────────────────────────────────── */
.s-contact {
    position: relative;
    padding: 9rem 0 8rem;
    background: var(--c-dark);
    overflow: hidden;
}

/* decorative glowing circles */
.contact__bg-circle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}
.contact__bg-circle--1 {
    width: 600px;
    height: 600px;
    top: -200px;
    right: -150px;
    background: radial-gradient(circle, var(--c-green-glow) 0%, transparent 65%);
}
.contact__bg-circle--2 {
    width: 400px;
    height: 400px;
    bottom: -150px;
    left: -100px;
    background: radial-gradient(circle, rgba(0,166,80,0.10) 0%, transparent 65%);
}

/* ── Inner layout ───────────────────────────────────────── */
.contact__inner {
    position: relative;
    z-index: 1;
    align-items: center;
}

/* ── Left: info ─────────────────────────────────────────── */
.contact__info {
    padding-right: 5rem;
}

.contact__label {
    display: inline-block;
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--c-green);
    margin-bottom: 1.8rem;
    padding: 5px 14px;
    border: 1px solid var(--c-green);
    border-radius: 20px;
}

.contact__heading {
    font-size: 5.2rem !important;
    line-height: 1.08 !important;
    font-weight: 800 !important;
    color: var(--c-white) !important;
    margin-bottom: 2rem !important;
}

.contact__rule {
    width: 44px;
    height: 3px;
    background: var(--c-green);
    margin-bottom: 2.2rem;
    border-radius: 2px;
}

.contact__desc {
    font-size: 1.55rem !important;
    line-height: 1.75 !important;
    color: rgba(255,255,255,0.60) !important;
    margin-bottom: 3.4rem !important;
}

/* meta list */
.contact__meta {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 1.4rem;
}

.contact__meta li {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 1.4rem;
    color: rgba(255,255,255,0.70);
}

.contact__meta a {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    border-bottom: 1px solid rgba(255,255,255,0.25);
    transition: color 0.2s, border-color 0.2s;
}

.contact__meta a:hover {
    color: var(--c-green);
    border-color: var(--c-green);
}

.contact__meta-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    background: var(--c-green-glow);
    border: 1px solid rgba(0,166,80,0.3);
    border-radius: 50%;
    flex-shrink: 0;
    color: var(--c-green);
}

/* ── Card ───────────────────────────────────────────────── */
.contact-card {
    background: var(--c-dark-2);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 3.8rem 3.4rem;
    box-shadow: 0 24px 60px rgba(0,0,0,0.35);
}

/* ── Two-col row ────────────────────────────────────────── */
.cf-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

/* ── Field groups ───────────────────────────────────────── */
.contact-field-group {
    margin-bottom: 18px;
    width: 100%;
}

/* ── Labels ─────────────────────────────────────────────── */
.cf-label {
    display: block;
    font-size: 1.1rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.50);
    margin-bottom: 8px;
}

.cf-label span { color: var(--c-green); }

/* ── Inputs & Textarea ──────────────────────────────────── */
.contact-input {
    display: block;
    width: 100%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 8px;
    color: #fff;
    font-size: 1.4rem;
    font-family: inherit;
    padding: 12px 15px;
    outline: none;
    transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
    -webkit-appearance: none;
    appearance: none;
}

.contact-input::placeholder {
    color: rgba(255,255,255,0.22);
}

.contact-input:focus {
    border-color: var(--c-green);
    background: rgba(0,166,80,0.06);
    box-shadow: 0 0 0 3px rgba(0,166,80,0.12);
}

.contact-input.is-invalid {
    border-color: var(--c-red);
    box-shadow: 0 0 0 3px rgba(229,57,53,0.12);
}

.contact-textarea {
    resize: vertical;
    min-height: 130px;
    line-height: 1.6;
}

/* ── Error messages ─────────────────────────────────────── */
.contact-error-msg {
    display: block;
    margin-top: 5px;
    font-size: 1.15rem;
    color: #ef9a9a;
}

/* ── Submit row ─────────────────────────────────────────── */
.contact-submit-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: 6px;
    flex-wrap: wrap;
}

/* ── Button ─────────────────────────────────────────────── */
.contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--c-green);
    border: 2px solid var(--c-green);
    color: #fff;
    font-family: inherit;
    font-size: 1.2rem;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    padding: 13px 30px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.22s, border-color 0.22s, transform 0.15s, box-shadow 0.22s;
    white-space: nowrap;
}

.contact-btn:hover {
    background: var(--c-green-dark);
    border-color: var(--c-green-dark);
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(0,166,80,0.30);
}

.contact-btn:active  { transform: translateY(0); }
.contact-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

/* Spinner */
.contact-btn__spinner svg {
    display: block;
    animation: cf-spin 0.75s linear infinite;
}
@keyframes cf-spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

/* ── Feedback ───────────────────────────────────────────── */
.contact-feedback { font-size: 1.3rem; line-height: 1.4; }
.contact-feedback--success { color: var(--c-green); }
.contact-feedback--error   { color: #ef9a9a; }

/* ── Session banner ─────────────────────────────────────── */
.contact-alert {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    border-radius: 8px;
    font-size: 1.3rem;
}
.contact-alert--success {
    background: rgba(0,166,80,0.12);
    color: #69e09a;
    border-left: 3px solid var(--c-green);
}

/* ── Responsive ─────────────────────────────────────────── */
@media screen and (max-width: 900px) {
    .contact__info    { padding-right: 0; margin-bottom: 4rem; }
    .contact__heading { font-size: 4rem !important; }
}

@media screen and (max-width: 600px) {
    .s-contact        { padding: 6rem 0 5rem; }
    .cf-row           { grid-template-columns: 1fr; }
    .contact-card     { padding: 2.4rem 2rem; }
    .contact__heading { font-size: 3.4rem !important; }
    .contact-btn      { width: 100%; justify-content: center; }
    .contact-submit-row { flex-direction: column; align-items: stretch; }
}
</style>


{{-- ======= SCRIPT ======= --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.header-main-nav a[href^="#"]');

    function setActiveLink() {

        let current = '';

        sections.forEach(section => {

            const sectionTop = section.offsetTop - 120;
            const sectionHeight = section.offsetHeight;

            if (window.scrollY >= sectionTop &&
                window.scrollY < sectionTop + sectionHeight) {

                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {

            link.parentElement.classList.remove('current');

            const href = link.getAttribute('href');

            if (href === '#' + current) {
                link.parentElement.classList.add('current');
            }
        });
    }

    window.addEventListener('scroll', setActiveLink);

    setActiveLink();
});
(function () {
    'use strict';

    const form     = document.getElementById('contact-form');
    const feedback = document.getElementById('contact-feedback');
    const btn      = document.getElementById('contact-submit');
    if (!form || !btn) return;

    const btnText = btn.querySelector('.contact-btn__text');
    const btnIcon = btn.querySelector('.contact-btn__icon');
    const spinner = btn.querySelector('.contact-btn__spinner');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const name    = form.querySelector('[name="name"]').value.trim();
        const email   = form.querySelector('[name="email"]').value.trim();
        const message = form.querySelector('[name="message"]').value.trim();

        if (!name || !email || !message) {
            showFeedback(@json(__('home-page.required_fields')), 'error');
            return;
        }

        setLoading(true);

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.content : '',
                },
                body: new FormData(form),
            });

            const data = await res.json();

            if (res.ok && data.success) {
                showFeedback('✓ ' + data.message, 'success');
                form.reset();

            } else if (res.status === 422 && data.errors) {

                const firstError = Object.values(data.errors)[0][0];
                showFeedback(firstError, 'error');

            } else if (res.status === 429) {

                showFeedback(@json(__('home-page.too_many_attempts')), 'error');

            } else {

                showFeedback(@json(__('home-page.something_wrong')), 'error');
            }

        } catch (err) {

            showFeedback(@json(__('home-page.network_error')), 'error');

        } finally {
            setLoading(false);
        }
    });

    function setLoading(on) {

        btn.disabled = on;

        btnText.textContent = on
            ? @json(__('home-page.sending'))
            : @json(__('home-page.send_message'));

        if (btnIcon) btnIcon.hidden = on;

        spinner.hidden = !on;

        if (on) {
            feedback.textContent = '';
            feedback.className = 'contact-feedback';
        }
    }

    function showFeedback(msg, type) {
        feedback.textContent = msg;
        feedback.className = 'contact-feedback contact-feedback--' + type;
    }

})();

</script>
@endsection
