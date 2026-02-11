@extends('admin.layouts.main')
@section('title', 'Dashboard')


@section('breadcrumb')
    <x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Medicine List', 'active' => true]]" />
@endsection

@section('content')

    <div class="py-5">
        <x-admin.globals.tables.table :columns="[
            ['key' => 's.n', 'label' => 'S.N', 'type' => null],
            ['key' => 'column1', 'label' => 'column1', 'type' => null],
            ['key' => 'column1', 'label' => 'column2', 'type' => null],
            ['key' => 'column1', 'label' => 'column3', 'type' => null],
            ['key' => 'column1', 'label' => 'column4', 'type' => null],
            ['key' => 'column1', 'label' => 'column5', 'type' => null],
            ['key' => 'column1', 'label' => 'column6', 'type' => null],
            ['key' => 'column1', 'label' => 'column7', 'type' => null],
        ]">

            <x-slot name="filters">
                <x-admin.globals.forms.field type="text" label="Medicine Name" :svgUrl="asset('assets/svg/pill.svg')" name="medicine_name"
                    placeholder="Enter Medicine Name" />
                <x-admin.globals.forms.field type="text" label="Formula" :svgUrl="asset('assets/svg/sigma.svg')" name="formula"
                    placeholder="Enter Medicine Formula" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
                <x-admin.buttons.secondary type="button" label="Add Medicine" class="open-modal"
                    data-targetModalId="medicine-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
            </x-slot>


        </x-admin.globals.tables.table>
    </div>

    <x-admin.globals.modal id="medicine-add-modal">

        <x-slot name="header">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Add New Medicine List</h2>
                <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
            </div>
            <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="medicine-add-modal"
                :svgUrl="asset('assets/svg/cross.svg')" />
        </x-slot>

        <x-slot name="body">
            <x-admin.globals.forms.form>

                <x-slot name="fields">
                    {{-- ====== medicine name ====== --}}
                    <x-admin.globals.forms.field type="text" label="Medicine Name" name="medicine_name"
                        placeholder="Enter Medicine Name" :svgUrl="asset('assets/svg/pill.svg')" />

                    {{-- ====== medicine Formula ====== --}}
                    <x-admin.globals.forms.field type="text" label="Medicine Formula" name="formula"
                        placeholder="Enter Medicine Formula" :svgUrl="asset('assets/svg/sigma.svg')" />

                    {{-- ====== Company Name ====== --}}
                    <x-admin.globals.forms.field type="text" label="Company Name" name="formula"
                        placeholder="Enter Company Name" :svgUrl="asset('assets/svg/sigma.svg')" />

                    {{-- ====== Table No ====== --}}
                    <x-admin.globals.forms.field type="text" label="Table No" name="formula" placeholder="Enter Table No"
                        :svgUrl="asset('assets/svg/sigma.svg')" />

                    {{-- ====== Rack No ====== --}}
                    <x-admin.globals.forms.field type="text" label="Table No" name="formula" placeholder="Enter Table No"
                        :svgUrl="asset('assets/svg/sigma.svg')" />

                    {{-- ====== Total Quantity ====== --}}
                    <x-admin.globals.forms.field type="number" label="Total Quantity" name="formula"
                        placeholder="Enter Total quantity" :svgUrl="asset('assets/svg/sigma.svg')" />

                    {{-- ====== Sell Price ====== --}}
                    <x-admin.globals.forms.field type="number" label="Sell Price" name="formula"
                        placeholder="Enter Total quantity" :svgUrl="asset('assets/svg/sigma.svg')" />
                </x-slot>

                <x-slot name="action_buttons">
                    <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                    <x-admin.globals.buttons.quaternary class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
                </x-slot>


            </x-admin.globals.forms.form>
        </x-slot>
    </x-admin.globals.modal>

@endsection
