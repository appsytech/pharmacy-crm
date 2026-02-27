@props([
'bgImg' => null,
'sectionSubTitle' => null,
'sectionTitle' => null,
'paginate' => false
])

<section {{ $attributes->class(['overflow-hidden space'])->merge() }}  id="service-sec" {{ isset($bgImg) ? 'data-bg-src="assets/img/bg/service_bg_1.png"' : '' }}>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="title-area text-center">
                    <span class="sub-title">
                        <img src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="Icon">{{ $sectionSubTitle ?? '' }}</span>
                    <h2 class="sec-title">{{ $sectionTitle ?? '' }}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />
            <x-web.sections.service.partials.card />

        </div>

        @if($paginate)

        <div class="th-pagination text-center mt-5 mb-0">
            <ul>
                <li><a href="{{ route('web.blog.index') }}">1</a></li>
                <li><a href="{{ route('web.blog.index') }}">2</a></li>
                <li><a href="{{ route('web.blog.index') }}">3</a></li>
                <li><a href="{{ route('web.blog.index') }}"><i class="far fa-arrow-right"></i></a></li>
            </ul>
        </div>

        @else
        <div class="mt-5 pt-2 space-extra-bottom">
            <p class="round-text">
                <span class="text">You Get Our 20+ More services...
                    <a href="{{ route('web.service.show') }}" class="line-btn">Explore All Services</a>
                </span>
            </p>
        </div>
        @endif
    </div>
</section>