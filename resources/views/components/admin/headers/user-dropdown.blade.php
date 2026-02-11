 <div class="flex items-center  border-l border-gray-300  cursor-pointer">
     <div class="relative group flex items-center space-x-2 pl-4  h-12">

         @php
         $adminProfileImage = Auth::user()->profile_image;

         @endphp

         @if(isset($adminProfileImage))
         <img
             src="{{ asset('storage/' . $adminProfileImage) }}"
             alt="Profile" class="h-8 w-8 rounded-full object-cover">
         @endif

         <div class="hidden md:block">
             <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? '' }}</div>
             <div class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</div>
         </div>

         <div
             class="absolute right-4 top-7.75 z-50 mt-3 w-56 rounded-2xl bg-white/95 shadow-2xl border border-gray-200/50 hidden group-hover:block overflow-hidden">

             <div class="p-2">
                 <x-admin.headers.dropdown-item label="Profile" :url="route('profile.index')" :svgUrl="asset('assets/svg/user-white.svg')" />
                 <x-admin.headers.dropdown-item label="Settings" :url="route('profile.edit')" :svgUrl="asset('assets/svg/setting-white.svg')" />
             </div>

             <div class="h-px bg-linear-to-r from-transparent via-gray-300 to-transparent mx-4"></div>

             <div class="p-2">
                 <x-admin.headers.dropdown-item label="Logout" :url="route('logout')" httpMethod="POST" :svgUrl="asset('assets/svg/exit-red.svg')" />
             </div>
         </div>
     </div>

     <x-admin.globals.buttons.logout-button label="Logout" :svgUrl="asset('assets/svg/exit.svg')" />
 </div>