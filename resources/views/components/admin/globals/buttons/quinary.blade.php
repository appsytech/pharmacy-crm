@props([
'type' => 'button',
'label',
'svgUrl' => null,
'url' => null
])

@if($type == 'url')
<a href="{{ $url ?? '#' }}"
    {{ $attributes->merge([
        'class' =>
            'group cursor-pointer relative flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-300 hover:shadow-md hover:-translate-y-1 transition-all duration-200',
    ]) }}>
    @isset($svgUrl)
    <img src="{{ $svgUrl }}" class="w-4 h-4 pointer-events-none" alt="">
    @endisset
    <span class="pointer-events-none">{{ $label }}</span>
</a>
@else
<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
            'group cursor-pointer relative flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-300 hover:shadow-md hover:-translate-y-1 transition-all duration-200',
    ]) }}>
    @isset($svgUrl)
    <img src="{{ $svgUrl }}" class="w-4 h-4 pointer-events-none" alt="">
    @endisset
    <span class="pointer-events-none">{{ $label }}</span>
</button>
@endif