@php
$file = data_get($row, $column['key']);

$imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

$isImage = in_array($extension, $imageExtensions);
@endphp

@if ($file)
@if ($isImage)
<a href="{{ asset('storage/' . $file) }}" target="_blank">
    <img
        src="{{ asset('storage/' . $file) }}"
        alt="File"
        class="h-10 w-10 rounded object-cover">
</a>
@else
<a href="{{ asset('storage/' . $file)  }}" target="_blank" class="flex items-center gap-2">
    <img src="{{asset('assets/svg/file-text.svg') }}" class="h-6 w-6 text-gray-500" alt="">
    <!-- <span class="text-sm text-gray-600">
        {{ basename($file) }}
    </span> -->
</a>
@endif
@else
<span class="text-gray-400 text-sm">—</span>
@endif