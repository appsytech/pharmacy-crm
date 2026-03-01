@props([
'team'
])

<div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="th-team team-card">
        <div class="box-img">
            @if($team->profile_image)
            <img src="{{ asset('storage/' . $team->profile_image) }}" alt="Team">
            @else
            <img src="{{ asset('assets/img/team/team_1_1.jpg') }}" alt="Team">
            @endif
            <div class="th-social">
                <a target="_blank" href="{{ $team->fb_profile ?? '' }}"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" href="{{ $team->linkedin_profile ?? '' }}"><i class="fab fa-linkedin-in"></i></a>
                <a target="_blank" href="{{ $team->twitter_profile ?? '' }}"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <h3 class="box-title"><a href="{{ route('web.team.show', encrypt($team->id)) }}">{{ $team->full_name ?? '' }}</a></h3>
        <span class="team-desig">{{ $team->speciality ?? '' }}</span>
    </div>
</div>