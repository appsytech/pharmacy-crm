@extends('admin.layouts.main')
@section('title', 'Expense')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Expenses', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('expense.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'expense_type_name', 'label' => 'Expense tupe', 'type' => null],
            ['key' => 'image', 'label' => 'Image', 'type' => 'file'],
            ['key' => 'amount', 'label' => 'Amount', 'type' => null],
            ['key' => 'payment_method', 'label' => 'Payment Method', 'type' => null],
            ['key' => 'description', 'label' => 'Description', 'type' => null],
            ['key' => 'paid_to', 'label' => 'Paid To', 'type' => null],
            ['key' => 'expense_date', 'label' => 'Expense Date', 'type' => null],
            ['key' => 'status', 'label' => 'status', 'type' => null],
            ['key' => 'approved_by', 'label' => 'Approved By', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['expenses']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="select" label="status" :svgUrl="asset('assets/svg/tag.svg')" name="status">
                <option value="" selected>All</option>
                <option value="PENDING"
                    {{ ($data['oldInputs']['status'] ?? null) == 'PENDING' ? 'selected' : '' }}>
                    Pending</option>
                <option value="APPROVED"
                    {{ ($data['oldInputs']['status'] ?? null) == 'APPROVED' ? 'selected' : '' }}>
                    Approved</option>
                <option value="PAID"
                    {{ ($data['oldInputs']['status'] ?? null) == 'PAID' ? 'selected' : '' }}>Paid
                </option>
                <option value="REJECTED"
                    {{ ($data['oldInputs']['status'] ?? null) == 'REJECTED' ? 'selected' : '' }}>
                    Rejected</option>
                <option value="CANCELLED"
                    {{ ($data['oldInputs']['status'] ?? null) == 'CANCELLED' ? 'selected' : '' }}>
                    Cancelled</option>
            </x-admin.globals.forms.field>


            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Expense" class="open-modal"
                data-targetModalId="expense-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>




        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('expense.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />
        </div>
        @endscopedslot

    </x-admin.globals.tables.table>
</div>

<x-admin.globals.modal id="expense-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Expense</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="expense-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('expense.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== Expense type  ====== --}}
                <x-admin.globals.forms.field type="select" label="Expense type" name="expense_type_name" required
                    :svgUrl="asset('assets/svg/layers.svg')">
                    <x-slot>
                        <option value="" selected>--select--</option>
                        @foreach ($data['expenseTypes'] ?? [] as $type)
                        <option value="{{ $type->name }}">{{ $type->name }}</option>
                        @endforeach
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Amount ====== --}}
                <x-admin.globals.forms.field type="number" label="Amount" placeholder="Enter Amount" name="amount" required
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />


                {{-- ====== Payment Method  ====== --}}
                <x-admin.globals.forms.field id="payment_type" class="toggle-voucher-requirement" type="select" label="Payment Method" name="payment_method" required
                    :svgUrl="asset('assets/svg/wallet.svg')">
                    <x-slot>
                        <option value="CASH">Cash</option>
                        <option value="BANK">Bank</option>
                        <option value="ONLINE">Online</option>
                        <option value="CHEQUE">Cheque</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Paid to ====== --}}
                <x-admin.globals.forms.field type="text" label="Paid To" name="paid_to" placeholder="Paid to peron name"
                    :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Expense Date ====== --}}
                <x-admin.globals.forms.field type="date" label="Expense Date" name="expense_date" required
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="PENDING">Pending</option>
                        <option value="APPROVED">Approved</option>
                        <option value="PAID">Paid</option>
                        <option value="REJECTED">Rejected</option>
                        <option value="CANCELLED">Cancelled</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field id="voucherInput" type="file" class="image-upload&preview" label="Upload Image" name="image"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field type="textarea" label="Description" name="description" placeholder="Enter Description"
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