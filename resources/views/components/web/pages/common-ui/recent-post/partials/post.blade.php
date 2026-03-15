@props([
'recent',
'detailRouteName',

])

<div class="recent-post">
    <div class="media-img">
        <a href="{{ route($detailRouteName, encrypt($recent->id)) }}">
            @if(isset($recent->images))
            <img src="{{ asset('storage/' . $recent->images) }}" alt="Blog Image">
            @else
            <img src="{{ asset('assets/img/blog/recent-post-1-1.jpg') }}" alt="Blog Image">
            @endif
        </a>
    </div>
    <div class="media-body">
        <h4 class="post-title">
            <a class="text-inherit" href="{{ route($detailRouteName, encrypt($recent->id)) }}">{{ $recent->title ?? '' }}</a>
        </h4>
        <div class="recent-post-meta">
            <a href="{{ route($detailRouteName, encrypt($recent->id)) }}">
                <i class="fal fa-calendar"></i>{{ $recent->created_at ?? '' }}</a>
        </div>
    </div>
</div>