<header class="th-header header-layout1">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                <div class="col-auto d-none d-lg-block">
                    <div class="header-links">
                        <ul>
                            <li class="d-none d-sm-inline-block"><i class="fas fa-phone icon-btn"></i><b>Phone:</b> <a href="tel:+918340138097">+918340138097</a></li>
                            <li class="d-none d-sm-inline-block"><i class="fas fa-envelope icon-btn"></i><b>Email:</b> <a href="mailto:info@info@tatamedicaldspvt.com">info@tatamedicaldspvt.com</a></li>
                            <li class="d-none d-xxl-inline-block"><i class="fas fa-location-dot icon-btn"></i> 177 Danapur Patna, Bihar</li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul>
                            <li class="d-none d-md-inline-block">
                                <div class="dropdown-link">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="{{ asset('assets/img/icon/english.png') }}" alt="icon"> English</a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <li>
                                            <a href="#">India</a>
                                            <a href="#">French</a>
                                            <a href="#">Italian</a>
                                            <a href="#">Latvian</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="social-links">
                                    <span class="social-title">Follow Us On: </span>
                                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                                    <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <!-- Main Menu Area -->
        <div class="menu-area">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo">
                            <div class="logo-bg" style="background: #059804;"></div>
                            <a href="{{ route('web.homepage.index') }}">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Tata Medical">
                            </a>
                        </div>
                    </div>
                    <div class="col-auto d-none d-lg-inline-block">
                        <nav class="main-menu d-none d-lg-inline-block">
                            <ul>
                                <li><a href="{{ route('web.homepage.index') }}">Home</a></li>
                                <li><a href="{{ route('web.about.index') }}">About Us</a></li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.service.index') }}">Service</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('web.service.index') }}">Service</a></li>
                                        <li><a href="{{ route('web.service.show') }}">Service Details</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.team.index') }}">Doctors</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('web.team.index') }}">Team</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('web.gallery.index') }}">Gallerys</a></li>
                                <li><a href="{{ route('web.appointment.index') }}">Appointments</a></li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.blog.index') }}">Blog</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('web.blog.index') }}">Blog</a></li>
                                        <li><a href="{{ route('web.blog.show') }}">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('web.contact.index') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-auto">
                        <div class="header-button">
                            <!-- <button type="button" class="icon-btn searchBoxToggler d-none d-xl-inline-block"><i class="far fa-search"></i></button> -->
                            <a href="{{ route('web.appointment.index') }}" class="th-btn">Appointment Now</a>
                            <button type="button" class="icon-btn sideMenuInfo d-none d-xl-inline-block"><i class="far fa-bars"></i></button>
                            <button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>