@extends('admin.layouts.main')
@section('title', 'Pharmacy Branch')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Pharmacy Branch', 'active' => true]]" />
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
        :filterFormAction="route('pharmacy-branch.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],
        ['key' => 'code', 'label' => 'Branch Code'],
        ['key' => 'name', 'label' => 'Branch Name'],
        ['key' => 'phone', 'label' => 'Phone'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'action', 'label' => 'Action'],
    ]"
        :rows="$data['branches']">

        <x-slot name="filters">
            <!-- Name Filter -->
            <x-admin.globals.forms.field
                type="text"
                label="Branch Name"
                name="name"
                value="{{ $data['oldInputs']['name'] ?? '' }}"
                :svgUrl="asset('assets/svg/building.svg')"
                placeholder="Enter Branch Name" />

            <!-- Status Filter -->
            <x-admin.globals.forms.field
                type="select"
                label="Status"
                name="status"
                :svgUrl="asset('assets/svg/tag.svg')"
                value="{{ $data['oldInputs']['status'] ?? '' }}">
                <option value="">All Status</option>
                <option value="ACTIVE"
                    {{ ($data['oldInputs']['status'] ?? '') === 'ACTIVE' ? 'selected' : '' }}>
                    Active
                </option>
                <option value="INACTIVE"
                    {{ ($data['oldInputs']['status'] ?? '') === 'INACTIVE' ? 'selected' : '' }}>
                    Inactive
                </option>
            </x-admin.globals.forms.field>


            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Branch" class="open-modal"
                data-targetModalId="pharmacy-branch-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>



        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('pharmacy-branch.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('pharmacy-branch.delete')">
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

<x-admin.globals.modal id="pharmacy-branch-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Pharmacy Branch</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="pharmacy-branch-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('pharmacy-branch.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                <!-- ====== Code ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Branch Code"
                    name="code"
                    required
                    placeholder="Enter Branch Code"
                    :svgUrl="asset('assets/svg/hash.svg')" />

                <!-- ====== Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Branch Name"
                    name="name"
                    required
                    placeholder="Enter Branch Name"
                    :svgUrl="asset('assets/svg/building.svg')" />

                <!-- ====== Address ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Address"
                    name="address"
                    placeholder="Enter Address"
                    :svgUrl="asset('assets/svg/map-pin.svg')" />

                <!-- ====== Phone ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Phone"
                    name="phone"
                    placeholder="Enter Phone Number"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                <!-- ====== Email ====== -->
                <x-admin.globals.forms.field
                    type="email"
                    label="Email"
                    name="email"
                    placeholder="Enter Email Address"
                    :svgUrl="asset('assets/svg/mail.svg')" />

                <!-- ====== Manager ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Manager ID"
                    name="manager_id"
                    placeholder="Enter Manager ID"
                    :svgUrl="asset('assets/svg/user.svg')" />

                <!-- ====== Status ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    required
                    :svgUrl="asset('assets/svg/shield-check.svg')">
                    <x-slot>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
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