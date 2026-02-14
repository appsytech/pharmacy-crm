@extends('admin.layouts.main')
@section('title', 'Patient Report')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Patient Report', 'active' => true]]" />
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
    <x-admin.globals.tables.table
        :filterFormAction="route('patient-report.index')"
        :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'patient_name', 'label' => 'Patient', 'type' => null],
            ['key' => 'doctor_name', 'label' => 'Doctor', 'type' => null],
            ['key' => 'report_type', 'label' => 'Report Type', 'type' => null],
            ['key' => 'pdf_file_path', 'label' => 'Pdf', 'type' => 'file'],
            ['key' => 'report_date', 'label' => 'Report Date', 'type' => null],
            ['key' => 'report_status', 'label' => 'Report Status', 'type' => 'badge'],
            ['key' => 'created_at', 'label' => 'Created At', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]"
        :rows="$data['reports']">

        <x-slot name="filters">
            <!-- ====== Report Type ====== -->
            <x-admin.globals.forms.field
                type="text"
                label="Report Type"
                name="report_type"
                value="{{ $data['oldInputs']['report_type'] ?? '' }}"
                placeholder="Enter Report Type"
                :svgUrl="asset('assets/svg/file-text.svg')" />


            <!-- ====== Report Status Filter ====== -->
            <x-admin.globals.forms.field
                type="select"
                label="Report Status"
                name="report_status"
                :svgUrl="asset('assets/svg/tag.svg')">

                <x-slot>
                    <option value="">All</option>
                    <option value="PENDING"
                        {{ ($data['oldInputs']['report_status'] ?? '') == 'PENDING' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="COMPLETED"
                        {{ ($data['oldInputs']['report_status'] ?? '') == 'COMPLETED' ? 'selected' : '' }}>
                        Completed
                    </option>
                    <option value="REVIEWED"
                        {{ ($data['oldInputs']['report_status'] ?? '') == 'REVIEWED' ? 'selected' : '' }}>
                        Reviewed
                    </option>
                </x-slot>

            </x-admin.globals.forms.field>

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Report" class="open-modal"
                data-targetModalId="patient-report-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('patient-report.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('patient-report.delete')">
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

<x-admin.globals.modal id="patient-report-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Patient Report</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="patient-report-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('patient-report.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                <!-- ====== Patient ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Patient"
                    name="patient_id"
                    required
                    :svgUrl="asset('assets/svg/user.svg')">

                    <x-slot>
                        @foreach($data['patients'] ?? [] as $patient)
                        <option value="{{ $patient->id }}">
                            {{ $patient->first_name .  ' ' . $patient->last_name ?? '' }}
                        </option>
                        @endforeach
                    </x-slot>
                </x-admin.globals.forms.field>


                <!-- ====== Doctor ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Doctor"
                    name="doctor_id"
                    required
                    :svgUrl="asset('assets/svg/stethoscope.svg')">

                    <x-slot>
                        @foreach($data['doctors'] ?? [] as $doctor)
                        <option value="{{ $doctor->id }}">
                            {{ $doctor->full_name }}
                        </option>
                        @endforeach
                    </x-slot>
                </x-admin.globals.forms.field>



                <!-- ====== Report Type ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Report Type"
                    name="report_type"
                    required
                    placeholder="Enter Report Type"
                    :svgUrl="asset('assets/svg/file-text.svg')" />


                <!-- ====== Diagnosis ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Diagnosis"
                    name="diagnosis"
                    placeholder="Enter Diagnosis"
                    :svgUrl="asset('assets/svg/activity.svg')" />


                <!-- ====== Symptoms ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Symptoms"
                    name="symptoms"
                    placeholder="Enter Symptoms"
                    :svgUrl="asset('assets/svg/circle-alert.svg')" />


                <!-- ====== Report Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Report Date"
                    name="report_date"
                    required
                    :svgUrl="asset('assets/svg/calendar.svg')" />


                <!-- ====== Report Status ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Report Status"
                    name="report_status"
                    required
                    :svgUrl="asset('assets/svg/tag.svg')">

                    <x-slot>
                        <option value="PENDING">Pending</option>
                        <option value="COMPLETED">Completed</option>
                        <option value="REVIEWED">Reviewed</option>
                    </x-slot>

                </x-admin.globals.forms.field>


                <!-- ====== Notes ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Notes"
                    name="notes"
                    placeholder="Additional Notes"
                    :svgUrl="asset('assets/svg/file-badge.svg')" />


                <!-- ====== PDF File Upload ====== -->
                <x-admin.globals.forms.field
                    type="file"
                    label="Upload PDF"
                    name="pdf_file"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />

            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection