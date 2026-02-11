 <!--========== Home ===========-->
 <div>
     <a href="{{ $url ?? '#' }}"
         class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-[#EEF2FF] transition-colors {{  $isActive ? 'bg-blue-100 text-black' : 'text-gray-700' }}">
         @isset($svgUrl)
         <img src="{{ $svgUrl ?? '#' }}" class="h-5 w-5 pointer-events-none">
         @endisset
         <span class="sidebar-text">{{ $title  }}</span>
     </a>
 </div>