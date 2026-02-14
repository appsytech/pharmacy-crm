@extends('admin.layouts.main')
@section('title', 'Manufacturer')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Manufacturer', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('manufacturer.index')" :columns="[
    ['key' => 'sn', 'label' => 'S.N', 'type' => null],
    ['key' => 'manufacturer_name', 'label' => 'Manufacturer Name', 'type' => null],
    ['key' => 'contact_person', 'label' => 'Contact Person', 'type' => null],
    ['key' => 'phone', 'label' => 'Phone', 'type' => null],
    ['key' => 'email', 'label' => 'Email', 'type' => null],
    ['key' => 'address', 'label' => 'Address', 'type' => null],
    ['key' => 'city', 'label' => 'City', 'type' => null],
    ['key' => 'state', 'label' => 'State', 'type' => null],
    ['key' => 'country', 'label' => 'Country', 'type' => null],
    ['key' => 'license_number', 'label' => 'License Number', 'type' => null],
    ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
    ['key' => 'action', 'label' => 'Action', 'type' => null],
]" :rows="$data['manufacturers']">

        <x-slot name="filters">
            <x-admin.globals.forms.field
                type="text"
                label="Manufacturer Name"
                value="{{ $data['oldInputs']['manufacturer_name'] ?? '' }}"
                :svgUrl="asset('assets/svg/building.svg')"
                name="manufacturer_name"
                placeholder="Enter Manufacturer Name" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Manufacturer" class="open-modal"
                data-targetModalId="manufacturer-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>



        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('manufacturer.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('manufacturer.delete')">
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

<x-admin.globals.modal id="manufacturer-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Manufacturer</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="manufacturer-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('manufacturer.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                <!-- ====== Manufacturer Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Manufacturer Name"
                    name="manufacturer_name"
                    required
                    placeholder="Enter Manufacturer Name"
                    :svgUrl="asset('assets/svg/building.svg')" />

                <!-- ====== Contact Person ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Contact Person"
                    name="contact_person"
                    placeholder="Enter Contact Person Name"
                    :svgUrl="asset('assets/svg/user-check.svg')" />

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

                <!-- ====== Address ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Address"
                    name="address"
                    placeholder="Enter Address"
                    :svgUrl="asset('assets/svg/map-pin.svg')" />

                <!-- ====== City ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="City"
                    name="city"
                    placeholder="Enter City"
                    :svgUrl="asset('assets/svg/map.svg')" />

                <!-- ====== State ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="State"
                    name="state"
                    placeholder="Enter State"
                    :svgUrl="asset('assets/svg/map-minus.svg')" />

                <!-- ====== Country ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Country"
                    name="country"
                    placeholder="Enter Country"
                    :svgUrl="asset('assets/svg/globe.svg')" />

                <!-- ====== License Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="License Number"
                    name="license_number"
                    placeholder="Enter License Number"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

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