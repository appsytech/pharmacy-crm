@extends('admin.layouts.main')
@section('title', 'staffs')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Staff', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('staff.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'full_name', 'label' => 'Full Name', 'type' => null],
            ['key' => 'email', 'label' => 'Email', 'type' => null],
            ['key' => 'phone', 'label' => 'Phone no', 'type' => null],
            ['key' => 'gender', 'label' => 'Gender', 'type' => null],
            ['key' => 'join_date', 'label' => 'Join Date', 'type' => null],
            ['key' => 'job_title', 'label' => 'Job Title', 'type' => null],
            ['key' => 'department', 'label' => 'Department', 'type' => null],
            ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['staffs']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="Full Name" value="{{ isset($data['oldInputs']['full_name']) ? $data['oldInputs']['full_name'] : '' }}" :svgUrl="asset('assets/svg/user-check.svg')" name="full_name"
                placeholder="Enter Full Name" />
            <x-admin.globals.forms.field type="email" value="{{ isset($data['oldInputs']['email']) ? $data['oldInputs']['email'] : '' }}" label="Email" :svgUrl="asset('assets/svg/mail.svg')" name="email"
                placeholder="Enter Email" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Staff" class="open-modal"
                data-targetModalId="staff-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>


        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('staff.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('staff.delete')">
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

<x-admin.globals.modal id="staff-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Staff</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="staff-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('staff.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">

                {{-- ====== Full Name ====== --}}
                <x-admin.globals.forms.field type="text" label="Full Name" name="full_name" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field type="text" label="Email" name="email" required
                    placeholder="Enter Email" :svgUrl="asset('assets/svg/mail.svg')" />

                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" label="Phone" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />


                {{-- ====== Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Password" name="password" required placeholder="Enter password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Confirm Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Confirm Password" required name="password_confirmation" placeholder="Enter confirm password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Role ====== --}}
                <x-admin.globals.forms.field type="select" label="Role" name="role" required
                    :svgUrl="asset('assets/svg/shield-check.svg')">
                    <x-slot>
                        <option value="STAFF">Staff</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Gender ====== --}}
                <x-admin.globals.forms.field type="select" label="Gender" name="gender" required
                    :svgUrl="asset('assets/svg/venus.svg')">
                    <x-slot>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                        <option value="OTHER">Other</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                @php
                $maxDate = now()->subDay()->toDateString();
                @endphp

                {{-- ====== Date Of Birth ====== --}}
                <x-admin.globals.forms.field type="date" max="{{ $maxDate }}" label="Date Of Birth" name="date_of_birth"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Join Date ====== --}}
                <x-admin.globals.forms.field type="date" label="Join Date" name="join_date" required
                    :svgUrl="asset('assets/svg/calendar-check.svg')" />


                {{-- ====== Job Title ====== --}}
                <x-admin.globals.forms.field type="text" label="Job Title" placeholder="Enter Job Title" name="job_title"
                    :svgUrl="asset('assets/svg/briefcase.svg')" />

                {{-- ====== Department ====== --}}
                <x-admin.globals.forms.field type="text" label="Department" placeholder="Enter Department" name="department"
                    :svgUrl="asset('assets/svg/layers.svg')" />

                {{-- ====== Salary ====== --}}
                <x-admin.globals.forms.field type="text" label="Salary" placeholder="Enter Salary" name="salary"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                {{-- ====== Address  ====== --}}
                <x-admin.globals.forms.field type="text" label="Address" placeholder="Enter Address" name="address"
                    :svgUrl="asset('assets/svg/map-pin.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                        <option value="ONLEAVE">Onleave</option>
                    </x-slot>
                </x-admin.globals.forms.field>
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection