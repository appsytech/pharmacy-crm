 @props([
     'type' => 'button',
     'svgUrl',
 ])

 <button type="{{ $type }}"
     {{ $attributes->merge(['class' => 'h-10 cursor-pointer flex items-center justify-center rounded-full  text-gray-400 hover:text-black transition-all duration-200']) }}>
     <img src="{{ $svgUrl }}" class="w-5 h-5 pointer-events-none" alt="">
 </button>
