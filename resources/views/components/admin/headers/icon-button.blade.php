 @props([
 'type' => 'link',
 ])

 @if ($type == 'link')
 <a href="{{ $url ?? '#' }}"
     {{ $attributes->merge([
             'class' => 'flex items-center justify-center gap-2 text-sm font-medium h-9 rounded-md px-3 cursor-pointer',
         ]) }}>
     <img src="{{ $svgUrl }}" class="w-4 h-4 mr-2 pointer-events-none">
 </a>
 @else
 <button type="{{ $type }}"
     {{ $attributes->merge([
             'class' => 'flex items-center justify-center gap-2 text-sm font-medium h-9 rounded-md px-3 cursor-pointer',
         ]) }}>
     <img src="{{ $svgUrl }}" class="w-4 h-4 mr-2 pointer-events-none">
 </button>
 @endif