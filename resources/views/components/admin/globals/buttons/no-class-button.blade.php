@props([
    'type' => 'button',
    'svgUrl' => null,
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ $svgUrl ?? '#' }}" class="w-5 h-5 pointer-events-none toggle-password-icon">
</button>
