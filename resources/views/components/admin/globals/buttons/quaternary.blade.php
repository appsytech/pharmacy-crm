@props([
    'type' => 'button',
    'label',
    'svgUrl' => null,
])

<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
            'group cursor-pointer relative flex items-center gap-2 px-5 py-2.5 text-md font-medium text-white bg-blue-500 border border-gray-200 rounded-lg shadow-sm hover:bg-blue-700 hover:border-gray-300 hover:shadow-md hover:-translate-y-1  transition-all duration-200',
    ]) }}>

    @isset($svgUrl)
        <img src="{{ $svgUrl }}" class="w-3.5 h-3.5 pointer-events-none" alt="">
    @endisset

    <span class="pointer-events-none">{{ $label }}</span>
</button>
