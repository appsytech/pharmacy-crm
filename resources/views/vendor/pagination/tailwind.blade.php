@if ($paginator->hasPages())
<div class="rounded-xl p-3" aria-label="{{ __('Pagination Navigation') }}">
    <div class="flex items-center justify-between">
        <div class="text-sm text-gray-600 hidden md:flex gap-1">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
            <span class="font-semibold text-gray-900">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-semibold text-gray-900">{{ $paginator->lastItem() }}</span>
            @else
            <span class="font-semibold text-gray-900">{{ $paginator->count() }}</span>
            @endif
            {!! __('of') !!}
            <span class="font-semibold text-gray-900">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </div>

        <div class="flex items-center space-x-2">

            @if ($paginator->onFirstPage())
            <button type="button"
                class="group relative flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg  transition-all duration-200">
                <img src="{{ asset('assets/svg/cheveron-left.svg') }}" class="h-4 w-4 pointer-events-none"
                    alt="">
                <span>Previous</span>
            </button>
            @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="group relative cursor-pointer flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-300 hover:shadow-md transition-all duration-200">
                <img src="{{ asset('assets/svg/cheveron-left.svg') }}" class="h-4 w-4 pointer-events-none"
                    alt="">
                <span>Previous</span>
            </a>
            @endif

            @foreach ($elements as $element)
            @if (is_string($element))
            <span aria-disabled="true">
                <span
                    class="px-1 py-2 hidden md:flex font-medium text-gray-700 transition">{{ $element }}</span>
            </span>
            @endif

            @if (is_array($element))
            @foreach ($element as $page => $url)
            <a href="{{ $url }}"
                class="hidden xl:flex px-4 py-2 {{ $paginator->currentPage() == $page ? 'bg-linear-to-r from-blue-400 to-blue-600 text-white' : 'border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50' }}  rounded-lg text-sm font-medium transition-all duration-200">
                {{ $page }}
            </a>
            @endforeach
            @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="group cursor-pointer relative flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-300 hover:shadow-md transition-all duration-200">
                <span>Next</span>
                <img src="{{ asset('assets/svg/cheveron-right.svg') }}" class="h-4 w-4 pointer-events-none"
                    alt="">
            </a>
            @else
            <button type="button"
                class="group  relative flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg  transition-all duration-200">
                <span>Next</span>
                <img src="{{ asset('assets/svg/cheveron-right.svg') }}" class="h-4 w-4 pointer-events-none"
                    alt="">
            </button>
            @endif
        </div>
    </div>
</div>

@endif