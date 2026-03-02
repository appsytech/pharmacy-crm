@props([
'service'
])



<div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="service-card" data-bg-src="{{ asset('assets/img/service/service_card_1.jpg') }}">
        <div class="box-shape">
            <img src="{{ asset('assets/img/bg/service_card_bg.png') }}" alt="Service">
        </div>
        <div class="box-icon">
            <img src="{{ asset('storage/' . $service->icon) }}" alt="Icon">
        </div>
        <h3 class="box-title"><a href="{{ route('web.service.show', encrypt($service->id)) }}">{{ $service->title ?? '' }}</a></h3>
        <p class="box-text">
            {{ \Illuminate\Support\Str::words($service->description ?? '', 5, '...') }}
        </p>
        <a href="{{ route('web.service.show', encrypt($service->id)) }}" class="th-btn btn-sm style2 theme-color">Read More</a>
    </div>
</div>