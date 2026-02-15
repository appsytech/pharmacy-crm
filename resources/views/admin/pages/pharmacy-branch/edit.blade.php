@extends('admin.layouts.main')
@section('title', 'Pharmacy Branch')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Pharmacy Branch', 'url' => route('pharmacy-branch.index')],['label' => 'Edit Pharmacy Branch', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('pharmacy-branch.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                <!-- ====== Code ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Branch Code"
                    name="code"
                    value="{{ $data['branch']->code ?? '' }}"
                    required
                    placeholder="Enter Branch Code"
                    :svgUrl="asset('assets/svg/hash.svg')" />

                <!-- ====== Name ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Branch Name"
                    name="name"
                    value="{{ $data['branch']->name ?? '' }}"
                    required
                    placeholder="Enter Branch Name"
                    :svgUrl="asset('assets/svg/building.svg')" />

                <!-- ====== Address ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Address"
                    name="address"
                    value="{{ $data['branch']->address ?? '' }}"
                    placeholder="Enter Address"
                    :svgUrl="asset('assets/svg/map-pin.svg')" />

                <!-- ====== Phone ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Phone"
                    value="{{ $data['branch']->phone ?? '' }}"
                    name="phone"
                    placeholder="Enter Phone Number"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                <!-- ====== Email ====== -->
                <x-admin.globals.forms.field
                    type="email"
                    label="Email"
                    value="{{ $data['branch']->email ?? '' }}"
                    name="email"
                    placeholder="Enter Email Address"
                    :svgUrl="asset('assets/svg/mail.svg')" />

                <!-- ====== Manager ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Manager ID"
                    name="manager_id"
                    value="{{ $data['branch']->manager_id ?? '' }}"
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
                        <option value="ACTIVE" {{  ($data['branch']->status ?? null) == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                        <option value="INACTIVE" {{  ($data['branch']->status ?? null) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['branch']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('supplier.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection