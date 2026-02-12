<form action="{{ $url ?? route('logout') }}" method="POST"
    class="p-4 border-t border-gray-200  transition-all duration-300 shrink-0">
    @csrf
    <button type="submit"
        class="w-full cursor-pointer flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-300 hover:shadow-md transition-all duration-200">
        @isset($svgUrl)
        <img src="{{ $svgUrl ?? '#' }}"
            class="w-4 h-4 shrink-0 text-gray-600  pointer-events-none">
        @endisset
        <span class="sidebar-text pointer-events-none">{{ $label }}</span>
    </button>
</form>