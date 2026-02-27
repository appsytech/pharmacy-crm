<section class="bg-top-center space-top" id="team-sec" data-bg-src="{{ asset('assets/img/bg/team_bg_1.jpg') }}">
    <div class="container z-index-common">
        <div class="title-area text-center">
            <span class="sub-title">
                <img src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="Icon">
                Expert doctors
            </span>
            <h2 class="sec-title">Meet our professional Doctors</h2>
        </div>
        <div class="swiper th-slider has-shadow" id="teamSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'>
            <div class="swiper-wrapper">
                <x-web.sections.team.partials.slide />
                <x-web.sections.team.partials.slide />
                <x-web.sections.team.partials.slide />
                <x-web.sections.team.partials.slide />
                <x-web.sections.team.partials.slide />
            </div>
        </div>
    </div>
</section>