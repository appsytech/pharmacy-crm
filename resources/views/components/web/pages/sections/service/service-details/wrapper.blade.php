@props([
'service',
'relatedServices' => collect([])
])

<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-xxl-8 col-lg-8">
                <div class="page-single single-right mb-30">
                    <div class="page-img">
                        <img src="{{ asset('storage/' . $service->icon) }}" alt="Service Image">
                    </div>
                    <div class="page-content">
                        <h2 class="page-title">{{ $service->title ?? '' }}</h2>
                        <p class="">
                            {{ $service->description ?? ''}}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-lg-4">
                <x-web.pages.common-ui.side-category-widget.wrapper>
                    <x-slot>
                        <x-web.pages.common-ui.schedule-tab.wrapper />
                    </x-slot>
                </x-web.pages.common-ui.side-category-widget.wrapper>
            </div>
        </div>
    </div>
</section>