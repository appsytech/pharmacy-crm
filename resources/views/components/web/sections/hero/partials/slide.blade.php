@props([
'subtitle' => null,
'title',
'heading',
'description',
'imageUrl'
])

<div class="swiper-slide">
    <div class="hero-inner">
        <div class="container">
            <div class="hero-style1">
                <span class="hero-subtitle" data-ani="slideinup" data-ani-delay="0.2s">
                    {{ $subtitle ?? '' }}
                </span>
                <h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.3s">
                    {{ $title ?? '' }}

                </h1>
                <h2 class="hero-heading" data-ani="slideinup" data-ani-delay="0.4s">
                    {{ $heading ?? '' }}
                </h2>
                <p class="hero-text" data-ani="slideinup" data-ani-delay="0.5s">
                    {{ $description ?? '' }}
                </p>

                <a href="{{ route('web.appointment.index') }}" class="th-btn style2" data-ani="slideinup" data-ani-delay="0.6s" id="showAppointmentBtn">
                    <i class="fas fa-user-md me-2"></i>
                    Book Appointment
                </a>
            </div>

        </div>
        <div class="hero-img" data-ani="slideinright" data-ani-delay="0.5s">
            <img src="{{ $imageUrl ?? '' }}" alt="Image">
        </div>
    </div>
</div>