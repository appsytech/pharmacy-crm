@extends('admin.layouts.main')
@section('title', 'Medcine')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Medicine', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('medicine.index')" :columns="[
        ['key' => 'sn', 'label' => 'S.N', 'type' => null],
        ['key' => 'name', 'label' => 'Medicine Name', 'type' => null],
        ['key' => 'generic_name', 'label' => 'Generic Name', 'type' => null],
        ['key' => 'brand_name', 'label' => 'Brand Name', 'type' => null],
        ['key' => 'manufacturer_name', 'label' => 'Manufacturer', 'type' => null],
        ['key' => 'supplier_name', 'label' => 'Supplier', 'type' => null],
        ['key' => 'category', 'label' => 'Category', 'type' => null],
        ['key' => 'dosage_form', 'label' => 'Dosage Form', 'type' => null],
        ['key' => 'strength', 'label' => 'Strength', 'type' => null],
        ['key' => 'batch_number', 'label' => 'Batch Number', 'type' => null],
        ['key' => 'manufacturing_date', 'label' => 'Manufacturing Date', 'type' => null],
        ['key' => 'expiry_date', 'label' => 'Expiry Date', 'type' => null],
        ['key' => 'purchase_price', 'label' => 'Purchase Price', 'type' => null],
        ['key' => 'selling_price', 'label' => 'Selling Price', 'type' => null],
        ['key' => 'stock_quantity', 'label' => 'Stock Quantity', 'type' => null],
        ['key' => 'alert_quantity', 'label' => 'Alert Quantity', 'type' => null],
        ['key' => 'storage_type', 'label' => 'Storage Type', 'type' => null],
        ['key' => 'shelf_location', 'label' => 'Shelf Location', 'type' => null],
        ['key' => 'rack_number', 'label' => 'Rack Number', 'type' => null],
        ['key' => 'action', 'label' => 'Action', 'type' => null],
    ]" :rows="$data['medicines']">


        <x-slot name="filters">

            <!-- Medicine Name Filter -->
            <x-admin.globals.forms.field
                type="text"
                label="Medicine Name"
                value="{{ $data['oldInputs']['name'] ?? '' }}"
                :svgUrl="asset('assets/svg/package.svg')"
                name="name"
                placeholder="Enter Medicine Name" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Medicine" class="open-modal"
                data-targetModalId="medicine-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>



        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('medicine.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('medicine.delete')">
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

<x-admin.globals.modal id="medicine-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Medicine</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="medicine-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('medicine.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                <!-- ====== Supplier ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Supplier"
                    name="supplier_id"
                    required
                    :svgUrl="asset('assets/svg/building.svg')">
                    @foreach($data['suppliers'] ?? [] as $supplier)
                    <option value="{{ $supplier->id }}"> {{ $supplier->supplier_name ?? ''}}</option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!-- ====== Manufacturer ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Manufacturer"
                    name="manufacturer_id"
                    required
                    :svgUrl="asset('assets/svg/building.svg')"
                    data-options='@json($ ?? [])'>
                    @foreach($data['manufacturers'] ?? [] as $manufacturer)
                    <option value="{{ $manufacturer->id }}"> {{ $manufacturer->manufacturer_name ?? ''}}</option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!-- ====== Medicine Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Medicine Name"
                    name="name"
                    required
                    placeholder="Enter Medicine Name"
                    :svgUrl="asset('assets/svg/pill.svg')" />

                <!-- ====== Generic Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Generic Name"
                    name="generic_name"
                    placeholder="Enter Generic Name"
                    :svgUrl="asset('assets/svg/pill.svg')" />

                <!-- ====== Brand Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Brand Name"
                    name="brand_name"
                    placeholder="Enter Brand Name"
                    :svgUrl="asset('assets/svg/tag.svg')" />

                <!-- ====== Category ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Category"
                    name="category"
                    placeholder="Enter Category"
                    :svgUrl="asset('assets/svg/layers.svg')" />

                <!-- ====== Dosage Form ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Dosage Form"
                    name="dosage_form"
                    placeholder="Enter Dosage Form"
                    :svgUrl="asset('assets/svg/pill-bottle.svg')" />

                <!-- ====== Strength ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Strength"
                    name="strength"
                    placeholder="Enter Strength"
                    :svgUrl="asset('assets/svg/activity.svg')" />

                <!-- ====== Batch Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Batch Number"
                    name="batch_number"
                    required
                    placeholder="Enter Batch Number"
                    :svgUrl="asset('assets/svg/code.svg')" />

                <!-- ====== Manufacturing Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Manufacturing Date"
                    name="manufacturing_date"
                    placeholder="Select Manufacturing Date"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                <!-- ====== Expiry Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Expiry Date"
                    name="expiry_date"
                    placeholder="Select Expiry Date"
                    :svgUrl="asset('assets/svg/calendar-check.svg')" />

                <!-- ====== Purchase Price ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Purchase Price"
                    name="purchase_price"
                    required
                    placeholder="Enter Purchase Price"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                <!-- ====== Selling Price ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Selling Price"
                    name="selling_price"
                    required
                    placeholder="Enter Selling Price"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                <!-- ====== Stock Quantity ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Stock Quantity"
                    name="stock_quantity"
                    placeholder="Enter Stock Quantity"
                    :svgUrl="asset('assets/svg/archive.svg')" />

                <!-- ====== Alert Quantity ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Alert Quantity"
                    name="alert_quantity"
                    placeholder="Enter Alert Quantity"
                    :svgUrl="asset('assets/svg/circle-alert.svg')" />

                <!-- ====== Storage Type ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Storage Type"
                    name="storage_type"
                    :svgUrl="asset('assets/svg/package.svg')">
                    <x-slot>
                        <option value="ROOM-TEMPERATURE">Room Temperature</option>
                        <option value="REFRIGERATED">Refrigerated</option>
                        <option value="FROZEN">Frozen</option>
                        <option value="PROTECT-FROM-LIGHT">Protect From Light</option>
                        <option value="KEEP-IN-DRY-PLACE">Keep In Dry Place</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <!-- ====== Shelf Location ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Shelf Location"
                    name="shelf_location"
                    placeholder="Enter Shelf Location"
                    :svgUrl="asset('assets/svg/layout-grid.svg')" />

                <!-- ====== Rack Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Rack Number"
                    name="rack_number"
                    placeholder="Enter Rack Number"
                    :svgUrl="asset('assets/svg/layout-grid.svg')" />

                <!-- ====== Description ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Description"
                    name="description"
                    placeholder="Enter Description"
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