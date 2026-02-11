@extends('admin.layouts.main')
@section('title', 'Patient List')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Patients', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('patient.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'first_name', 'label' => 'First Name', 'type' => null],
            ['key' => 'last_name', 'label' => 'Last Name', 'type' => null],
            ['key' => 'gender', 'label' => 'Gender', 'type' => null],
            ['key' => 'email', 'label' => 'Email', 'type' => null],
            ['key' => 'phone', 'label' => 'Phone', 'type' => null],
            ['key' => 'doctor_name', 'label' => 'Doctor', 'type' => null],
            ['key' => 'treatment_status', 'label' => 'Treatment Status', 'type' => 'badge'],
            ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['patients']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="First Name" value="{{ isset($data['oldInputs']['first_name']) ? $data['oldInputs']['first_name'] : '' }}" :svgUrl="asset('assets/svg/user-check.svg')" name="first_name"
                placeholder="Enter Full Name" />

            <x-admin.globals.forms.field type="email" value="{{ isset($data['oldInputs']['email']) ? $data['oldInputs']['email'] : '' }}" label="Email" :svgUrl="asset('assets/svg/mail.svg')" name="email"
                placeholder="Enter Email" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Patient" class="open-modal"
                data-targetModalId="patient-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('patient.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('patient.delete')">
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

<x-admin.globals.modal id="patient-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Patient</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="patient-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('patient.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== First name ====== --}}
                <x-admin.globals.forms.field type="text" label="First Name" name="first_name" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Last name ====== --}}
                <x-admin.globals.forms.field type="text" label="Last Name" name="last_name" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                @php
                $maxDate = now()->subDay()->toDateString();
                @endphp

                {{-- ====== Date Of Birth ====== --}}
                <x-admin.globals.forms.field type="date" max="{{ $maxDate }}" label="Date Of Birth" name="date_of_birth" required
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Gender ====== --}}
                <x-admin.globals.forms.field type="select" label="Gender" name="gender" required
                    :svgUrl="asset('assets/svg/venus.svg')">
                    <x-slot>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                        <option value="OTHER">Other</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" label="Phone" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field type="text" label="Email" name="email" required
                    placeholder="Enter Email" :svgUrl="asset('assets/svg/mail.svg')" />

                {{-- ====== Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Password" name="password" required placeholder="Enter password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Confirm Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Confirm Password" required name="password_confirmation" placeholder="Enter confirm password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Address ====== --}}
                <x-admin.globals.forms.field type="text" label="Address" name="address"
                    placeholder="Enter Address" :svgUrl="asset('assets/svg/map-pin.svg')" />

                {{-- ====== City ====== --}}
                <x-admin.globals.forms.field type="text" label="City" name="city"
                    placeholder="Enter City" :svgUrl="asset('assets/svg/building.svg')" />

                {{-- ====== state ====== --}}
                <x-admin.globals.forms.field type="text" label="State" name="state"
                    placeholder="Enter City" :svgUrl="asset('assets/svg/map-pin.svg')" />


                {{-- ====== Doctor ====== --}}
                <x-admin.globals.forms.field type="select" label="Doctor" name="doctor_id"
                    :svgUrl="asset('assets/svg/stethoscope.svg')">
                    <x-slot>
                        <option value="" selected>--select---</option>
                        @foreach($data['doctors'] ?? [] as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->full_name ?? '' }}</option>
                        @endforeach
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Medical Condition ====== --}}
                <x-admin.globals.forms.field type="text" label="Medical Conidtion" name="medical_conditions"
                    placeholder="Enter Medical conditions" :svgUrl="asset('assets/svg/file-heart.svg')" />


                {{-- ====== Insurance Provider  ====== --}}
                <x-admin.globals.forms.field type="text" label="Insurance Provider" name="insurance_provider"
                    placeholder="Enter Insurance Provider" :svgUrl="asset('assets/svg/shield.svg')" />

                {{-- ====== Insurance Policy Number  ====== --}}
                <x-admin.globals.forms.field type="text" label="Insurance Policy Number" name="insurance_policy_number"
                    placeholder="Enter Insurance Policy Number" :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                        <option value="SUSPENDED">Suspended</option>
                        <option value="BLOCKED">Blocked</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Treatment  Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Treatment Status" name="treatment_status" required
                    :svgUrl="asset('assets/svg/clipboard-check.svg')">
                    <x-slot>
                        <option value="NOT-STARTED">Not Started</option>
                        <option value="ONGOING">Ongoing</option>
                        <option value="COMPLETED">completed</option>
                        <option value="DISCOUNTED">Discounted</option>
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