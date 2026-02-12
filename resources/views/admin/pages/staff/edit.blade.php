@extends('admin.layouts.main')
@section('title', 'staff')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Staff', 'url' => route('staff.index')],['label' => 'Edit staff', 'active' => true]]" />
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

<x-admin.globals.modal actionType="edit">
    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('staff.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">

                {{-- ====== Full Name ====== --}}
                <x-admin.globals.forms.field type="text" label="Full Name" value="{{ $data['staff']->full_name ?? '' }}" name="full_name" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['staff']->phone ?? '' }}" label="Phone" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['staff']->email ?? '' }}" label="Email" name="email" required
                    placeholder="Enter Email" :svgUrl="asset('assets/svg/mail.svg')" />


                {{-- ====== Gender ====== --}}
                <x-admin.globals.forms.field type="select" label="Gender" name="gender" required
                    :svgUrl="asset('assets/svg/venus.svg')">
                    <x-slot>
                        <option value="MALE" {{ ($data['staff']->gender ?? null) == 'MALE' ? 'selected' : '' }}>Male</option>
                        <option value="FEMALE" {{ ($data['staff']->gender ?? null) == 'FEMALE' ? 'selected' : '' }}>Female</option>
                        <option value="OTHER" {{ ($data['staff']->gender ?? null) == 'OTHER' ? 'selected' : '' }}>Other</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                @php
                $maxDate = now()->subDay()->toDateString();
                @endphp

                {{-- ====== Date Of Birth ====== --}}
                <x-admin.globals.forms.field type="date" max="{{ $maxDate }}" value="{{ $data['staff']->date_of_birth ?? '' }}" label="Date Of Birth" name="date_of_birth"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Join Date ====== --}}
                <x-admin.globals.forms.field type="date" value="{{ $data['staff']->join_date ?? '' }}" label="Join Birth" name="join_date" required
                    :svgUrl="asset('assets/svg/calendar-check.svg')" />


                {{-- ====== Job Title ====== --}}
                <x-admin.globals.forms.field type="text" label="Job Title" value="{{ $data['staff']->job_title ?? '' }}" placeholder="Enter Job Title" name="job_title"
                    :svgUrl="asset('assets/svg/briefcase.svg')" />

                {{-- ====== Department ====== --}}
                <x-admin.globals.forms.field type="text" label="Department" value="{{ $data['staff']->department ?? '' }}" placeholder="Enter Department" name="department"
                    :svgUrl="asset('assets/svg/layers.svg')" />

                {{-- ====== Salary ====== --}}
                <x-admin.globals.forms.field type="text" label="Salary" value="{{ $data['staff']->salary ?? '' }}" placeholder="Enter Salary" name="salary"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                {{-- ====== Address ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['staff']->address ?? '' }}" label="Address" name="address"
                    placeholder="Enter Address" :svgUrl="asset('assets/svg/map-pin.svg')" />


                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="ACTIVE" {{ ($data['staff']->status ?? null) == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                        <option value="INACTIVE" {{ ($data['staff']->status ?? null) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                        <option value="ONLEAVE" {{ ($data['staff']->status ?? null) == 'ONLEAVE' ? 'selected' : '' }}>Onleave</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['staff']->id }}" />

            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('staff.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection