@props([
'testimonials' => collect([])
])

<section class="space" id="testi-sec" data-bg-src="assets/img/bg/testi_bg_3.jpg">
    <div class="container">
        <h2 class="sec-title text-center">What Our Customers Says?</h2>
        <div class="swiper th-slider has-shadow" id="testiSlide1"
            data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}}'>
            <div class="swiper-wrapper">
                @if($testimonials->isNotEmpty())
                @foreach($testimonials as $testimonial)
                <x-web.pages.sections.testimonial.partials.slide :testimonial="$testimonial" />
                @endforeach
                @endif


            </div>
            <div class="slider-pagination"></div>
        </div>
    </div>
</section>