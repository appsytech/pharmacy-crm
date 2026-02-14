@extends('admin.layouts.main')
@section('title', 'Expense Types')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Expense Type', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('expense-type.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'name', 'label' => 'Name', 'type' => null],
            ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
            ['key' => 'created_at', 'label' => 'Created At', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['expenseTypes']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="Name" value="{{ isset($data['oldInputs']['name']) ? $data['oldInputs']['name'] : '' }}" :svgUrl="asset('assets/svg/hash.svg')" name="name"
                placeholder="Enter Name" />


            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Expense Type" class="open-modal"
                data-targetModalId="expense-type-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>




        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('expense-type.delete')">
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

<x-admin.globals.modal id="expense-type-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Expense type</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="expense-type-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('expense-type.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== name ====== --}}
                <x-admin.globals.forms.field type="text" label="Name" name="name" required
                    placeholder="Enter Name" :svgUrl="asset('assets/svg/hash.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
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