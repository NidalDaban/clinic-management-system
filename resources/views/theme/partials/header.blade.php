<header id="header" class="header sticky-top">

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('theme.index') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets') }}/img/RafiqCare-logo.png" alt="">
                <h1 class="sitename">RafiqCare</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('theme.index') }}" class=@yield('home-active')>Home<br></a></li>

                    {{-- <li><a href="{{ route('theme.doctors') }}" class=@yield('doctors-active')>Doctors / Psychologists</a></li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @yield('doctors-active')" href="#" id="ourTeamDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our Team
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ourTeamDropdown">
                            <li><a class="dropdown-item" href="{{ route('theme.doctors') }}">Doctors</a></li>
                            <li><a class="dropdown-item" href="{{ route('theme.psychologists') }}">Psychologists</a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('theme.contact') }}" class=@yield('contact-active')>Contact</a></li>
                    @if (!Auth::check())
                        <li><a href="{{ route('register') }}" class=@yield('register-active')>Registration / Login</a></li>
                    @else
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true"
                                aria-expanded="false">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('theme.user-profile') }}">Your
                                        Profile</a></li>
                                <li class="nav-item">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="nav-link" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="cta-btn d-none d-sm-block" href="#appointment">Make an Appointment</a>

        </div>

    </div>

</header>
