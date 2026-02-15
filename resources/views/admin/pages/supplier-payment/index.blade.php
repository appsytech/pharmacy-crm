@extends('admin.layouts.main')
@section('title', 'Supplier Payment')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Supplier Payment', 'active' => true]]" />
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
        :filterFormAction="route('supplier-payment.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],
        ['key' => 'voucher_number', 'label' => 'Voucher No'],
        ['key' => 'supplier_name', 'label' => 'Supplier'],
        ['key' => 'pharmacy_branch_name', 'label' => 'Branch'],
        ['key' => 'payment_date', 'label' => 'Payment Date'],
        ['key' => 'amount', 'label' => 'Amount'],
        ['key' => 'payment_method', 'label' => 'Method'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'action', 'label' => 'Action'],
    ]"
        :rows="$data['payments']">

        <x-slot name="filters">

            <!-- Voucher Number -->
            <x-admin.globals.forms.field
                type="text"
                label="Voucher Number"
                name="voucher_number"
                value="{{ $data['oldInputs']['voucher_number'] ?? '' }}"
                :svgUrl="asset('assets/svg/hash.svg')"
                placeholder="Enter Voucher Number" />


            <!-- Status -->
            <x-admin.globals.forms.field
                type="select"
                label="Status"
                name="status"
                :svgUrl="asset('assets/svg/tag.svg')"
                value="{{ $data['oldInputs']['status'] ?? '' }}">
                <option value="">All Status</option>
                <option value="PENDING" {{ ($data['oldInputs']['status'] ?? '') === 'PENDING' ? 'selected' : '' }}>Pending</option>
                <option value="COMPLETED" {{ ($data['oldInputs']['status'] ?? '') === 'COMPLETED' ? 'selected' : '' }}>Completed</option>
                <option value="FAILED" {{ ($data['oldInputs']['status'] ?? '') === 'FAILED' ? 'selected' : '' }}>Failed</option>
                <option value="CANCELLED" {{ ($data['oldInputs']['status'] ?? '') === 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
            </x-admin.globals.forms.field>


            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Payment" class="open-modal"
                data-targetModalId="supplier-payment-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>



        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('supplier-payment.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('supplier-payment.delete')">
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

<x-admin.globals.modal id="supplier-payment-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Supplier Payment</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="supplier-payment-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('supplier-payment.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                <!-- ====== Voucher Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Voucher Number"
                    name="voucher_number"
                    required
                    placeholder="Enter Voucher Number"
                    :svgUrl="asset('assets/svg/receipt.svg')" />

                <!-- ====== Supplier ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Supplier ID"
                    name="supplier_id"
                    required
                    :svgUrl="asset('assets/svg/truck.svg')">
                    @foreach($data['suppliers'] ?? [] as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name ?? '' }}</option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!-- ====== Pharmacy Branch ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Pharmacy Branch ID"
                    name="pharmacy_branch_id"
                    :svgUrl="asset('assets/svg/building.svg')">
                    <option value="">-select-</option>
                    @foreach($data['pharmacyBranches'] ?? [] as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name ?? '' }}</option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!-- ====== Payment Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Payment Date"
                    name="payment_date"
                    required
                    :svgUrl="asset('assets/svg/calendar-days.svg')" />

                <!-- ====== Amount ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Amount"
                    name="amount"
                    required
                    placeholder="Enter Payment Amount"
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                <!-- ====== Payment Method ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Payment Method"
                    name="payment_method"
                    required
                    :svgUrl="asset('assets/svg/credit-card.svg')">
                    <x-slot>
                        <option value="CASH">Cash</option>
                        <option value="BANK_TRANSFER">Bank Transfer</option>
                        <option value="CHEQUE">Cheque</option>
                        <option value="UPI">UPI</option>
                        <option value="CARD">Card</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <!-- ====== Payment Reference ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Payment Reference"
                    name="payment_reference"
                    placeholder="Enter Payment Reference"
                    :svgUrl="asset('assets/svg/hash.svg')" />

                <!-- ====== Status ====== -->
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    required
                    :svgUrl="asset('assets/svg/shield-check.svg')">
                    <x-slot>
                        <option value="PENDING">Pending</option>
                        <option value="COMPLETED">Completed</option>
                        <option value="FAILED">Failed</option>
                        <option value="CANCELLED">Cancelled</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <!-- ====== Description ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Description"
                    name="description"
                    placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                <!-- ====== Payment Due Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Payment Due Date"
                    name="payment_due_date"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection