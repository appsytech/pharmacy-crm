@props([
'faqs' => collect([])
])

<div class="overflow-hidden" id="faq-sec" data-bg-src="{{ asset('assets/img/bg/faq_bg_1.jpg') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 text-center text-xl-start align-self-center">
                <div class="pe-xl-4 space-top pt-xl-0 pb-40 pb-xl-0">
                    <div class="title-area text-center text-xl-start">
                        <span class="sub-title">
                            <img src="{{ asset('assets/img/theme-img/title_icon_2.svg') }}" alt="Icon">Faqs</span>
                        <h2 class="sec-title text-white">Frequently Asked Have <br> Any Question?</h2>
                    </div>
                    <div class="accordion" id="faqAccordion">

                        @if($faqs->isNotEmpty())
                        @foreach($faqs as $faq)
                        <x-web.sections.faq.partials.card :question="$faq->question ?? ''" answer="{!! $faq->answer !!}" />
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="ps-xxl-4">
                    <div class="faq-img1">
                        <img src="{{ asset('assets/img/normal/faq_1.png') }}" alt="faq">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>