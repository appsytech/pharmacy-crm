@php
use Illuminate\Support\Str;
@endphp

@props([
'id' => null,
'method' => 'GET',
'action' => '#',
])

@php
$id = $id ?? Str::uuid()->toString();
@endphp


<form id="{{ $id }}" action="{{ $action }}" method="{{ $method }}"
    {{ $attributes->merge([
        'class' => 'space-y-5',
    ]) }}>

    @if ($method == 'POST')
    @csrf
    @endif

    {{ $fields }}

    <!--======== Action Button ===========-->
    {{ $action_button }}

</form>