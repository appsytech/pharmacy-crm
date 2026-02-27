@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<x-web.breadcrumb.default-breadcrumb label="About Us" :items="[['label' => 'Home', 'url' => route('web.homepage.index')],['label' => 'About Us', 'active' => true]]" />


<!--==============================
About Area
==============================-->
<x-web.sections.about.wrapper />


<!--==============================
Counter Area
==============================-->
<x-web.pages.sections.counter.wrapper />


<!--==============================
Feature Area
==============================-->
<section class="why-sec3 space-top" id="why-sec" data-bg-src="assets/img/bg/why_bg_3.jpg">
    <div class="container pb-5 mb-2">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <div class="title-area text-center">
                    <span class="sub-title"><img src="assets/img/theme-img/title_icon.svg" alt="shape">Why Choose
                        Us</span>
                    <h2 class="sec-title">We Have 25 Years Experience in Medical Health Services</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-xl-3 col-sm-6">
                <div class="why-feature" data-bg-src="assets/img/bg/why_feature_bg.png">
                    <div class="box-icon">
                        <img src="assets/img/icon/choose_feature_1.svg" alt="icon">
                    </div>
                    <h3 class="box-title">Experience Doctor</h3>
                    <p class="box-text">Our products are certified by reputable organic.</p>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="why-feature" data-bg-src="assets/img/bg/why_feature_bg.png">
                    <div class="box-icon">
                        <img src="assets/img/icon/choose_feature_2.svg" alt="icon">
                    </div>
                    <h3 class="box-title">Painless Treatment</h3>
                    <p class="box-text">Our products are certified by reputable organic.</p>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="why-feature" data-bg-src="assets/img/bg/why_feature_bg.png">
                    <div class="box-icon">
                        <img src="assets/img/icon/choose_feature_3.svg" alt="icon">
                    </div>
                    <h3 class="box-title">Top Equipment</h3>
                    <p class="box-text">Our products are certified by reputable organic.</p>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="why-feature" data-bg-src="assets/img/bg/why_feature_bg.png">
                    <div class="box-icon">
                        <img src="assets/img/icon/choose_feature_4.svg" alt="icon">
                    </div>
                    <h3 class="box-title">24/7 Advance Care</h3>
                    <p class="box-text">Our products are certified by reputable organic.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container z-index-common" data-pos-for="#why-sec" data-sec-pos="top-half">
    <div class="th-video">
        <img src="assets/img/normal/video_1.jpg" alt="video">
        <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn popup-video"><i
                class="fas fa-play"></i></a>
    </div>
</div>
<!--==============================
Team Area
==============================-->
<section class="space" id="team-sec">
    <div class="container z-index-common">
        <div class="title-area text-center">
            <span class="sub-title"><img src="assets/img/theme-img/title_icon.svg" alt="Icon">Expert doctors</span>
            <h2 class="sec-title">Meet our professional Doctors</h2>
        </div>
        <div class="swiper th-slider has-shadow" id="teamSlider1"
            data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'>
            <div class="swiper-wrapper">
                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_1.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Malcolm Function</a></h3>
                        <span class="team-desig">Neurologist</span>
                    </div>
                </div>

                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_2.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Douglas Lyphe</a></h3>
                        <span class="team-desig">Physiotherapist</span>
                    </div>
                </div>

                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_3.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Wisteria Ravenc</a></h3>
                        <span class="team-desig">Cardiologist</span>
                    </div>
                </div>

                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_4.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Benjamin Evalent</a></h3>
                        <span class="team-desig">Dentist</span>
                    </div>
                </div>

                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_5.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Rishita Rosei</a></h3>
                        <span class="team-desig">Neurologist</span>
                    </div>
                </div>

                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_6.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Emanuyel Mac</a></h3>
                        <span class="team-desig">Physiotherapist</span>
                    </div>
                </div>

                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_7.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Wilium Lily</a></h3>
                        <span class="team-desig">Cardiologist</span>
                    </div>
                </div>

                <!-- Single Item -->
                <div class="swiper-slide">
                    <div class="th-team team-card">
                        <div class="box-img">
                            <img src="assets/img/team/team_1_8.jpg" alt="Team">
                            <div class="th-social">
                                <a target="_blank" href="https://facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <h3 class="box-title"><a href="team-details.html">Dr. Esabel Macran</a></h3>
                        <span class="team-desig">Dentist</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--==============================
Cta Area
==============================-->
<section class="space" data-bg-src="assets/img/bg/cta_bg_6.jpg">
    <div class="container py-40">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <h2 class="h1 sec-title text-white"><span class="text-theme">Tata Medical</span> is Leading & Modern
                    Technologies Hospital</h2>
                <div class="btn-group justify-content-center">
                    <a href="contact.html" class="th-btn style4 shadow-1">Make An Appointment</a>
                    <a href="contact.html" class="th-btn shadow-1">Contact Us Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Achievement Area
==============================-->
<section class="space" id="achieve-sec">
    <div class="container">
        <div class="title-area text-center text-md-start">
            <span class="sub-title"><img src="assets/img/theme-img/title_icon.svg" alt="shape">Achievement</span>
            <h2 class="sec-title">See all Our achievements</h2>
        </div>
        <div class="achieve-box-wrap">
            <div class="achieve-box hover-item item-active">
                <div class="box-img">
                    <img src="assets/img/normal/achieve_1.jpg" alt="Image">
                </div>
                <div class="box-year">2019</div>
                <div class="media-body">
                    <h3 class="box-title">Top Medical Clinic Service Award</h3>
                    <p class="box-text">Our team of dedicated healthcare professionals combines years of experience
                        with a genuine commitment to providing</p>
                </div>
            </div>
            <div class="achieve-box hover-item ">
                <div class="box-img">
                    <img src="assets/img/normal/achieve_2.jpg" alt="Image">
                </div>
                <div class="box-year">2020</div>
                <div class="media-body">
                    <h3 class="box-title">Best Dental Surgery Award</h3>
                    <p class="box-text">Your health and well-being are our top priorities. We take the time to
                        listen to your concerns, answer your questions.</p>
                </div>
            </div>
            <div class="achieve-box hover-item ">
                <div class="box-img">
                    <img src="assets/img/normal/achieve_3.jpg" alt="Image">
                </div>
                <div class="box-year">2021</div>
                <div class="media-body">
                    <h3 class="box-title">Annual Awards</h3>
                    <p class="box-text">We understand that every patient is unique, and their healthcare needs may
                        vary. That's why we create individualized treatment.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Testimonial Area
==============================-->
<section class="space" id="testi-sec" data-bg-src="assets/img/bg/testi_bg_3.jpg">
    <div class="container">
        <h2 class="sec-title text-center">What Our Customers Says?</h2>
        <div class="swiper th-slider has-shadow" id="testiSlide1"
            data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testi-card">
                        <div class="box-review">
                            <i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i>
                        </div>
                        <div class="box-quote">
                            <img src="assets/img/icon/quote_1.svg" alt="Icon">
                        </div>
                        <p class="box-text">“Objectively deploy open-source web-readiness impactful bandwidth.
                            Compellingly coordinate business deliverables rather equity invested technologies.
                            Phosfluorescently reinvent maintainable.”</p>
                        <div class="box-profile">
                            <div class="box-img">
                                <img src="assets/img/testimonial/testi_1_1.jpg" alt="Avater">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">Pelican Steve</h3>
                                <span class="box-desig">Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testi-card">
                        <div class="box-review">
                            <i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i>
                        </div>
                        <div class="box-quote">
                            <img src="assets/img/icon/quote_1.svg" alt="Icon">
                        </div>
                        <p class="box-text">“Objectively deploy open-source web-readiness impactful bandwidth.
                            Compellingly coordinate business deliverables rather equity invested technologies.
                            Phosfluorescently reinvent maintainable.”</p>
                        <div class="box-profile">
                            <div class="box-img">
                                <img src="assets/img/testimonial/testi_1_2.jpg" alt="Avater">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">Alexa Milton</h3>
                                <span class="box-desig">Physiotherapist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testi-card">
                        <div class="box-review">
                            <i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i>
                        </div>
                        <div class="box-quote">
                            <img src="assets/img/icon/quote_1.svg" alt="Icon">
                        </div>
                        <p class="box-text">“Objectively deploy open-source web-readiness impactful bandwidth.
                            Compellingly coordinate business deliverables rather equity invested technologies.
                            Phosfluorescently reinvent maintainable.”</p>
                        <div class="box-profile">
                            <div class="box-img">
                                <img src="assets/img/testimonial/testi_1_1.jpg" alt="Avater">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">Pelican Steve</h3>
                                <span class="box-desig">Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testi-card">
                        <div class="box-review">
                            <i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i>
                        </div>
                        <div class="box-quote">
                            <img src="assets/img/icon/quote_1.svg" alt="Icon">
                        </div>
                        <p class="box-text">“Objectively deploy open-source web-readiness impactful bandwidth.
                            Compellingly coordinate business deliverables rather equity invested technologies.
                            Phosfluorescently reinvent maintainable.”</p>
                        <div class="box-profile">
                            <div class="box-img">
                                <img src="assets/img/testimonial/testi_1_2.jpg" alt="Avater">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">Alexa Milton</h3>
                                <span class="box-desig">Physiotherapist</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-pagination"></div>
        </div>
    </div>
</section>


@endsection