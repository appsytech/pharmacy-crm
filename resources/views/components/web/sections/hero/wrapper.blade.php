@props([
'sliders' => collect([])
])

<div class="th-hero-wrapper hero-1" id="hero" data-bg-src="{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}">
    <div class="swiper th-slider" id="heroSlide1" data-slider-options='{"effect":"fade","autoHeight":true}'>
        <div class="swiper-wrapper">

            @if($sliders->isNotEmpty())
            @foreach($sliders as $slider)
            <x-web.sections.hero.partials.slide :title="$slider->title ?? ''"
                subtitle="Not Present in Db"
                heading="Not Present in Db"
                :description="$slider->description ?? ''"
                :imageUrl="asset('storage/' . $slider->images)" />
            @endforeach
            @endif
        </div>
    </div>

    <div class="hero-thumb-wrap">
        <div class="hero-thumb" data-slider-tab="#heroSlide1">
            <div class="tab-btn active">
                <img src="{{ asset('assets/img/hero/hero_thumb_1_1.png') }}" alt="Image">
            </div>
            <div class="tab-btn">
                <img src="{{ asset('assets/img/hero/hero_thumb_1_2.png') }}" alt="Image">
            </div>
            <div class="tab-btn">
                <img src="{{ asset('assets/img/hero/hero_thumb_1_3.png') }}" alt="Image">
            </div>
        </div>
    </div>
    <!-- mobile start -->

    <!-- mobile end -->
    <div class="hero-appointment-wrap" id="appointmentForm">
        <div class="container">
            <form action="mail.php" method="POST" class="hero-appointment">
                <div class="row">
                    <div class="form-group col-lg-2 col-sm-6">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                        <i class="fal fa-user"></i>
                    </div>
                    <div class="form-group col-lg-2 col-sm-6">
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone no.">
                        <i class="fal fa-phone"></i>
                    </div>
                    <div class="form-group col-lg-2 col-sm-6">
                        <select name="subject" id="subject" class="form-select">
                            <option value="" disabled selected hidden>Select Doctor</option>
                            <option value="Dr. Sarah Perry">Dr. Sumit</option>
                            <option value="Dr. Michel Dosen">Dr. Amit</option>
                            <option value="Dr. Dominic Foste">Dr. Ravi</option>
                            <option value="Dr. Miles Anderson">Dr. Abhishek</option>
                            <option value="Dr. Lily Garcia">Dr. Komal</option>
                        </select>
                        <i class="fal fa-chevron-down"></i>
                    </div>
                    <div class="form-group col-lg-3 col-sm-6">
                        <input type="text" class="date-time-pick form-control" name="date-time" id="date-time-pick" placeholder="Date & Time">
                        <i class="fal fa-calendar-alt"></i>
                    </div>
                    <div class="form-btn col-lg-3 col-sm-6">
                        <button class="th-btn w-100 style3">Book Appointment</button>
                    </div>
                </div>
                <p class="form-messages mb-0 mt-3"></p>
            </form>
        </div>
    </div>
</div>