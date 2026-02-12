@php
$value = data_get($row, $column['key']);
$statusMap = [

// Boolean Support
0 => [
'label' => 'Inactive',
'bg' => 'bg-red-100',
'text' => 'text-red-800',
'dot' => 'bg-red-600',
],
1 => [
'label' => 'Active',
'bg' => 'bg-green-100',
'text' => 'text-green-800',
'dot' => 'bg-green-600',
],

// STATUS ENUM
'ACTIVE' => [
'label' => 'Active',
'bg' => 'bg-green-100',
'text' => 'text-green-800',
'dot' => 'bg-green-600',
],
'INACTIVE' => [
'label' => 'Inactive',
'bg' => 'bg-red-100',
'text' => 'text-red-800',
'dot' => 'bg-red-600',
],
'SUSPENDED' => [
'label' => 'Suspended',
'bg' => 'bg-orange-100',
'text' => 'text-orange-800',
'dot' => 'bg-orange-600',
],
'BLOCKED' => [
'label' => 'Blocked',
'bg' => 'bg-red-200',
'text' => 'text-red-900',
'dot' => 'bg-red-700',
],

// TREATMENT STATUS ENUM
'NOT-STARTED' => [
'label' => 'Not Started',
'bg' => 'bg-gray-100',
'text' => 'text-gray-800',
'dot' => 'bg-gray-600',
],
'ONGOING' => [
'label' => 'Ongoing',
'bg' => 'bg-blue-100',
'text' => 'text-blue-800',
'dot' => 'bg-blue-600',
],
'COMPLETED' => [
'label' => 'Completed',
'bg' => 'bg-green-100',
'text' => 'text-green-800',
'dot' => 'bg-green-600',
],
'DISCOUNTED' => [
'label' => 'Discounted',
'bg' => 'bg-purple-100',
'text' => 'text-purple-800',
'dot' => 'bg-purple-600',
],

// Extra if you still need ONLEAVE
'ONLEAVE' => [
'label' => 'On Leave',
'bg' => 'bg-yellow-100',
'text' => 'text-yellow-800',
'dot' => 'bg-yellow-600',
],
];

$badge = $statusMap[$value] ?? [
'label' => is_string($value)
? ucwords(str_replace('-', ' ', strtolower($value)))
: $value,
'bg' => 'bg-gray-100',
'text' => 'text-gray-800',
'dot' => 'bg-gray-600',
];

@endphp

<span
    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $badge['bg'] }} {{ $badge['text'] }}">
    <span class="h-1.5 w-1.5 rounded-full mr-2 {{ $badge['dot'] }}"></span>
    {{ $badge['label'] }}
</span>