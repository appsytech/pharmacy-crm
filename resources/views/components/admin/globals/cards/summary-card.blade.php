@props([
    'label', // e.g. "Total Doctors"
    'value', // e.g. "1,284"
    'subLabel' => '', // Optional small text below value
    'badge' => null, // Optional badge: text
    'svgUrl', // Icon path
])


<!--======== Card =========-->
<div
    class="rounded-lg border bg-[#F8FAFC] border-[#e4e4e780] shadow-sm group relative overflow-hidden  hover:shadow-md transition-all duration-500 hover:-translate-y-1 p-6">
    <div class="flex items-start justify-between">
        <div class="space-y-2">
            <p class="text-sm font-medium text-[#65758b]">{{ $label }}</p>
            <p class="text-3xl font-bold tracking-tight">
                {{ $value ?? 0 }}
            </p>

            @if ($badge || $subLabel)
                <div class="flex items-center gap-1">
                    @if ($badge)
                        <span
                            class="text-xs font-semibold px-2 py-0.5 rounded-full text-green-600 bg-green-50 border border-green-200">
                            {{ $badge }}
                        </span>
                    @endif

                    @if ($subLabel)
                        <span class="text-xs text-gray-500">{{ $subLabel }}</span>
                    @endif
                </div>
            @endif

        </div>
        @isset($svgUrl)
            <div
                class="rounded-2xl bg-blue-500 text-white p-3 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg shadow-[#6547fa1a]">
                <img src="{{ $svgUrl }}">
            </div>
        @endisset
    </div>
</div>
