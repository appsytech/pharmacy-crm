@extends('admin.layouts.main')
@section('title', 'Job applications')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Job Applications', 'url' => route('job-application.index')],['label' => 'Edit Job Application', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('job-application.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="PENDING" {{ ($data['application']->application_status ?? null) == 'PENDING'  ? 'selected' : '' }}>Pending</option>
                        <option value="REVIEWED" {{ ($data['application']->application_status ?? null) == 'REVIEWED'  ? 'selected' : '' }}>Reviewed</option>
                        <option value="SHORTLISTED" {{ ($data['application']->application_status ?? null) == 'SHORTLISTED'  ? 'selected' : '' }}>Shortlisted</option>
                        <option value="REJECTED" {{ ($data['application']->application_status ?? null) == 'REJECTED'  ? 'selected' : '' }}>Rejected</option>
                        <option value="HIRED" {{ ($data['application']->application_status ?? null) == 'HIRED'  ? 'selected' : '' }}>Hired</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['application']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('job-application.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection