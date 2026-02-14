@extends('admin.layouts.main')
@section('title', 'Patient Report')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Patient Reports', 'url' => route('patient-report.index')],['label' => 'Edit patient report', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('patient-report.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                <!--  ====== Patient ====== --> 
                <x-admin.globals.forms.field
                    type="select"
                    label="Patient"
                    name="patient_id"
                    required
                    :svgUrl="asset('assets/svg/user.svg')">

                    <x-slot>
                        @foreach($data['patients'] ?? [] as $patient)
                        <option value="{{ $patient->id }}" {{ ($data['report']->patient_id  ?? null) == $patient->id ? 'selected' : '' }}>
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
                        <option value="{{ $doctor->id }}" {{ ($data['report']->doctor_id  ?? null) == $doctor->id ? 'selected' : '' }}>
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
                    value="{{ $data['report']->report_type ?? '' }}"
                    required
                    placeholder="Enter Report Type"
                    :svgUrl="asset('assets/svg/file-text.svg')" />


                <!-- ====== Diagnosis ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Diagnosis"
                    name="diagnosis"
                    value="{{ $data['report']->diagnosis ?? '' }}"
                    placeholder="Enter Diagnosis"
                    :svgUrl="asset('assets/svg/activity.svg')" />


                <!-- ====== Symptoms ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Symptoms"
                    name="symptoms"
                    value="{{ $data['report']->symptoms ?? '' }}"
                    placeholder="Enter Symptoms"
                    :svgUrl="asset('assets/svg/circle-alert.svg')" />


                <!-- ====== Report Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Report Date"
                    name="report_date"
                    value="{{ $data['report']->report_date ?? '' }}"
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
                        <option value="PENDING" {{ ($data['report']->report_status ?? null) == 'PENDING' ? 'selected' : '' }}>Pending</option>
                        <option value="COMPLETED" {{ ($data['report']->report_status ?? null) == 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                        <option value="REVIEWED" {{ ($data['report']->report_status ?? null) == 'REVIEWED' ? 'selected' : '' }}>Reviewed</option>
                    </x-slot>

                </x-admin.globals.forms.field>


                <!-- ====== Notes ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Notes"
                    name="notes"
                    value="{{ $data['report']->notes ?? '' }}"
                    placeholder="Additional Notes"
                    :svgUrl="asset('assets/svg/file-badge.svg')" />


                <!-- ====== PDF File Upload ====== -->
                <x-admin.globals.forms.field
                    type="file"
                    label="Upload PDF"
                    name="pdf_file"
                    :svgUrl="asset('assets/svg/image-plus.svg')">

                    @if (isset($data['report']->pdf_file_path))
                    <x-slot:file_preview>
                        @php
                        $filePath = $data['report']->pdf_file_path;
                        $fileUrl = asset('storage/' . $filePath);
                        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

                        $isImage = in_array($extension, $imageExtensions);
                        @endphp

                        <div class="relative inline-flex gap-2">

                            @if($isImage)
                            <img src="{{ asset('storage/' . $data['report']->pdf_file_path) }}"
                                class="w-24 h-24 object-cover rounded border">

                            @else
                            <a href="{{ asset('storage/' . $data['report']->pdf_file_path) }}" target="_blank" class="flex items-center gap-2">
                                <img src="{{asset('assets/svg/file-text.svg') }}" class="h-6 w-6 text-gray-500" alt="">

                            </a>
                            @endif
                        </div>


                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['report']->id }}" />

            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('patient-report.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection