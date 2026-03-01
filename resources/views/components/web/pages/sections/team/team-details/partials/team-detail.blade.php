@props([
'team'
])

<div class="about-box mb-40">
    <div class="box-img">
        @isset($team->profile_image)
        <img src="{{ asset('storage/' . $team->profile_image) }}" alt="team image">
        @endisset
    </div>
    <div class="box-content">
        <h3 class="box-title">{{ $team->full_name ?? '' }}</h3>
        <p class="box-desig">{{ $team->speciality ?? '' }}</p>
        <p class="box-text">{{ $team->position ?? '' }}</p>
    </div>
</div>