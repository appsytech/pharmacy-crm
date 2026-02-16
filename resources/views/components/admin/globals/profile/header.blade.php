@props([
'admin' => null
])

@php

$admin = $admin ?? Auth::user();

if (isset($admin)){

$profileImageExists =
!empty($admin->profile_image) && Storage::disk('public')->exists($admin->profile_image);
$firstLetter = strtoupper(substr($admin->name ?? $admin->full_name, 0, 1));
}


@endphp

<div class="px-6 py-6 flex items-center gap-5">
    {{-- === profile image ==== --}}
    <div
        class="w-20 h-20 rounded-full border-4 border-white border-opacity-30 bg-blue-500 flex items-center justify-center shrink-0 shadow-md">
        @if ($profileImageExists)
        <img src="{{ asset('storage/' . $admin->profile_image) }}" alt="Profile Image"
            class="w-full h-full object-cover rounded-full">
        @else
        <span class="text-white text-2xl font-bold">
            {{ $firstLetter }}
        </span>
        @endif
    </div>

    {{-- === Info ==== --}}
    <div>
        <h1 class="text-xl font-bold leading-tight">{{ $admin->name ?? $admin->full_name ?? '' }}</h1>
        <p class="text-sm mt-0.5">{{ $admin->email ?? '' }}</p>
        <div class="flex items-center gap-2 mt-2">
            <span
                class="{{ $admin->status ? 'bg-green-200 text-green-700 ' : 'bg-red-200 text-red-700' }} text-xs font-semibold px-2.5 py-0.5 rounded-full flex items-center gap-1.5">
                <span
                    class="w-1.5 h-1.5  {{ $admin->status ? 'bg-green-500' : 'bg-red-500' }} rounded-full inline-block"></span>
                {{ $admin->status ? 'Active' : 'Inactive' }}
            </span>
            @php
            $roles = [
            1 => 'SUPER ADMIN',
            2 => 'ADMIN',
            3 => 'EDITOR',
            ];

            $roleLabel = $roles[$admin->admin_role] ?? $admin->role ?? '';
            @endphp

            <span
                class="bg-blue-200 bg-opacity-15 text-blue-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                {{ $roleLabel }}
            </span>
        </div>
    </div>
</div>