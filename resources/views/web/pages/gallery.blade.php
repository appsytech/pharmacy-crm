@extends('web.layouts.main')

@section('content')

<!--==============================
Gallery Area
================================-->
<div class="space">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title4"><img src="assets/img/theme-img/title_icon.svg" alt="shape">Portfolio cases</span>
            <h2 class="sec-title">Our Smile Gallery</h2>
        </div>
        <div class="row gy-4 masonary-active gallery-row2">
            <div class="filter-item col-xl-auto col-md-6">
                <div class="gallery-card style2">
                    <div class="box-img">
                        <img src="assets/img/gallery/gallery_2_1.jpg" alt="gallery image">
                        <div class="shape">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <a href="assets/img/gallery/gallery_2_1.jpg" class="icon-btn style2 popup-image"><i class="far fa-eye"></i></a>
                        <h3 class="box-title">Dental Cleaning</h3>
                        <p class="box-text">Thorough dental checkups, prioritize health over aesthetics.</p>
                    </div>
                </div>
            </div>
            <div class="filter-item col-xl-auto col-md-6">
                <div class="gallery-card style2">
                    <div class="box-img">
                        <img src="assets/img/gallery/gallery_2_2.jpg" alt="gallery image">
                        <div class="shape">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <a href="assets/img/gallery/gallery_2_2.jpg" class="icon-btn style2 popup-image"><i class="far fa-eye"></i></a>
                        <h3 class="box-title">Dental Whitening</h3>
                        <p class="box-text">Thorough dental checkups, prioritize health over aesthetics.</p>
                    </div>
                </div>
            </div>
            <div class="filter-item col-xl-auto col-md-6">
                <div class="gallery-card style2">
                    <div class="box-img">
                        <img src="assets/img/gallery/gallery_2_3.jpg" alt="gallery image">
                        <div class="shape">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <a href="assets/img/gallery/gallery_2_3.jpg" class="icon-btn style2 popup-image"><i class="far fa-eye"></i></a>
                        <h3 class="box-title">Root Canal</h3>
                        <p class="box-text">Thorough dental checkups, prioritize health over aesthetics.</p>
                    </div>
                </div>
            </div>
            <div class="filter-item col-xl-auto col-md-6">
                <div class="gallery-card style2">
                    <div class="box-img">
                        <img src="assets/img/gallery/gallery_2_4.jpg" alt="gallery image">
                        <div class="shape">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <a href="assets/img/gallery/gallery_2_4.jpg" class="icon-btn style2 popup-image"><i class="far fa-eye"></i></a>
                        <h3 class="box-title">Dental Bracing</h3>
                        <p class="box-text">Thorough dental checkups, prioritize health over aesthetics.</p>
                    </div>
                </div>
            </div>
            <div class="filter-item col-xl-auto col-md-6">
                <div class="gallery-card style2">
                    <div class="box-img">
                        <img src="assets/img/gallery/gallery_2_5.jpg" alt="gallery image">
                        <div class="shape">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="box-content">
                        <a href="assets/img/gallery/gallery_2_5.jpg" class="icon-btn style2 popup-image"><i class="far fa-eye"></i></a>
                        <h3 class="box-title">Dental Filling</h3>
                        <p class="box-text">Thorough dental checkups, prioritize health over aesthetics.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--==============================
Feature Area
==============================-->
<div class="bg-smoke space" data-bg-src="assets/img/bg/pattern_bg_8.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="pe-xxl-5 mb-40 mb-xl-0">
                    <div class="comparison-dental">
                        <div class="comparison-img">
                            <div class="img background-img" data-bg-src="assets/img/normal/before_2.jpg"></div>
                            <div class="img foreground-img" data-bg-src="assets/img/normal/after_2.jpg"></div>
                            <input type="range" min="1" max="100" value="50" class="compslider" name="compslider" id="compslider">
                            <div class="slider-button" style="left: calc(50% - 28px);"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <form action="mail.php" method="POST" class="faq-form2">
                    <h4 class="box-title text-center">Make An Appointment</h4>
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                            <i class="fal fa-user"></i>
                        </div>
                        <div class="form-group col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="form-group col-12">
                            <input type="tel" class="form-control" name="number" id="number" placeholder="Phone Number">
                            <i class="fal fa-phone"></i>
                        </div>
                        <div class="form-group col-12">
                            <select name="subject" id="subject" class="form-select">
                                <option value="" disabled selected hidden>Select Subject</option>
                                <option value="Make Appointment">Make Appointment</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Medicine Help">Medicine Help</option>
                                <option value="Consultation">Consultation</option>
                            </select>
                            <i class="fal fa-chevron-down"></i>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="date-pick form-control" name="date" id="date-pick" placeholder="Date">
                            <i class="fal fa-calendar"></i>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="time-pick form-control" name="time" id="time-pick" placeholder="Time">
                            <i class="fal fa-clock"></i>
                        </div>
                        <div class="form-btn col-12">
                            <button class="th-btn btn-fw">BOOK AN APPOINTMENT</button>
                        </div>
                    </div>
                    <p class="form-messages mb-0 mt-3"></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!--==============================
Team Area
==============================-->
<section class="space">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md">
                <div class="title-area text-center text-md-start">
                    <span class="sub-title4"><img src="assets/img/theme-img/title_icon.svg" alt="shape">Our Experience Team</span>
                    <h2 class="sec-title">Meet Our Dentists</h2>
                </div>
            </div>
            <div class="col-md-auto">
                <div class="sec-btn">
                    <a href="team.html" class="th-btn style4">View More Dentists</a>
                </div>
            </div>
        </div>
        <div class="slider-area">
            <div class="swiper th-slider has-shadow" id="teamSlider4" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'>
                <div class="swiper-wrapper">
                    <!-- Single Item -->
                    <div class="swiper-slide">
                        <div class="th-team team-block style2">
                            <div class="box-img">
                                <img src="assets/img/team/team_4_1.jpg" alt="Team">
                            </div>
                            <div class="team-social">
                                <div class="social-links">
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                                <button class="icon-btn"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title"><a href="team-details.html">Dr. Sarah Perry</a></h3>
                                <p class="box-text">Child Specialist</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="swiper-slide">
                        <div class="th-team team-block style2">
                            <div class="box-img">
                                <img src="assets/img/team/team_4_2.jpg" alt="Team">
                            </div>
                            <div class="team-social">
                                <div class="social-links">
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                                <button class="icon-btn"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title"><a href="team-details.html">Dr. Michel Dosen</a></h3>
                                <p class="box-text">Senior Phisician</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="swiper-slide">
                        <div class="th-team team-block style2">
                            <div class="box-img">
                                <img src="assets/img/team/team_4_3.jpg" alt="Team">
                            </div>
                            <div class="team-social">
                                <div class="social-links">
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                                <button class="icon-btn"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title"><a href="team-details.html">Dr. Dominic Foste</a></h3>
                                <p class="box-text">Senior Medicine</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="swiper-slide">
                        <div class="th-team team-block style2">
                            <div class="box-img">
                                <img src="assets/img/team/team_4_1.jpg" alt="Team">
                            </div>
                            <div class="team-social">
                                <div class="social-links">
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                                <button class="icon-btn"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title"><a href="team-details.html">Dr. Sarah Perry</a></h3>
                                <p class="box-text">Child Specialist</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="swiper-slide">
                        <div class="th-team team-block style2">
                            <div class="box-img">
                                <img src="assets/img/team/team_4_2.jpg" alt="Team">
                            </div>
                            <div class="team-social">
                                <div class="social-links">
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                                <button class="icon-btn"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title"><a href="team-details.html">Dr. Michel Dosen</a></h3>
                                <p class="box-text">Senior Phisician</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="swiper-slide">
                        <div class="th-team team-block style2">
                            <div class="box-img">
                                <img src="assets/img/team/team_4_3.jpg" alt="Team">
                            </div>
                            <div class="team-social">
                                <div class="social-links">
                                    <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                                <button class="icon-btn"><i class="fas fa-link"></i></button>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title"><a href="team-details.html">Dr. Dominic Foste</a></h3>
                                <p class="box-text">Senior Medicine</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <button data-slider-prev="#teamSlider4" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>
            <button data-slider-next="#teamSlider4" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>
        </div>
    </div>
</section>
@endsection