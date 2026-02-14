@extends('admin.layouts.main')
@section('title', 'Supplier')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Supplier', 'url' => route('supplier.index')],['label' => 'Edit Supplier', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('supplier.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                <!-- ====== Supplier Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Supplier Name"
                    name="supplier_name"
                    value="{{ $data['supplier']->supplier_name ?? '' }}"
                    required
                    placeholder="Enter Supplier Name"
                    :svgUrl="asset('assets/svg/truck.svg')" />

                <!-- ====== Contact Person ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Contact Person"
                    name="contact_person"
                    value="{{ $data['supplier']->contact_person ?? '' }}"
                    placeholder="Enter Contact Person Name"
                    :svgUrl="asset('assets/svg/user-check.svg')" />

                <!-- ====== Phone ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Phone"
                    name="phone"
                    value="{{ $data['supplier']->phone ?? '' }}"
                    required
                    placeholder="Enter Phone Number"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                <!-- ====== Email ====== -->
                <x-admin.globals.forms.field
                    type="email"
                    label="Email"
                    name="email"
                    value="{{ $data['supplier']->email ?? '' }}"
                    placeholder="Enter Email Address"
                    :svgUrl="asset('assets/svg/mail.svg')" />

                <!-- ====== Address ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Address"
                    name="address"
                    value="{{ $data['supplier']->address ?? '' }}"
                    placeholder="Enter Address"
                    :svgUrl="asset('assets/svg/map-pin.svg')" />

                <!-- ====== City ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="City"
                    name="city"
                    value="{{ $data['supplier']->city ?? '' }}"
                    placeholder="Enter City"
                    :svgUrl="asset('assets/svg/map.svg')" />

                <!-- ====== State ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="State"
                    name="state"
                    value="{{ $data['supplier']->state ?? '' }}"
                    placeholder="Enter State"
                    :svgUrl="asset('assets/svg/map-minus.svg')" />

                <!-- ====== Country ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Country"
                    name="country"
                    value="{{ $data['supplier']->country ?? '' }}"
                    placeholder="Enter Country"
                    :svgUrl="asset('assets/svg/globe.svg')" />

                <!-- ====== Supplier Business Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Business Number"
                    name="supplier_business_number"
                    value="{{ $data['supplier']->supplier_business_number ?? '' }}"
                    placeholder="Enter PAN/VAT Number"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                <!-- ====== Payment Terms ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Payment Terms"
                    name="payment_terms"
                    value="{{ $data['supplier']->payment_terms ?? '' }}"
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
                        <option value="ACTIVE" {{ ($data['supplier']->status ?? null) == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                        <option value="INACTIVE" {{ ($data['supplier']->status ?? null) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['supplier']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('supplier.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection