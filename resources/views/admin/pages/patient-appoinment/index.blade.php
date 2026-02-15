@extends('admin.layouts.main')
@section('title', 'Patient Appointment')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Patient Appointments', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('patient-appointment.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'patient_name', 'label' => 'Patient Name', 'type' => null],
            ['key' => 'doctor_name', 'label' => 'Doctor Name', 'type' => null],
            ['key' => 'appointment_date', 'label' => 'Appointment Date', 'type' => null],
            ['key' => 'appointment_mode', 'label' => 'Appointment Mode', 'type' => null],
            ['key' => 'phone', 'label' => 'Phone', 'type' => null],
            ['key' => 'status', 'label' => 'Appointment Status', 'type' => 'badge'],
            ['key' => 'priority', 'label' => 'Priority', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['appointments']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="Patient Name" value="{{ isset($data['oldInputs']['patient_name']) ? $data['oldInputs']['patient_name'] : '' }}" :svgUrl="asset('assets/svg/user-check.svg')" name="patient_name"
                placeholder="Enter Full Name" />

            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['phone']) ? $data['oldInputs']['phone'] : '' }}" label="Number" :svgUrl="asset('assets/svg/phone.svg')" name="phone"
                placeholder="Enter Number" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />

            @multiAuth('web', 'staffs')
            <x-admin.buttons.secondary type="button" label="Add Appointment" class="open-modal"
                data-targetModalId="patient-appointment-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
            @endmultiAuth
        </x-slot>

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            @multiAuth('web', 'staffs')
            <x-admin.headers.icon-button :url="route('patient-appointment.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />
            @endmultiAuth
            <!-- <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('patient-appointment.delete')">
                <x-slot:extra_methods>
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    @method('delete')
                </x-slot:extra_methods>
                <x-slot:icon_button>
                    <x-admin.headers.icon-button type="submit" class="px-0!" :svgUrl="asset('assets/svg/bin.svg')" />
                </x-slot:icon_button>
            </x-admin.globals.forms.form> -->
        </div>
        @endscopedslot

    </x-admin.globals.tables.table>
</div>

<x-admin.globals.modal id="patient-appointment-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Appointment</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="patient-appointment-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('patient-appointment.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">

                {{-- ====== Patient ====== --}}
                <x-admin.globals.forms.field type="select" label="Patient" name="patient_id" required
                    :svgUrl="asset('assets/svg/user-group.svg')">
                    <x-slot>
                        @foreach($data['patients'] ?? [] as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->first_name . ' ' . $patient->last_name ?? '' }}</option>
                        @endforeach

                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Doctor ====== --}}
                <x-admin.globals.forms.field type="select" label="Doctor" name="doctor_id" required
                    :svgUrl="asset('assets/svg/user.svg')">
                    <x-slot>
                        @foreach($data['doctors'] ?? [] as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->full_name }}</option>
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
                        <option value="ONLINE">Online</option>
                        <option value="OFFLINE">Offline</option>
                        <option value="INPERSON">InPerson</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['appointment']->phone ?? '' }}" label="Phone" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="APPLIED">Applied</option>
                        <option value="APPROVED">Approved</option>
                        <option value="IN_LINE">In Line</option>
                        <option value="IN_CHECKING">In Checking</option>
                        <option value="CHECKED">Checked</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Priority ====== --}}
                <x-admin.globals.forms.field type="select" label="Priority" name="priority" required
                    :svgUrl="asset('assets/svg/flag.svg')">
                    <x-slot>
                        <option value="HIGH">High</option>
                        <option value="MEDIUM">Medium</option>
                        <option value="LOW">Low</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== notes ====== --}}
                <x-admin.globals.forms.field type="textarea" label="Notes" name="notes" placeholder="Enter Notes"
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