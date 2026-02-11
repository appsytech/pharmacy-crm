 <div class="h-20 flex items-center justify-between px-6 border-b border-gray-200 flex-shrink-0">
     <a id="logo" href="#" class="flex items-center space-x-2  p-2">
         <div class="w-14 h-14 flex items-center justify-center">
             @isset($logoUrl)
             <img
                 src="{{ $logoUrl ?? '#' }}"
                 class="w-14 rounded-sm" />
             @endisset
         </div>
         <span class="text-xl font-bold text-[#344256]">{{ $name ?? 'Default' }}</span>
     </a>

     <button class="toggle-sidebar p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors mr-4">
         <img src="{{ asset('assets/svg/menu.svg') }} " class="min-w-6 min-h-6 pointer-events-none">
     </button>
 </div>