@props([
'activity'
])


@php
use Carbon\Carbon;
@endphp

<div class="swiper-slide">
    <div class="blog-card">
        <div class="blog-img">
            @isset($activity->images)
            <img src="{{ asset('storage/' . $activity->images) }}" alt="blog image">
            @endisset
        </div>
        <div class="blog-content">
            <div class="blog-meta">
                <!-- <a href="{{ route('web.activity.index') }}"><i class="fal fa-user"></i>By Tat</a> -->
                <a href="{{ route('web.activity.index') }}"><i class="fal fa-calendar"></i>
                    {{ Carbon::parse($activity->created_at)->format('d F, Y') }}
                </a>
            </div>
            <h3 class="box-title">
                <a href="{{ route('web.activity.show', encrypt($activity->id)) }}">{{ $activity->title ?? '' }}</a>
            </h3>
            <a href="{{ route('web.activity.show', encrypt($activity->id)) }}" class="th-btn btn-sm">Read More</a>
        </div>
    </div>
</div>