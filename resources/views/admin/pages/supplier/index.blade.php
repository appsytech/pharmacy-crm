@extends('admin.layouts.main')
@section('title', 'Supplier')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Supplier', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('supplier.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'supplier_name', 'label' => 'Supplier Name', 'type' => null],
            ['key' => 'phone', 'label' => 'Phone', 'type' => null],
            ['key' => 'contact_person', 'label' => 'Contact Person', 'type' => null],
            ['key' => 'email', 'label' => 'Email', 'type' => null],
            ['key' => 'phone', 'label' => 'Phone no', 'type' => null],
            ['key' => 'address', 'label' => 'Address', 'type' => null],
            ['key' => 'status', 'label' => 'Status', 'type' => 'badge' ],
            ['key' => 'supplier_business_number', 'label' => 'Supplier Business Number', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['suppliers']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="Supplier Name" value="{{ isset($data['oldInputs']['supplier_name']) ? $data['oldInputs']['supplier_name'] : '' }}" :svgUrl="asset('assets/svg/truck.svg')" name="supplier_name"
                placeholder="Enter Name" />


            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Supplier" class="open-modal"
                data-targetModalId="supplier-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>



        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('supplier.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('supplier.delete')">
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

<x-admin.globals.modal id="supplier-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Supplier</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="supplier-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('supplier.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                <!-- ====== Supplier Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Supplier Name"
                    name="supplier_name"
                    required
                    placeholder="Enter Supplier Name"
                    :svgUrl="asset('assets/svg/truck.svg')" />

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
                    required
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

                <!-- ====== Supplier Business Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Business Number"
                    name="supplier_business_number"
                    placeholder="Enter PAN/VAT Number"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                <!-- ====== Payment Terms ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Payment Terms"
                    name="payment_terms"
                    placeholder="Enter Payment Terms"
                    :svgUrl="asset('assets/svg/credit-card.svg')" />

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