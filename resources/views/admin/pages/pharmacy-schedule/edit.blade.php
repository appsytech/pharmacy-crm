@extends('admin.layouts.main')
@section('title', 'Pharmacy Schedule')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Pharmacy Schedule', 'url' => route('pharmacy-schedule.index')],['label' => 'Edit Pharmacy Schedule', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('pharmacy-schedule.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                {{-- ====== Days ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Days"
                    name="days"
                    :value="old('days', $data['schedule']->days)"
                    required
                    placeholder="Enter Days (e.g. Sunday - Friday)"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Start Time ====== --}}
                <x-admin.globals.forms.field
                    type="datetime-local"
                    label="Start Time"
                    name="start_time"
                    :value="$data['schedule']->start_time"
                    required
                    :svgUrl="asset('assets/svg/clock.svg')" />

                {{-- ====== End Time ====== --}}
                <x-admin.globals.forms.field
                    type="datetime-local"
                    label="End Time"
                    name="end_time"
                    :value="$data['schedule']->end_time"
                    required
                    :svgUrl="asset('assets/svg/clock.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1"
                            {{ old('status', $data['schedule']->status) == 1 ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="0"
                            {{ old('status', $data['schedule']->status) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Sort Order ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Sort Order"
                    name="sort"
                    min="0"
                    :value="old('sort', $data['schedule']->sort)"
                    placeholder="Enter Sort Value"
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />

                {{-- ====== Hidden ID ====== --}}
                <x-admin.globals.forms.field
                    type="hidden"
                    name="id"
                    :value="$data['schedule']->id" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('pharmacy-schedule.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection