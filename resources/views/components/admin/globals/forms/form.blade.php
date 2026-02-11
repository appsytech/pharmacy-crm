   @php
   use Illuminate\Support\Str;
   @endphp

   @props([
   'id' => null,
   'method' => 'GET',
   'action' => '#',
   ])

   @php
   $id = $id ?? Str::uuid()->toString();
   @endphp

   <form id="{{ $id }}" method="{{ $method }}" action="{{ $action ?? '#' }}" {{ $attributes->merge([
       'class' => '',
   ]) }}>

       @if ($method == 'POST')
       @csrf
       @endif

       {{ $extra_methods ?? '' }}

       @isset($fields)
       <div class="grid grid-cols-2 mb-5 gap-3">
           {{ $fields ?? '' }}
       </div>
       @endisset


       @isset($action_buttons)
       <!--=== Action Buttons ===-->
       <div class="flex gap-3 pt-2">
           {{ $action_buttons ?? '' }}
       </div>
       @endisset

       @isset($icon_button)
       {{ $icon_button  }}
       @endisset
   </form>