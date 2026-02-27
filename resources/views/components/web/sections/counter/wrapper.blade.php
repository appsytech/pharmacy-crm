@props([
'bgTheme' => null, // bgtheme2, bgtheme3 etc
])

<div class="z-index-common" data-pos-for="#team-sec" data-sec-pos="bottom-half">
    <div class="container">
        <div class="counter-card-wrap {{ $bgTheme ?? '' }}">

            <x-web.sections.counter.partials.card value="236" label="Professional Doctors" />
            <x-web.sections.counter.partials.card value="236" label="Professional Doctors" />
            <x-web.sections.counter.partials.card value="236" label="Professional Doctors" />
            <x-web.sections.counter.partials.card value="236" label="Professional Doctors" />

        </div>
    </div>
</div>