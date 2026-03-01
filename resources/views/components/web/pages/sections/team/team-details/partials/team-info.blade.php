@props([
'team'
])

<div class="about-box">
    <div class="box-content">
        <h3 class="box-title">Personal Information</h3>

        @isset($team->phone_number)
        <p class="box-link">
            <i class="icon-btn fas fa-phone"></i>
            <a href="tel:{{ $team->phone_number }}">{{ $team->phone_number }}</a>
        </p>
        @endisset

        @isset($team->email)
        <p class="box-link">
            <i class="icon-btn fas fa-envelope"></i>
            <a href="mailto:{{ $team->email }}">{{ $team->email }}</a>
        </p>
        @endisset

        @isset($team->location)
        <p class="box-link">
            <i class="icon-btn fas fa-location-dot"></i>
            {{ $team->location }}
        </p>
        @endisset

        @isset($team->experience)
        <p class="box-link">
            <i class="icon-btn fas fa-stethoscope"></i>
            {{ $team->experience }} + Years
        </p>
        @endisset

        <div class="th-social">
            <a href="{{ $team->fb_profile ?? '#' }}"><i class="fab fa-facebook-f"></i></a>
            <a href="{{ $team->linkedin_profile ?? '#' }}"><i class="fab fa-twitter"></i></a>
            <a href="{{ $team->twitter_profile ?? '#' }}"><i class="fab fa-linkedin-in"></i></a>
            <!-- <a href="https://www.whatsapp.com/"><i class="fab fa-whatsapp"></i></a> -->
        </div>
    </div>
</div>