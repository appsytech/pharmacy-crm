@props([
    'type' => 'button',
    'label',
    'svgUrl' => null,
])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'cursor-pointer text-sm text-gray-600 hover:text-gray-700 font-medium flex items-center gap-1.5 px-3 py-2 hover:bg-gray-200 rounded-lg transition-colors']) }}>
    @isset($svgUrl)
        <img src="{{ $svgUrl }}" class="w-4 h-4 pointer-events-none" alt="">
    @endisset

    {{ $label }}
</button>
