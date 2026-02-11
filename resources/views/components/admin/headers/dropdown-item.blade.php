 @if($httpMethod == 'GET')
 <a href="{{ $url ?? '#' }}"
     class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-200 group/item">
     <div
         class="flex items-center justify-center w-9 h-9 rounded-lg bg-green-500 text-white group-hover/item:scale-110 transition-transform">
         <img src="{{ $svgUrl ?? '#' }}" class="w-5 h-5">
     </div>
     <span class="font-medium text-sm">{{ $label }}</span>
 </a>

 @elseif($httpMethod == 'POST')
 <form method="POST" action="{{ $url ?? '#' }}" class="p-2">
     @csrf
     <button type="submit"
         class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-linear-to-r hover:from-red-50 hover:to-pink-50 transition-all duration-200 group/item cursor-pointer">
         <div
             class="flex items-center justify-center w-9 h-9 pointer-events-none rounded-lg bg-linear-to-br from-red-100 to-red-200 text-red-600 group-hover/item:scale-110 transition-transform">
             <img src="{{ $svgUrl ?? '#'  }}" class="w-5 h-5 pointer-events-none">
         </div>
         <span class="font-semibold text-sm pointer-events-none">{{ $label }}</span>
     </button>
 </form>

 @endif