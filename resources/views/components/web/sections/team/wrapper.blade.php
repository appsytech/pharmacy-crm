@props([
'teams' => collect([]),
'bgImgUrl' => null,
])

<section {{ $attributes->class([
    'bg-top-center space-top'
    ])->merge() }}
    id="team-sec" @if(!empty($bgImgUrl)) data-bg-src="{{ $bgImgUrl }}" @endif>
    <div class="container z-index-common">
        <div class="title-area text-center">
            <span class="sub-title">
                <img src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="Icon">
                Expert teams
            </span>
            <h2 class="sec-title">Meet our professional Doctors</h2>
        </div>
        <div class="swiper th-slider has-shadow" id="teamSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'>
            <div class="swiper-wrapper">

                @if($teams->isNotEmpty())
                @foreach($teams as $team)
                <x-web.sections.team.partials.slide :team="$team" />
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>