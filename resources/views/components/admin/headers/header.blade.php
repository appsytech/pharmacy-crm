 <!--====================== Header ================================-->
 <header class="h-20 border-b border-gray-200 px-4 md:px-8 grid grid-cols-2 shadow-sm shrink-0">
     <x-admin.headers.sidebar-toggle />
     <div class="col-span-1 flex items-center justify-end gap-2 md:gap-4 ml-4 md:ml-6">
         <x-admin.headers.icon-button type="link" :url="route('profile.index')" :svgUrl="asset('assets/svg/user.svg')" />
         <x-admin.headers.user-dropdown />
     </div>
 </header>