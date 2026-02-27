@props([
'bgImg' => null,
'sectionSubTitle' => null,
'sectionTitle' => null
])

<section class="overflow-hidden bg-smoke space" id="service-sec" {{ isset($bgImg) ? 'data-bg-src="assets/img/bg/service_bg_1.png"' : '' }}>
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
        <div class="mt-5 pt-2 space-extra-bottom">
            <p class="round-text">
                <span class="text">You Get Our 20+ More services...
                    <a href="{{ route('web.service.show') }}" class="line-btn">Explore All Services</a>
                </span>
            </p>
        </div>
    </div>
</section>