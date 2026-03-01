@props([
'processes' => Collect([])
])

<section class="space" data-bg-src="{{ asset('assets/img/bg/process_bg_1.jpg') }}">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title">
                <img src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="Icon">
                Work Process
            </span>
            <h2 class="sec-title">Let’s See How We Work Process</h2>
        </div>
        <div class="process-card-wrap">
            @if($processes->isNotEmpty())
            @foreach($processes as $process)
            <x-web.sections.process.partials.card :process="$process" :imgUrl="asset('assets/img/normal/process_card_1.jpg')" boxNumber="1" title="Check-Ups" description="Once the patient is checked in, healthcare professional conduct a thorough evaluation." />
            @endforeach
            @endif
        </div>
    </div>
</section>