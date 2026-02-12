@props([
    'type' => 'button',
    'label',
    'svgUrl' => null,
])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'cursor-pointer whitespace-nowrap text-white font-semibold flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-sm hover:shadow-md']) }}>
    @isset($svgUrl)
        <img src="{{ $svgUrl }}" class="w-4 h-4  pointer-events-none" alt="">
    @endisset
    {{ $label }}
</button>
