@props([
    'items' => [],
])

<div class="p-3 bg-gray-50">
    <nav class="text-sm text-gray-500">
        <ol class="list-reset flex">
            @foreach ($items as $index => $item)
                <li>
                    @if (isset($item['url']) && !($item['active'] ?? false))
                        <a href="{{ $item['url'] }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-gray-700 font-medium">{{ $item['label'] }}</span>
                    @endif
                </li>

                {{-- Separator --}}
                @if ($index < count($items) - 1)
                    <li><span class="mx-2">/</span></li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
