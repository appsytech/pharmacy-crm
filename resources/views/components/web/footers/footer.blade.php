<!--==============================
	Footer Area
    ==============================-->
<footer class="footer-wrapper footer-layout1" data-bg-src="{{ asset('assets/img/bg/footer_bg_1.jpg') }}">
    <div class="container z-index-common">
        <div class="newsletter-wrap">
            <div class="newsletter-content">
                <h2 class="sec-title">Subscribe for newsletter</h2>
            </div>
            <form class="newsletter-form">
                <div class="form-group">
                    <input class="form-control" type="email" placeholder="Email Address" required="">
                </div>
                <button type="submit" class="th-btn shadow-1">Subscribe</button>
            </form>
        </div>
    </div>
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="{{ route('web.homepage.index') }}">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="Tata Medical">
                                </a>
                            </div>
                            <p class="about-text">Subscribe to out newsletter today to receive latest news administrate cost effective for tactical data.</p>
                            <p class="footer-info">
                                <i class="fal fa-location-dot"></i>
                                2478 Street City Ohio 90255
                            </p>
                            <p class="footer-info">
                                <i class="fal fa-envelope"></i>
                                <a href="mailto:info@tatamedicaldspvt.com" class="info-box_link">info@tatamedicaldspvt.com</a>
                            </p>
                            <p class="footer-info">
                                <i class="fal fa-phone"></i>
                                <a href="tel:+918340138097" class="info-box_link">+918340138097</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Quick Links</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{ route('web.about.index') }}">About Us</a></li>
                                <li><a href="{{ route('web.about.index') }}">Terms of Use</a></li>
                                <li><a href="{{ route('web.service.index') }}">Our Services</a></li>
                                <li><a href="#">Help & FAQs</a></li>
                                <li><a href="{{ route('web.blog.index') }}">Blog</a></li>
                                <li><a href="{{ route('web.about.index') }}">Privacy policy</a></li>
                                <li><a href="{{ route('web.contact.index') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Popular service</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{ route('web.service.index') }}">Cardiology Care</a></li>
                                <li><a href="{{ route('web.service.index') }}">Urgent Care</a></li>
                                <li><a href="{{ route('web.service.index') }}">Orthopedic Care</a></li>
                                <li><a href="{{ route('web.service.index') }}">Diagnosis department</a></li>
                                <li><a href="{{ route('web.service.index') }}">Gastroenterology</a></li>
                                <li><a href="{{ route('web.service.index') }}">Therapy department</a></li>
                                <li><a href="{{ route('web.service.index') }}">Dental service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            <div class="recent-post">
                                <div class="media-img">
                                    <a href="{{ route('web.blog.show') }}"><img src="{{ asset('assets/img/blog/recent-post-2-1.jpg') }}" alt="Blog Image"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="text-inherit" href="{{ route('web.blog.show') }}">How Business Is Taking Over & What to Do About It</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="{{ route('web.blog.index') }}"><i class="fal fa-calendar"></i>21 Jun, 2024</a>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-post">
                                <div class="media-img">
                                    <a href="{{ route('web.blog.show') }}"><img src="{{ asset('assets/img/blog/recent-post-2-2.jpg') }}" alt="Blog Image"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="text-inherit" href="{{ route('web.blog.show') }}">Health vs. Wealth Navigate Business in Medicine</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="{{ route('web.blog.index') }}"><i class="fal fa-calendar"></i>22 Jun, 2024</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row gy-2 align-items-center">
                <div class="col-md-7">
                    <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> 2026 <a href="{{ route('web.homepage.index') }}">Tata Medical DS Pvt.</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-5 text-center text-md-end">
                    <div class="th-social">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--********************************
			Code End  Here
	******************************** -->
<!-- Booking Appointment Button -->
<div class="booking-btn">
    <a href="{{ route('web.appointment.index') }}">
        <span class="pulse-ring"></span>
        <span class="pulse-ring pulse-ring-delay"></span>
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </a>
</div>

<!-- Call Button -->
<div class="call-btn">
    <a href="tel:+918340138097">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-svg">
            <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 0 0-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z" />
        </svg>
    </a>
</div>

<!-- WhatsApp Button -->
<div class="whatsapp-btn">
    <a href="https://wa.me/918340138097" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
        </svg>
    </a>
</div>

<!-- Scroll To Top -->
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>