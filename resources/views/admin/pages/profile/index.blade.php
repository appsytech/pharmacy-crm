@extends('admin.layouts.main')
@section('title', 'Profile')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Profile', 'active' => true]]" />
@endsection

@section('content')

<div id="popup-container" class="fixed top-5 right-5 space-y-2 z-50 flex flex-col gap-2">
    @if (session('success'))
    <x-alert-box type="success" :message="session('success')" />
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <x-alert-box type="error" :message="$error" />
    @endforeach
    @endif
</div>

@php
$admin = $data['admin'];

$roles = [
1 => 'SUPER ADMIN',
2 => 'ADMIN',
3 => 'EDITOR',
];

$roleLabel = $roles[$admin->admin_role] ?? 'UNKNOWN';
@endphp



<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

    {{-- -========  PROFILE HEADER BANNER ======== --}}
    <x-admin.globals.profile.header :admin="$data['admin']" />

    {{-- ========DETAILS ======= --}}
    <x-admin.globals.tables.table-secondary :columns="[
    ['label' => '#'],
    ['label' => 'Field'],
    ['label' => 'Value'],
    ]" :fields="[
    ['sn' => 1, 'svgUrl' => asset('assets/svg/user.svg') , 'label' => 'Name' , 'value' => $admin->name ?? '--'],
    ['sn' => 2, 'svgUrl' => asset('assets/svg/mail.svg') , 'label' => 'Email' , 'value' => $admin->email ?? '--'],
    ['sn' => 3, 'svgUrl' => asset('assets/svg/user-check.svg') , 'label' => 'Username' , 'value' => $admin->username ?? '--'],
    ['sn' => 4, 'svgUrl' => asset('assets/svg/phone.svg') , 'label' => 'Phone' , 'value' => $admin->phone ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/star.svg') , 'label' => 'Admin Role' , 'value' =>  $roleLabel ?? '--'],
    ['sn' => 6, 'svgUrl' => asset('assets/svg/tag.svg') , 'label' => 'Status' , 'type' => 'badge', 'value' => $admin->status],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/clock.svg') , 'label' => 'Last Login At' , 'value' => $admin->last_login_at],
    ]" />

    {{-- ====== FOOTER ====== --}}
    <div class="border-t border-gray-200 bg-gray-50 px-5 py-3 flex items-center justify-between">
        <span class="text-xs text-gray-400">Read-only view</span>

        <div class="flex items-center gap-2">
            <a href="{{ route('profile.edit') }}"
                class="inline-flex items-center justify-center w-7 h-7 rounded-md border border-gray-300 text-gray-500 hover:text-indigo-600 hover:border-indigo-300 hover:bg-indigo-50 transition"
                title="Edit">
                <img src="{{ asset('assets/svg/pencil.svg') }}" class="w-4 h-4 pointer-events-none">
            </a>

            @if (isset($admin->updated_at))
            <span class="text-xs text-gray-400">
                Last updated: {{ $admin->updated_at }}
            </span>
            @endif
        </div>
    </div>

</div>

@endsection