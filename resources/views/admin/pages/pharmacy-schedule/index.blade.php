@extends('admin.layouts.main')
@section('title', 'Pharmacy Schedule')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Pharmacy Schedule', 'active' => true]]" />
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
        :filterFormAction="route('pharmacy-schedule.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],
        ['key' => 'days', 'label' => 'Day'],
        ['key' => 'start_time', 'label' => 'Start Time'],
        ['key' => 'end_time', 'label' => 'End Time'],
        ['key' => 'sort', 'label' => 'Sort'],
        [
            'key' => 'status',
            'label' => 'Status',
            'type' => 'toggle',
            'route' => 'pharmacy-schedule.status.update',
            'idKey' => 'id',
        ],
        ['key' => 'created_by', 'label' => 'Created By'],

        [
            'key' => 'created_at',
            'label' => 'Created At',
        ],

        ['key' => 'action', 'label' => 'Action'],
    ]"
        :rows="$data['schedules']">

        <x-slot name="filters">
            {{-- ====== Status ====== --}}
            <x-admin.globals.forms.field
                type="select"
                label="Status"
                name="status"
                :svgUrl="asset('assets/svg/tag.svg')">
                <x-slot>
                    <option value="">All</option>
                    <option value="1" @selected(($data['oldInputs']['status'] ?? null)==1)>Active</option>
                    <option value="0" @selected(($data['oldInputs']['status'] ?? null)==0)>Inactive</option>
                </x-slot>
            </x-admin.globals.forms.field>

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Schedule" class="open-modal"
                data-targetModalId="schedule-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>

        @scopedslot('cellstart_time', ($row))
        {{ \Carbon\Carbon::parse($row->start_time)->format('d M Y, h:i A') }}
        @endscopedslot

        @scopedslot('cellend_time', ($row))
        {{ \Carbon\Carbon::parse($row->end_time)->format('d M Y, h:i A') }}
        @endscopedslot


        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('pharmacy-schedule.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('pharmacy-schedule.delete')">
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

<x-admin.globals.modal id="schedule-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Pharmacy Schedule</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="schedule-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('pharmacy-schedule.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== Days ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Days"
                    name="days"
                    required
                    placeholder="Enter Days (e.g. Sunday - Friday)"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Start Time ====== --}}
                <x-admin.globals.forms.field
                    type="datetime-local"
                    label="Start Time"
                    name="start_time"
                    required
                    :svgUrl="asset('assets/svg/clock.svg')" />

                {{-- ====== End Time ====== --}}
                <x-admin.globals.forms.field
                    type="datetime-local"
                    label="End Time"
                    name="end_time"
                    required
                    :svgUrl="asset('assets/svg/clock.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Sort Order ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Sort Order"
                    name="sort"
                    min="0"
                    placeholder="Enter Sort Value"
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection