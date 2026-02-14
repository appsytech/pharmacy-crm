@extends('admin.layouts.main')
@section('title', 'Medicine')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Medicine', 'url' => route('medicine.index')],['label' => 'Edit Medicine', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('medicine.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                <!-- ====== Supplier ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Supplier"
                    name="supplier_id"
                    required
                    :svgUrl="asset('assets/svg/building.svg')">
                    @foreach($data['suppliers'] ?? [] as $supplier)
                    <option value="{{ $supplier->id }}" {{ ($data['medicine']->supplier_id ?? null) == $supplier->id ? 'selected' : '' }}> {{ $supplier->supplier_name ?? ''}}</option>
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
                    <option value="{{ $manufacturer->id }}" {{ ($data['medicine']->manufacturer_id ?? null) == $manufacturer->id ? 'selected' : '' }}> {{ $manufacturer->manufacturer_name ?? ''}}</option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!-- ====== Medicine Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Medicine Name"
                    name="name"
                    value="{{ $data['medicine']->name ?? '' }}"
                    required
                    placeholder="Enter Medicine Name"
                    :svgUrl="asset('assets/svg/pill.svg')" />

                <!-- ====== Generic Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Generic Name"
                    value="{{ $data['medicine']->generic_name ?? '' }}"
                    name="generic_name"
                    placeholder="Enter Generic Name"
                    :svgUrl="asset('assets/svg/pill.svg')" />

                <!-- ====== Brand Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Brand Name"
                    name="brand_name"
                    value="{{ $data['medicine']->brand_name ?? '' }}"
                    placeholder="Enter Brand Name"
                    :svgUrl="asset('assets/svg/tag.svg')" />

                <!-- ====== Category ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Category"
                    name="category"
                    value="{{ $data['medicine']->category ?? '' }}"
                    placeholder="Enter Category"
                    :svgUrl="asset('assets/svg/layers.svg')" />

                <!-- ====== Dosage Form ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Dosage Form"
                    name="dosage_form"
                    value="{{ $data['medicine']->dosage_form ?? '' }}"
                    placeholder="Enter Dosage Form"
                    :svgUrl="asset('assets/svg/pill-bottle.svg')" />

                <!-- ====== Strength ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Strength"
                    name="strength"
                    value="{{ $data['medicine']->strength ?? '' }}"
                    placeholder="Enter Strength"
                    :svgUrl="asset('assets/svg/activity.svg')" />

                <!-- ====== Batch Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Batch Number"
                    name="batch_number"
                    value="{{ $data['medicine']->batch_number ?? '' }}"
                    required
                    placeholder="Enter Batch Number"
                    :svgUrl="asset('assets/svg/code.svg')" />

                <!-- ====== Manufacturing Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Manufacturing Date"
                    name="manufacturing_date"
                    value="{{ $data['medicine']->manufacturing_date ?? '' }}"
                    placeholder="Select Manufacturing Date"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                <!-- ====== Expiry Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Expiry Date"
                    name="expiry_date"
                    value="{{ $data['medicine']->expiry_date ?? '' }}"
                    placeholder="Select Expiry Date"
                    :svgUrl="asset('assets/svg/calendar-check.svg')" />

                <!-- ====== Purchase Price ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Purchase Price"
                    name="purchase_price"
                    value="{{ $data['medicine']->purchase_price ?? '' }}"
                    required
                    placeholder="Enter Purchase Price"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                <!-- ====== Selling Price ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Selling Price"
                    name="selling_price"
                    value="{{ $data['medicine']->selling_price ?? '' }}"
                    required
                    placeholder="Enter Selling Price"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                <!-- ====== Stock Quantity ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Stock Quantity"
                    name="stock_quantity"
                    value="{{ $data['medicine']->stock_quantity ?? '' }}"
                    placeholder="Enter Stock Quantity"
                    :svgUrl="asset('assets/svg/archive.svg')" />

                <!-- ====== Alert Quantity ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Alert Quantity"
                    name="alert_quantity"
                    value="{{ $data['medicine']->alert_quantity ?? '' }}"
                    placeholder="Enter Alert Quantity"
                    :svgUrl="asset('assets/svg/circle-alert.svg')" />

                <!-- ====== Storage Type ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Storage Type"
                    name="storage_type"
                    :svgUrl="asset('assets/svg/package.svg')">
                    <x-slot>
                        <option value="ROOM-TEMPERATURE"
                            {{ ($data['medicine']->storage_type ?? null) == 'ROOM-TEMPERATURE' ? 'selected' : '' }}>
                            Room Temperature
                        </option>

                        <option value="REFRIGERATED"
                            {{ ($data['medicine']->storage_type ?? null) == 'REFRIGERATED' ? 'selected' : '' }}>
                            Refrigerated
                        </option>

                        <option value="FROZEN"
                            {{ ($data['medicine']->storage_type ?? null) == 'FROZEN' ? 'selected' : '' }}>
                            Frozen
                        </option>

                        <option value="PROTECT-FROM-LIGHT"
                            {{ ($data['medicine']->storage_type ?? null) == 'PROTECT-FROM-LIGHT' ? 'selected' : '' }}>
                            Protect From Light
                        </option>

                        <option value="KEEP-IN-DRY-PLACE"
                            {{ ($data['medicine']->storage_type ?? null) == 'KEEP-IN-DRY-PLACE' ? 'selected' : '' }}>
                            Keep In Dry Place
                        </option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <!-- ====== Shelf Location ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Shelf Location"
                    name="shelf_location"
                    value="{{ $data['medicine']->shelf_location ?? '' }}"
                    placeholder="Enter Shelf Location"
                    :svgUrl="asset('assets/svg/layout-grid.svg')" />

                <!-- ====== Rack Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Rack Number"
                    name="rack_number"
                    value="{{ $data['medicine']->rack_number ?? '' }}"
                    placeholder="Enter Rack Number"
                    :svgUrl="asset('assets/svg/layout-grid.svg')" />

                <!-- ====== Description ====== -->
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Description"
                    name="description"
                    value="{{ $data['medicine']->description ?? '' }}"
                    placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['medicine']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('medicine.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection