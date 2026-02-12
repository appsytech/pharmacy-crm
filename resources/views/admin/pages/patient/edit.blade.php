@extends('admin.layouts.main')
@section('title', 'Patients')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Patients', 'url' => route('patient.index')],['label' => 'Edit patient', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('patient.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                {{-- ====== First name ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['patient']->first_name ?? '' }}" label="First Name" name="first_name" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Last name ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['patient']->last_name ?? '' }}" label="Last Name" name="last_name" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                @php
                $maxDate = now()->subDay()->toDateString();
                @endphp

                {{-- ====== Date Of Birth ====== --}}
                <x-admin.globals.forms.field type="date" max="{{ $maxDate }}" value="{{ $data['patient']->date_of_birth ?? '' }}" label="Date Of Birth" name="date_of_birth" required
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Gender ====== --}}
                <x-admin.globals.forms.field type="select" label="Gender" name="gender" required
                    :svgUrl="asset('assets/svg/venus.svg')">
                    <x-slot>
                        <option value="MALE" {{ ($data['patient']->gender ?? null) == 'MALE' ? 'selected' : '' }}>Male</option>
                        <option value="FEMALE" {{ ($data['patient']->gender ?? null) == 'FEMALE' ? 'selected' : '' }}>Female</option>
                        <option value="OTHER" {{ ($data['patient']->gender ?? null) == 'OTHER' ? 'selected' : '' }}>Other</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['patient']->phone ?? '' }}" label="Phone" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['patient']->email ?? '' }}" label="Email" name="email" required
                    placeholder="Enter Email" :svgUrl="asset('assets/svg/mail.svg')" />

                {{-- ====== Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Password" name="password" placeholder="Enter password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Confirm Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Confirm Password" name="password_confirmation" placeholder="Enter confirm password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Address ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['patient']->address ?? '' }}" label="Address" name="address"
                    placeholder="Enter Address" :svgUrl="asset('assets/svg/map-pin.svg')" />

                {{-- ====== City ====== --}}
                <x-admin.globals.forms.field type="text" label="City" name="city" value="{{ $data['patient']->city ?? '' }}"
                    placeholder="Enter City" :svgUrl="asset('assets/svg/building.svg')" />

                {{-- ====== state ====== --}}
                <x-admin.globals.forms.field type="text" label="State" name="state" value="{{ $data['patient']->state ?? '' }}"
                    placeholder="Enter City" :svgUrl="asset('assets/svg/map-pin.svg')" />


                {{-- ====== Doctor ====== --}}
                <x-admin.globals.forms.field type="select" label="Doctor" name="doctor_id"
                    :svgUrl="asset('assets/svg/stethoscope.svg')">
                    <x-slot>
                        <option value="" selected>--select---</option>
                        @foreach($data['doctors'] ?? [] as $doctor)
                        <option value="{{ $doctor->id }}" {{ ($data['patient']->doctor_id ?? 0) == $doctor->id ? 'selected' : '' }}>{{ $doctor->full_name ?? '' }}</option>
                        @endforeach
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Medical Condition ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['patient']->medical_conditions ?? '' }}" label="Medical Conidtion" name="medical_conditions"
                    placeholder="Enter Medical conditions" :svgUrl="asset('assets/svg/file-heart.svg')" />


                {{-- ====== Insurance Provider  ====== --}}
                <x-admin.globals.forms.field type="text" label="Insurance Provider" name="insurance_provider" value="{{ $data['patient']->insurance_provider ?? '' }}"
                    placeholder="Enter Insurance Provider" :svgUrl="asset('assets/svg/shield.svg')" />

                {{-- ====== Insurance Policy Number  ====== --}}
                <x-admin.globals.forms.field type="text" label="Insurance Policy Number" name="insurance_policy_number" value="{{ $data['patient']->insurance_policy_number ?? '' }}"
                    placeholder="Enter Insurance Policy Number" :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="ACTIVE" {{ ($data['patient']->status ?? null) == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                        <option value="INACTIVE" {{ ($data['patient']->status ?? null) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                        <option value="SUSPENDED" {{ ($data['patient']->status ?? null) == 'SUSPENDED' ? 'selected' : '' }}>Suspended</option>
                        <option value="BLOCKED" {{ ($data['patient']->status ?? null) == 'BLOCKED' ? 'selected' : '' }}>Blocked</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Treatment  Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Treatment Status" name="treatment_status" required
                    :svgUrl="asset('assets/svg/clipboard-check.svg')">
                    <x-slot>
                        <option value="NOT-STARTED" {{ ($data['patient']->treatment_status ?? null) == 'NOT-STARTED' ? 'selected' : '' }}>Not Started</option>
                        <option value="ONGOING" {{ ($data['patient']->treatment_status ?? null) == 'ONGOING' ? 'selected' : '' }}>Ongoing</option>
                        <option value="COMPLETED" {{ ($data['patient']->treatment_status ?? null) == 'COMPLETED' ? 'selected' : '' }}>completed</option>
                        <option value="DISCOUNTED" {{ ($data['patient']->treatment_status ?? null) == 'DISCOUNTED' ? 'selected' : '' }}>Discounted</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['patient']->id }}" />

            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('patient.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection