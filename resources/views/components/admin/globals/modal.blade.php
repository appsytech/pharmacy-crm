 @props([
 'id' => null,
 'actionType' => 'add' //add or edit
 ])

 @if($actionType == 'add')
 <div>
     <div id="{{ $id }}"
         class="hidden fixed top-0 left-0 right-0 z-99 px-4 pt-8 overflow-y-auto h-screen flex  items-center justify-center">
         <div
             class="w-[95%] lg:w-[30%] flex flex-col max-h-[90%] mx-auto bg-white rounded-3xl shadow-lg overflow-hidden">

             <!-- ============ Modal Header =========== -->
             <div class="p-5 border-b border-gray-100 h-[10%]">
                 <div class="flex items-center justify-between">
                     @isset($header)
                     {{ $header }}
                     @endisset
                 </div>
             </div>

             <!-- ======== Modal Body ======== -->
             <div class="px-8 py-6 overflow-y-auto h-[90%]">
                 {{ $body }}
             </div>
         </div>
     </div>
 </div>


 @else
 <div>
     <div class="w-full lg:w-1/2 flex flex-col max-h-[90%] mx-auto bg-white rounded-3xl shadow-lg overflow-hidden">
         <!-- ======== Modal Body ======== -->
         <div class="px-8 py-6 overflow-y-auto h-[90%]">
             {{ $body }}
         </div>
     </div>
 </div>

 @endif