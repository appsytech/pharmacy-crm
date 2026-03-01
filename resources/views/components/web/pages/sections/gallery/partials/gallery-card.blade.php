@props([
'image'
])

<div class="filter-item col-xl-auto col-md-6">
    <div class="gallery-card style2">
        <div class="box-img">
            @isset($image->images)
            <img src="{{ asset('storage/' . $image->images) }}" alt="gallery image">
            @endisset
            <div class="shape">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
        <div class="box-content">

            @if(isset($image->big_image))
            <a href="{{ asset('storage/' . $image->big_image) }}" class="icon-btn style2 popup-image">
                <i class="far fa-eye"></i>
            </a>

            @elseif($image->images)
            <a href="{{ asset('storage/' . $image->images) }}" class="icon-btn style2 popup-image">
                <i class="far fa-eye"></i>
            </a>
            @endif
            <h3 class="box-title">Dental Cleaning</h3>
            <p class="box-text">Thorough dental checkups, prioritize health over aesthetics.</p>
        </div>
    </div>
</div>