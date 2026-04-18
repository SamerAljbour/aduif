@extends('layouts.app')

@section('content')
<!-- home
    ================================================== -->
    <section id="home" class="s-home target-section">

        <div class="home-image-part"></div>

        <div class="home-content">

            <div class="row home-content__main wide">

                <h1>
                An Amazing App <br>
                That Does It All.
                </h1>

                <h3>
                Voluptatem ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.
                </h3>

                <div class="home-content__button">
                    <a class="btn-video" href="https://player.vimeo.com/video/14592941?color=00a650&title=0&byline=0&portrait=0" data-lity>
                        <span class="video-icon"></span>
                    </a>
                    <a href="#download" class="smoothscroll btn btn--primary btn--large">
                        Get The App
                    </a>
                </div>

            </div> <!-- end home-content__main -->

            <a href="#about" class="home-scroll smoothscroll">
                <span class="home-scroll__text">Scroll Down</span>
                <span class="home-scroll__icon"></span>
            </a>

        </div> <!-- end home-content -->

    </section> <!-- end s-home -->


    <!-- about
    ================================================== -->
    <section id="about" class="s-about target-section">

        <div class="row section-header narrower align-center" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    The Most Popular And Number 1 Mail App.
                </h1>
                <p class="lead">
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea.
                </p>
            </div>
        </div> <!-- end section-header -->

        <div class="row about-desc" data-aos="fade-up">
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
        </div> <!-- end about-desc -->

        <div class="row about-bottom-image" data-aos="fade-up">
            <img src="images/app-screen-1400.png"
                 srcset="images/app-screen-600.png 600w,
                         images/app-screen-1400.png 1400w,
                         images/app-screen-2800.png 2800w"
                 sizes="(max-width: 2800px) 100vw, 2800px"
                 alt="App Screenshots">
         </div>

    </section> <!-- end s-about -->


    <!-- process
    ================================================== -->
    <section id="process" class="s-process">

        <div class="row">
            <div class="col-full text-center" data-aos="fade-up">
                <h2 class="display-2">How The App Works?</h2>
            </div>
        </div>

        <div class="row process block-1-4 block-m-1-2 block-tab-full">
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>Sign Up</h3>
                    <p>
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                    </p>
                </div>
            </div>
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>Create</h3>
                    <p>
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                    </p>
                </div>
            </div>
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>Compose</h3>
                    <p>
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                    </p>
                </div>
            </div>
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>Send</h3>
                    <p>
                    Quos dolores saepe mollitia deserunt accusamus autem reprehenderit. Voluptas facere animi explicabo non quis magni recusandae.
                    Numquam debitis pariatur omnis facere unde.
                    </p>
                </div>
            </div>
        </div> <!-- end process -->

        <div class="row process-bottom-image" data-aos="fade-up">
            <img src="images/phone-app-screens-1000.png"
                 srcset="images/phone-app-screens-600.png 600w,
                         images/phone-app-screens-1000.png 1000w,
                         images/phone-app-screens-2000.png 2000w"
                 sizes="(max-width: 2000px) 100vw, 2000px"
                 alt="App Screenshots">
         </div>

    </section> <!-- end s-process -->


    <!-- features
    ================================================== -->
    <section id="features" class="s-features target-section">

        <div class="row section-header narrower align-center has-bottom-sep" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    Loaded With Features You Would Surely Love.
                </h1>
                <p class="lead">
                    Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
                    Ut quis enim rerum quia assumenda repudiandae non cumque qui. Amet repellat
                    omnis ea.
                </p>
            </div>
        </div> <!-- end section-header -->

        <div class="row bit-narrow features block-1-2 block-mob-full">

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

        </div> <!-- end features -->

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
    <section id="pricing" class="s-pricing target-section">

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

    </section> <!-- end s-pricing -->


    <!-- download
    ================================================== -->
    <section id="download" class="s-download">

        <div class="row download-content">
            <div class="col-six md-seven download-content__text pull-right" data-aos="fade-up">
                <h1 class="display-2">
                    Download The App Now!
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <ul class="download-content__badges">
                    <li><a href="#0" title="" class="badge-appstore">App Store</a></li>
                    <li><a href="#0" title="" class="badge-googleplay">Play Store</a></li>
                </ul>
            </div>
            <div class="download-content__image" data-aos="fade-up">
                <img src="images/phone-app-profile-550.png"
                     srcset="images/phone-app-profile-550.png 1x, images/phone-app-profile-1100.png 2x">
            </div>
        </div>

    </section> <!-- end s-download -->
@endsection
