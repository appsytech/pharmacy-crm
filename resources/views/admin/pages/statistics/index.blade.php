@extends('admin.layouts.main')
@section('title', 'Statistic')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Statistic', 'active' => true]]" />
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
        :filterFormAction="route('statistic.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],

        ['key' => 'type', 'label' => 'Type'],
        ['key' => 'value', 'label' => 'Total'],

        [
            'key' => 'status',
            'label' => 'Status',
            'type' => 'toggle',              // toggle switch instead of badge
            'route' => 'statistic.status.update', // URL to update status
            'idKey' => 'id'
        ],
    ]"
        :rows="$data['statistics']">

        <x-slot name="filters">
            {{-- ====== Status ====== --}}
            <x-admin.globals.forms.field
                type="select"
                label="Status"
                name="status"
                :svgUrl="asset('assets/svg/tag.svg')">
                <x-slot>
                    <option value="">All</option>
                    <option value="1" {{ isset($data['oldInputs']['status']) && $data['oldInputs']['status'] == '1' ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ isset($data['oldInputs']['status']) && $data['oldInputs']['status'] == '0' ? 'selected' : ''}}>Inactive</option>
                </x-slot>
            </x-admin.globals.forms.field>

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Statistic" class="open-modal"
                data-targetModalId="statistic-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>


        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('gallery.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('gallery.delete')">
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

<x-admin.globals.modal id="statistic-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Statistic</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="statistic-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('statistic.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== Type ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Type"
                    name="type"
                    required
                    :svgUrl="asset('assets/svg/layers.svg')">
                    <x-slot>
                        <option value="PATIENT">Patient</option>
                        <option value="DOCTORS">Doctors</option>
                        <option value="HEALTH-CHECK-UP">Health Check Up</option>
                        <option value="AWARD">Award</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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