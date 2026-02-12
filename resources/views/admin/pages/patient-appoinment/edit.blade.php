@extends('admin.layouts.main')
@section('title', 'Patient Appointment')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Patient Appointment', 'url' => route('patient-appointment.index')],['label' => 'Edit Patient Appointment', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('patient-appointment.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">

                {{-- ====== Patient ====== --}}
                <x-admin.globals.forms.field type="select" label="Patient" name="patient_id" required
                    :svgUrl="asset('assets/svg/user-group.svg')">
                    <x-slot>
                        @foreach($data['patients'] ?? [] as $patient)
                        <option value="{{ $patient->id }}" {{ ($data['appointment']->patient_id ?? 0) == $patient->id ? 'selected' : '' }}>{{ $patient->first_name . ' ' . $patient->last_name ?? '' }}</option>
                        @endforeach

                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Doctor ====== --}}
                <x-admin.globals.forms.field type="select" label="Doctor" name="doctor_id" required
                    :svgUrl="asset('assets/svg/user.svg')">
                    <x-slot>
                        @foreach($data['doctors'] ?? [] as $doctor)
                        <option value="{{ $doctor->id }}" {{ ($data['appointment']->doctor_id ?? 0) == $doctor->id ? 'selected' : '' }}>{{ $doctor->full_name }}</option>
                        @endforeach
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Appointment Date ====== --}}
                <x-admin.globals.forms.field type="date" value="{{ isset($data['appointment']->appointment_date) ? \Carbon\Carbon::parse($data['appointment']->appointment_date)->format('Y-m-d') : '' }}" label="Appointment Date" name="appointment_date" required
                    :svgUrl="asset('assets/svg/calendar.svg')" />


                {{-- ====== Appointment Mode ====== --}}
                <x-admin.globals.forms.field type="select" label="Appointment Mode" name="appointment_mode" required
                    :svgUrl="asset('assets/svg/monitor-cloud.svg')">
                    <x-slot>
                        <option value="ONLINE" {{ ($data['appointment']->appointment_mode ?? null) == 'ONLINE' ? 'selected' : '' }}>Online</option>
                        <option value="OFFLINE" {{ ($data['appointment']->appointment_mode ?? null) == 'OFFLINE' ? 'selected' : '' }}>Offline</option>
                        <option value="INPERSON" {{ ($data['appointment']->appointment_mode ?? null) == 'INPERSON' ? 'selected' : '' }}>InPerson</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['appointment']->phone ?? '' }}" label="Phone" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="APPLIED" {{ ($data['appointment']->status ?? null) == 'APPLIED' ? 'selected' : '' }}>Applied</option>
                        <option value="APPROVED" {{ ($data['appointment']->status ?? null) == 'APPROVED' ? 'selected' : '' }}>Approved</option>
                        <option value="IN_LINE" {{ ($data['appointment']->status ?? null) == 'IN_LINE' ? 'selected' : '' }}>In Line</option>
                        <option value="IN_CHECKING" {{ ($data['appointment']->status ?? null) == 'IN_CHECKING' ? 'selected' : '' }}>In Checking</option>
                        <option value="CHECKED" {{ ($data['appointment']->status ?? null) == 'CHECKED' ? 'selected' : '' }}>Checked</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Priority ====== --}}
                <x-admin.globals.forms.field type="select" label="Priority" name="priority" required
                    :svgUrl="asset('assets/svg/flag.svg')">
                    <x-slot>
                        <option value="HIGH" {{ ($data['appointment']->priority ?? null) == 'HIGH' ? 'selected' : '' }}>High</option>
                        <option value="MEDIUM" {{ ($data['appointment']->priority ?? null) == 'MEDIUM' ? 'selected' : '' }}>Medium</option>
                        <option value="LOW" {{ ($data['appointment']->priority ?? null) == 'LOW' ? 'selected' : '' }}>Low</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== notes ====== --}}
                <x-admin.globals.forms.field type="textarea" value="{{ $data['appointment']->notes ?? '' }}" label="Notes" name="notes" placeholder="Enter Notes"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['appointment']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('admin.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection