@props([
'columns',
'fields' => null,
])


@php
$statusMap = [
1 => [
'text' => 'Active',
'dot' => 'bg-green-500',
'bg' => 'bg-green-100',
'textColor' => 'text-green-700'
],
0 => [
'text' => 'Inactive',
'dot' => 'bg-red-500',
'bg' => 'bg-red-100',
'textColor' => 'text-red-700'
],
'ONLEAVE' => [
'text' => 'On Leave',
'dot' => 'bg-yellow-500',
'bg' => 'bg-yellow-100',
'textColor' => 'text-yellow-700'
],
];
@endphp

<div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                @foreach ($columns ?? [] as $column)
                <th
                    class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    {{ $column['label'] ?? '' }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>

            @forelse($fields ?? [] as $field)
            {{-- ===== row ==== --}}
            <tr class="border-b border-gray-100 hover:bg-gray-50">
                <td class="px-5 py-3 text-sm text-gray-400">{{ $field['sn'] }}</td>
                <td class="px-5 py-3">
                    <div class="flex items-center gap-2">
                        @isset($field['svgUrl'])
                        <img src="{{ $field['svgUrl'] }}" class="w-4 h-4">
                        @endisset
                        <span class="text-sm font-medium text-gray-600">{{ $field['label'] ?? '' }}</span>
                    </div>
                </td>

                <td class="px-5 py-3 text-sm text-gray-700 font-medium">
                    @if(($field['type'] ?? null) === 'badge')

                    @php
                    $status = $statusMap[$field['value']] ?? null;
                    @endphp

                    @if($status)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $status['bg'] }} {{ $status['textColor'] }}">

                        <span class="w-1.5 h-1.5 {{ $status['dot'] }} rounded-full"></span>

                        {{ $status['text'] }}
                    </span>
                    @else
                    --
                    @endif

                    @else
                    {{ $field['value'] ?? '--' }}
                    @endif
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>