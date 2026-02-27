<section class="space" id="blog-sec" data-bg-src="{{ asset('assets/img/bg/blog_bg_1.jpg') }}">
    <div class="container">
        <div class="row justify-content-lg-between justify-content-center align-items-center">
            <div class="col-lg">
                <div class="title-area text-center text-lg-start">
                    <span class="sub-title">
                        <img src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="shape">
                        Our Blog
                    </span>
                    <h2 class="sec-title">Our Latest News & Blogs</h2>
                </div>
            </div>
            <div class="col-lg-auto d-none d-lg-block">
                <div class="sec-btn">
                    <a href="blog.html" class="th-btn style4">View All Post</a>
                </div>
            </div>
        </div>
        <div class="slider-area">
            <div class="swiper th-slider has-shadow" id="blogSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'>
                <div class="swiper-wrapper">

                    <x-web.sections.blog.partials.slide />
                    <x-web.sections.blog.partials.slide />
                    <x-web.sections.blog.partials.slide />
                    <x-web.sections.blog.partials.slide />

                </div>
            </div>
            <button data-slider-prev="#blogSlider1" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>
            <button data-slider-next="#blogSlider1" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>
        </div>
    </div>
</section>