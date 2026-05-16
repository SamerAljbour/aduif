
    <!-- footer
    ================================================== -->
    <footer class="s-footer footer">

        <div class="row footer__bottom">
            <div class="col-five tab-full">
                <div class="footer__logo">
                    <a href="{{ url('/') }}">
                      <img src="{{ asset('user/images/aduif-white.png') }}"
     alt="Homepage"
     style="width: auto; height: 64px; max-width: 160px; object-fit: contain; border-radius: 50%;">
                    </a>
                </div>

                <p>
               {{ __('home-page.hero-description') }}
                </p>

                <ul class="footer__social">
                    <li><a href="https://www.facebook.com/people/ADUIF-Jordanie/100064318494988/" target="_blank"> <i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                    {{-- <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li> --}}
                </ul>
            </div>

            <div class="col-six tab-full end">
                <ul class="footer__site-links">
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
                </ul>

                <p class="footer__contact">
                   {{ __('footer.question_text') }} <br>
                    <a href="mailto:aduif.jordanie@gmail.com" class="footer__mail-link">aduif.jordanie@gmail.com</a>
                </p>

                <div class="cl-copyright">
                    <span>
                        {{ __('footer.copyright') }} <script>document.write(new Date().getFullYear());</script> {{ __('footer.rights_reserved') }}
                    </span>
                </div>
            </div>

        </div>

        <div class="go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>

    </footer> <!-- end s-footer -->

