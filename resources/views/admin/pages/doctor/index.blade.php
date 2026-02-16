@extends('admin.layouts.main')
@section('title', 'Doctors')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Doctor', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('doctor.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'full_name', 'label' => 'Full Name', 'type' => null],
            ['key' => 'profile_image', 'label' => 'Profile', 'type' => 'file'],
            ['key' => 'email', 'label' => 'Email', 'type' => null],
            ['key' => 'phone_number', 'label' => 'Phone no', 'type' => null],
            ['key' => 'speciality', 'label' => 'Speciality', 'type' => null],
            ['key' => 'department', 'label' => 'Department', 'type' => null],
            ['key' => 'experience', 'label' => 'Experience', 'type' => null],
            ['key' => 'consultation_fee', 'label' => 'Consultation Fee', 'type' => null],
            ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['doctors']">

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

            <x-admin.buttons.secondary type="button" label="Add Doctor" class="open-modal"
                data-targetModalId="doctor-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('doctor.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('doctor.delete')">
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

<x-admin.globals.modal id="doctor-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Doctor</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="doctor-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('doctor.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== name ====== --}}
                <x-admin.globals.forms.field type="text" label="Full Name" name="full_name" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" label="Phone" name="phone_number" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field type="text" label="Email" name="email" required
                    placeholder="Enter Email" :svgUrl="asset('assets/svg/sigma.svg')" />


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
                        <option value="DOCTOR">Doctor</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Consultation Fee ====== --}}
                <x-admin.globals.forms.field type="numeric" label="Consultation Fee" name="consultation_fee" placeholder="Enter Consultation Fee"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                {{-- ====== Speciality ====== --}}
                <x-admin.globals.forms.field type="text" label="Speciality" name="speciality" placeholder="Enter Speciality"
                    :svgUrl="asset('assets/svg/stethoscope.svg')" />

                {{-- ====== Department ====== --}}
                <x-admin.globals.forms.field type="text" label="Department" name="department" placeholder="Enter Department"
                    :svgUrl="asset('assets/svg/building.svg')" />

                {{-- ====== Experience ====== --}}
                <x-admin.globals.forms.field type="number" label="Experience" name="experience" placeholder="Enter Experience"
                    :svgUrl="asset('assets/svg/clock.svg')" />



                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                        <option value="ONLEAVE">On Leave</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Position ====== --}}
                <x-admin.globals.forms.field type="select" label="Position" name="position" required
                    :svgUrl="asset('assets/svg/award.svg')">
                    <x-slot>
                        <option value="JUNIOR">Junior</option>
                        <option value="SENIOR">Senior</option>
                        <option value="CONSULTANT">Consultant</option>
                        <option value="HEAD">Head</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== License Number ====== --}}
                <x-admin.globals.forms.field type="text" label="License Number" name="license_number" placeholder="Enter License Number" required
                    :svgUrl="asset('assets/svg/id-card.svg')" />

                {{-- ====== Join Date ====== --}}
                <x-admin.globals.forms.field type="date" label="Join Date" name="join_date" placeholder="Enter License Number"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Availability ====== --}}
                <x-admin.globals.forms.field type="text" label="Availability" name="availability" placeholder="Enter Availability"
                    :svgUrl="asset('assets/svg/clock.svg')" />

                {{-- ====== Location ====== --}}
                <x-admin.globals.forms.field type="date" label="Location" name="location" placeholder="Enter Location"
                    :svgUrl="asset('assets/svg/map-pin.svg')" />

                {{-- ====== Facebook ====== --}}
                <x-admin.globals.forms.field type="text"
                    label="Facebook Profile"
                    name="fb_profile"
                    placeholder="Enter Facebook URL"
                    :svgUrl="asset('assets/svg/facebook.svg')" />

                {{-- ====== Linkedin ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="LinkedIn Profile"
                    name="linkedin_profile"
                    placeholder="Enter LinkedIn URL"
                    :svgUrl="asset('assets/svg/linkedin.svg')" />

                {{-- ====== Twitter ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Twitter Profile"
                    name="twitter_profile"
                    placeholder="Enter Twitter URL"
                    :svgUrl="asset('assets/svg/twitter.svg')" />


                {{-- ====== Profile ====== --}}
                <x-admin.globals.forms.field type="file" class="image-upload&preview" label="Profile" name="profile_image"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field type="textarea" label="Description" name="description" placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection