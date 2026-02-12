 @php
 use Illuminate\Support\Str;
 @endphp

 @props([
 'type' => 'text',
 'label' => null,
 'svgUrl' => null,
 'name',
 'id' => null,
 'value' => null,
 'accept' => null,
 'placeholder' => null,
 'preview' => true,
 ])

 @php
 $id = $id ?? $name . '-' . Str::uuid();
 $previewId = $preview ? $id . '-preview' : null;
 @endphp


 @if($type == 'file' || $type == 'textarea')
 <div class="lg:col-span-2">
     @else
     <div>
         @endif

         <label for="{{ $id }}" class="text-xs font-semibold text-gray-700 mb-2 flex items-center gap-1.5">
             @isset($svgUrl)
             <img src="{{ $svgUrl }}" class="w-3.5 h-3.5 pointer-events-none" alt="">
             @endisset
             {{ $label }}
         </label>
         <div class="relative">
             @if ($type === 'file')
             <input
                 type="file"
                 id="{{ $id }}"
                 name="{{ $name }}"
                 accept="{{ $accept }}"
                 data-previewSectionId="{{ $previewId }}"
                 {{ $attributes->merge([
                  'class' => 'hidden'
                  ]) }}>

             <label
                 for="{{ $id }}"
                 class="flex items-center justify-center w-full px-4 py-2.5 text-sm text-gray-700 bg-white border-2 border-gray-200 rounded-lg cursor-pointer transition-all shadow-sm hover:shadow-md hover:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500">
                 <img src="{{ asset('assets/svg/upload-cloud.svg') }}" class="w-5 h-5 mr-2" alt="">
                 <span class="font-medium">Click to upload image</span>
                 <span class="text-gray-400 ml-1">(PNG, JPG, GIF)</span>
             </label>

             {{-- SELECT --}}
             @elseif ($type === 'select')
             <select id="{{ $id }}" name="{{ $name }}"
                 {{ $attributes->merge([
                     'class' =>
                         'w-full px-4 py-2.5 text-sm text-gray-700 bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm hover:shadow-md appearance-none cursor-pointer',
                 ]) }}>
                 {{ $slot }}
             </select>
             <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                 <img src="{{ asset('assets/svg/cheveron-down.svg') }}" class="w-4 h-4 pointer-events-none"
                     alt="">
             </div>
             @elseif($type == 'textarea')
             <textarea id="{{ $id }}" placeholder="{{ $placeholder }}" name="{{ $name }}" {{ $attributes->merge([
               'class' =>   'w-full px-4 py-2.5 text-sm text-gray-700 bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm hover:shadow-md placeholder-gray-400'
             ]) }}>{{ $value ?? '' }}</textarea>

             @else
             <input id="{{ $id }}" placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value ?? '' }}"
                 type="{{ $type }}"
                 {{ $attributes->merge([
                     'class' =>
                         'w-full px-4 py-2.5 text-sm text-gray-700 bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm hover:shadow-md placeholder-gray-400',
                 ]) }}>
             @endif
         </div>
     </div>


     {{-- PREVIEW CONTAINER --}}
     @if ($preview)
     <div id="{{ $previewId }}" class="{{ isset($file_preview) ? '' : 'hidden' }} lg:col-span-2 mt-3">
         {{ $file_preview ?? '' }}
     </div>
     @endif