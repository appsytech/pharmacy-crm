@extends('admin.layouts.main')
@section('title', 'Job Applications')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Job Application', 'active' => true]]" />
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


<div class="py-5">
    <x-admin.globals.tables.table :filterFormAction="route('job-application.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'full_name', 'label' => 'Name', 'type' => null],
            ['key' => 'profile_image', 'label' => 'Profile', 'type' => 'file'],
            ['key' => 'date_of_birth', 'label' => 'Date Of Birth', 'type' => null],
            ['key' => 'email', 'label' => 'Email', 'type' => null],
            ['key' => 'phone_number', 'label' => 'Phone no', 'type' => null],
            ['key' => 'nationality', 'label' => 'Nationality', 'type' => null],
            ['key' => 'application_status', 'label' => 'Status', 'type' => 'badge',],
            ['key' => 'years_of_experience', 'label' => 'Years Of Experience', 'type' => null],
            ['key' => 'position_applied_for', 'label' => 'Applied Position', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['jobApplications']">

        <x-slot name="filters">
            {{-- ====== Status ====== --}}
            <x-admin.globals.forms.field type="select" label="Status" name="status"
                :svgUrl="asset('assets/svg/tag.svg')">
                <x-slot>
                    <option value="">All</option>
                    <option value="PENDING" {{ ($data['oldInputs']['status'] ?? null) == 'PENDING' ? 'selected' : '' }}>Pending</option>
                    <option value="REVIEWED" {{ ($data['oldInputs']['status'] ?? null) == 'REVIEWED' ? 'selected' : '' }}>Reviewed</option>
                    <option value="SHORTLISTED" {{ ($data['oldInputs']['status'] ?? null) == 'SHORTLISTED' ? 'selected' : '' }}>Shortlisted</option>
                    <option value="REJECTED" {{ ($data['oldInputs']['status'] ?? null) == 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                    <option value="HIRED" {{ ($data['oldInputs']['status'] ?? null) == 'HIRED' ? 'selected' : '' }}>Hired</option>
                </x-slot>
            </x-admin.globals.forms.field>

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <!-- <x-admin.buttons.secondary type="button" label="Add Admin" class="open-modal"
                data-targetModalId="admin-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" /> -->
        </x-slot>


        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('job-application.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('job-application.delete')">
                <x-slot:extra_methods>
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    @method('delete')
                </x-slot:extra_methods>
                <x-slot:icon_button>
                    <x-admin.headers.icon-button type="submit" class="px-0!" :svgUrl="asset('assets/svg/bin.svg')" />
                </x-slot:icon_button>
            </x-admin.globals.forms.form>
        </div>
        @endscopedslot

    </x-admin.globals.tables.table>
</div>

@endsection