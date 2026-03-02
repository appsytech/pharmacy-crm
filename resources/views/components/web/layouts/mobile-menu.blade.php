<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{ route('web.homepage.index') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Tata Medical">
            </a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                <li><a href="{{ route('web.homepage.index') }}">Home</a></li>
                <li><a href="{{ route('web.about.index') }}">About Us</a></li>
                <li class="menu-item-has-children">
                    <a href="{{ route('web.service.index') }}">Service</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('web.service.index') }}">Service</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('web.appointment.index') }}">Appointments</a></li>
                        <li><a href="#">Faq Page</a></li>
                        <li><a href="#">Error Page</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Doctors</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('web.team.index') }}">Team</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('web.appointment.index') }}">Appointments</a></li>
                <li><a href="{{ route('web.gallery.index') }}">Gallerys</a></li>
                <li class="menu-item-has-children">
                    <a href="{{ route('web.blog.index') }}">Blog</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('web.blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('web.blog.show') }}">Blog Details</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('web.contact.index') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>