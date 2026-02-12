@php
use Illuminate\Support\Str;
@endphp

@props([
'type' => 'text', // text, email, password, number, date, select
'name',
'label' => null,
'placeholder' => '',
'value' => null,
'leftIcon' => null,
'required' => false,
'id' => null,
'options' => [], // for select type
])

@php
$id = $id ?? Str::uuid();
$baseClasses = 'w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent';
@endphp

<div>
    @if ($label)
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-900 mb-2">
        {{ $label }}
    </label>
    @endif

    <div class="relative">

        {{-- Left Icon --}}
        @isset($leftIcon)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <img src="{{ $leftIcon }}" class="w-5 h-5 pointer-events-none">
        </div>
        @endisset

        {{-- Field Rendering --}}
        @if ($type === 'select')

        <select
            name="{{ $name }}"
            id="{{ $id }}"
            @if ($required) required @endif
            {{ $attributes->merge(['class' => $baseClasses]) }}>
            {{ $slot ?? '' }}
        </select>

        @else

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            @if ($required) required @endif
            {{ $attributes->merge(['class' => $baseClasses]) }}>

        @endif

        {{-- Right Button --}}
        @isset($right_button)
        {{ $right_button }}
        @endisset

    </div>
</div>