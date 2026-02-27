@props([
'bgImgUrl' => null,
'Label',
'items'
])

<div class="breadcumb-wrapper " data-bg-src="{{ $bgImgUrl ?? 'assets/img/bg/breadcumb-bg.jpg' }}">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">{{ $label }}</h1>
            <ul class="breadcumb-menu">
                @foreach ($items as $index => $item)
                @if (isset($item['url']) && !($item['active'] ?? false))
                <li>
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                </li>
                @else
                <li>{{ $item['label'] }}</li>
                @endif
                @endforeach

            </ul>
        </div>
    </div>
</div>