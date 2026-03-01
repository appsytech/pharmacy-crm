@props([
'teams' => collect([])
])

<section class="space">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title">
                <img src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="Icon">Expert doctors</span>
            <h2 class="sec-title">Meet our professional Doctors</h2>
        </div>
        <div class="row gy-40 justify-content-center">
            <!-- Single Item -->
            @if($teams->isNotEmpty())
            @foreach($teams as $team)
            <x-web.pages.sections.team.partials.card :team="$team" />
            @endforeach
            @endif
        </div>
    </div>
</section>