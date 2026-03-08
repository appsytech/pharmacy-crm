@props([
'images' => collect([])
])

<div class="space">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title4">
                <img src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="shape">Portfolio cases</span>
            <h2 class="sec-title">Our Smile Gallery</h2>
        </div>
        <div class="row gy-4 masonary-active gallery-row2">

            @if($images->isNotEmpty())
            @foreach($images as $image)
            <x-web.pages.sections.gallery.partials.gallery-card :image="$image" />
            @endforeach
            @endif


        </div>
    </div>
</div>