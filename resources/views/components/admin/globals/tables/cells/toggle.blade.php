
 @php
 $idKey = $column['idKey'] ?? 'id';

 $targetId = data_get($row, $idKey);
 $status = (bool) data_get($row, $column['key']);
 $route = route($column['route']);
 @endphp

 <label class="relative inline-flex items-center cursor-pointer">
     <input
         type="checkbox"
         class="sr-only peer status-toggle"
         data-targetUrl="{{ $route }}"
         data-targetId="{{ $targetId }}"
         data-csrf="{{ csrf_token() }}"
         {{ $status ? 'checked' : '' }}>

     <div
         class="w-11 h-6 bg-red-200 rounded-full
               peer-focus:outline-none
               peer-checked:bg-green-600
               after:content-['']
               after:absolute
               after:top-0.5
               after:left-0.5
               after:bg-white
               after:h-5
               after:w-5
               after:rounded-full
               after:transition-all
               peer-checked:after:translate-x-full">
     </div>
 </label>