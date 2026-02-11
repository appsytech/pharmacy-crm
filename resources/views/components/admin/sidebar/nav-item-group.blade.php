 @php

     use Illuminate\Support\Str;

     $uniqueId = Str::uuid();
 @endphp
 <!--========== Medicine Submenu ===========-->
 <div>
     <button id="{{ $uniqueId }}"
         class="has-submenu w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-[#EEF2FF] transition-all {{ $isActive ? 'bg-blue-100 text-black' : 'text-gray-700' }}">
         <div class="flex items-center gap-3 pointer-events-none">
             @isset($svgUrl)
                 <img src="{{ $svgUrl ?? '#' }}" class="w-5 h-5 pointer-events-none ">
             @endisset

             <span class="sidebar-text pointer-events-none">{{ $title }}</span>
         </div>

         <img id="{{ $uniqueId }}-icon" src="{{ asset('assets/svg/cheveron-right.svg') }}"
             class="sidebar-submenu-icon w-4 h-4 transition-transform duration-200 sidebar-text pointer-events-none {{ $isActive ? 'rotate-90' : '' }}">
     </button>

     <div id="{{ $uniqueId }}-submenu" class="{{ $isActive ? '' : 'hidden' }} mt-1 ml-11 space-y-1 sidebar-submenu">
         {{ $slot }}
     </div>
 </div>
