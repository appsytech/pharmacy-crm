@props([
'testimonial'
])

<div class="swiper-slide">
    <div class="testi-card">
        <div class="box-review">
            @php
            $rating = $testimonial->stars ?? 0;
            $maxStars = 5;
            @endphp

            @for ($i = 1; $i <= $maxStars; $i++)
                <i class="fa-sharp fa-solid fa-star {{ $i <= $rating ? '' : 'text-muted' }}"></i>
                @endfor
        </div>
        <div class="box-quote">
            <img src="{{ asset('assets/img/icon/quote_1.svg') }}" alt="Icon">
        </div>
        <p class="box-text">“
            {!! $testimonial->description !!}

            ”</p>
        <div class="box-profile">
            <div class="box-img">
                @isset($testimonial->image)
                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Avater">
                @endisset
            </div>
            <div class="box-content">
                <h3 class="box-title">{{ $testimonial->name ?? '' }}</h3>
                <span class="box-desig">{{ $testimonial->position ?? '' }}</span>
            </div>
        </div>
    </div>
</div>