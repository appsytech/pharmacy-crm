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

@if(isset($data['admin']))
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
@endif



@if(isset($data['doctor']))

@php
$doctor = $data['doctor'];
@endphp

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

    {{-- -========  PROFILE HEADER BANNER ======== --}}
    <x-admin.globals.profile.header :admin="$data['doctor']" />

    {{-- ========DETAILS ======= --}}
    <x-admin.globals.tables.table-secondary :columns="[
    ['label' => '#'],
    ['label' => 'Field'],
    ['label' => 'Value'],
    ]" :fields="[
    ['sn' => 1, 'svgUrl' => asset('assets/svg/user.svg') , 'label' => 'Name' , 'value' => $doctor->full_name ?? '--'],
    ['sn' => 2, 'svgUrl' => asset('assets/svg/mail.svg') , 'label' => 'Email' , 'value' => $doctor->email ?? '--'],
    ['sn' => 4, 'svgUrl' => asset('assets/svg/phone.svg') , 'label' => 'Phone' , 'value' => $doctor->phone_number ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/star.svg') , 'label' => 'Doctor Role' , 'value' =>  $doctor->role ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/facebook.svg') , 'label' => 'Facebook Profile' , 'type' => 'link', 'value' =>  $doctor->fb_profile ?? null],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/linkedin.svg') , 'label' => 'Linkedin Profile', 'type' => 'link',  'value' =>  $doctor->linkeding_profile ?? null],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/twitter.svg') , 'label' => 'Twitter Profile' , 'type' => 'link',  'value' =>  $doctor->twitter_profile ?? null],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/stethoscope.svg') , 'label' => 'Speciality' , 'value' =>  $doctor->speciality ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/building.svg') , 'label' => 'Department' , 'value' =>  $doctor->department ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/clock.svg') , 'label' => 'Experience' , 'value' =>  $doctor->experience ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/briefcase.svg') , 'label' => 'Position' , 'value' =>  $doctor->position ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/badge-check.svg') , 'label' => 'License Number' , 'value' =>  $doctor->license_number ?? '--'],
    ['sn' => 6, 'svgUrl' => asset('assets/svg/tag.svg') , 'label' => 'Status' , 'type' => 'badge', 'value' => $doctor->status],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/clock.svg') , 'label' => 'Join Date' , 'value' => $doctor->join_date],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/clock.svg') , 'label' => 'Availability' , 'value' => $doctor->availability],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/map-pin.svg') , 'label' => 'Location' , 'value' => $doctor->location],
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

            @if (isset($doctor->updated_at))
            <span class="text-xs text-gray-400">
                Last updated: {{ $doctor->updated_at }}
            </span>
            @endif
        </div>
    </div>

</div>
@endif




@if(isset($data['staff']))

@php
$staff = $data['staff'];
@endphp

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

    {{-- -========  PROFILE HEADER BANNER ======== --}}
    <x-admin.globals.profile.header :admin="$data['staff']" />

    {{-- ========DETAILS ======= --}}
    <x-admin.globals.tables.table-secondary :columns="[
    ['label' => '#'],
    ['label' => 'Field'],
    ['label' => 'Value'],
    ]" :fields="[
    ['sn' => 1, 'svgUrl' => asset('assets/svg/user.svg') , 'label' => 'Name' , 'value' => $staff->full_name ?? '--'],
    ['sn' => 2, 'svgUrl' => asset('assets/svg/mail.svg') , 'label' => 'Email' , 'value' => $staff->email ?? '--'],
    ['sn' => 4, 'svgUrl' => asset('assets/svg/phone.svg') , 'label' => 'Phone' , 'value' => $staff->phone_number ?? '--'],
    ['sn' => 4, 'svgUrl' => asset('assets/svg/user-plus.svg') , 'label' => 'Gender' , 'value' => $staff->gender ?? '--'],
    ['sn' => 4, 'svgUrl' => asset('assets/svg/cake.svg') , 'label' => 'Date Of Birth' , 'value' => $staff->date_of_birth ?? '--'],
    ['sn' => 5, 'svgUrl' => asset('assets/svg/star.svg') , 'label' => 'Staff Role' , 'value' =>  $staff->role ?? '--'],
    ['sn' => 6, 'svgUrl' => asset('assets/svg/tag.svg') , 'label' => 'Status' , 'type' => 'badge', 'value' => $staff->status],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/clock.svg') , 'label' => 'Join Date' , 'value' => $staff->join_date],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/briefcase.svg') , 'label' => 'Job Title' , 'value' => $staff->job_title],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/building.svg') , 'label' => 'Department' , 'value' => $staff->department],
    ['sn' => 7, 'svgUrl' => asset('assets/svg/map-pin.svg') , 'label' => 'Address' , 'value' => $staff->address],
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

            @if (isset($staff->updated_at))
            <span class="text-xs text-gray-400">
                Last updated: {{ $staff->updated_at }}
            </span>
            @endif
        </div>
    </div>

</div>
@endif


@endsection