 @props([
 'columns',
 'rows' => null,
 'filterFormAction' => null,
 'filterFormMethod' => 'GET',
 ])
 <div class="rounded-sm shadow-md border border-gray-200">

     <div class="border-b border-gray-200">
         @if (isset($filters) || isset($action_buttons))
         <!--=========== Filter Form ============-->
         <form method="{{ $filterFormMethod }}" action="{{ $filterFormAction }}" class="p-2 border-b border-gray-200">
             <div
                 class="grid grid-cols-4  gap-3 xl:gap-0 bg-linear-to-br from-gray-50 to-gray-100 rounded-xl p-3 border border-gray-200 shadow-sm">
                 @isset($filters)
                 <div
                     class="col-span-4 xl:col-span-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                     {{ $filters ?? '' }}
                 </div>
                 @endisset


                 <!--======== Action Buttons =========-->
                 @isset($action_buttons)
                 <div class="col-span-4 xl:col-span-1  flex items-end justify-end">
                     <div class="flex gap-2">
                         {{ $action_buttons }}
                     </div>
                 </div>
                 @endisset
             </div>
         </form>
         @endif

         <div class="overflow-auto">
             <table class="w-full caption-bottom text-sm ">
                 <thead>
                     <tr class="border-b border-gray-200 transition-colors ">
                         @foreach ($columns as $column)
                         <th class="h-12 px-4 text-left font-semibold">{{ $column['label'] }}</th>
                         @endforeach

                     </tr>
                 </thead>
                 <tbody>


                     @forelse ($rows ?? [] as $row)
                     <!--====== row 1===== -->
                     <tr class="border-b border-gray-200">
                         @foreach ($columns as $column)
                         <td class="p-4  space-x-2">
                             @php
                             $cellSlotName = 'cell' . $column['key'];
                             @endphp

                             {{-- named slots --}}
                             @if (isset(${$cellSlotName}))
                             {{ ${$cellSlotName}($row) }}
                             {{-- {{ ${$cellSlotName} }} --}}

                             {{-- typed columns --}}
                             @elseif (isset($column['type']))
                             @includeIf("components.admin.globals.tables.cells.{$column['type']}", [
                             'row' => $row,
                             'column' => $column,
                             ])
                             @elseif ($column['key'] == 'sn')
                             {{ ($rows->firstItem() ?? 1) + $loop->parent->index }}

                             {{-- default --}}
                             @else
                             {{ data_get($row, $column['key']) }}
                             @endif

                         </td>
                         @endforeach
                     </tr>
                     @empty
                     @endforelse


                 </tbody>
             </table>
         </div>

         <!--============= Pagination ==============-->
         {{ $rows?->links() }}
     </div>
 </div>