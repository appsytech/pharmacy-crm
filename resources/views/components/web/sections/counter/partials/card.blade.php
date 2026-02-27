@props([
'value',
'unit' => 'K',
'symbol' => '+',
'label',
])

<div class="counter-card">
    <h2 class="box-number">
        <span class="number">
            <span class="counter-number">
                {{ $value ?? '' }}
            </span>
            {{ $unit ?? '' }}
        </span>
        <span class="plus">{{ $symbol ?? '' }}</span>
    </h2>
    <p class="box-text">{{ $label ?? '' }}</p>
</div>

<div class="divider"></div>