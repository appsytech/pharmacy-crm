@props([
'team'
])

<section class="space">
    <div class="container">
        <div class="row gy-40">
            <div class="col-xl-4 position-relative">
                <div class="team-sticky">

                    <x-web.pages.sections.team.team-details.partials.team-detail :team="$team" />
                    <x-web.pages.sections.team.team-details.partials.team-info :team="$team" />

                </div>
            </div>
            <div class="col-xl-8">
                <div class="team-details">
                    {{ $team->description ?? '' }}

                    <x-web.pages.sections.team.team-details.partials.team-contact />
                </div>
            </div>
        </div>
    </div>
</section>