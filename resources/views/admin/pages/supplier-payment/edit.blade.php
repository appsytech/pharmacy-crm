@extends('admin.layouts.main')
@section('title', 'Supplier Payment')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Supplier Payment', 'url' => route('supplier-payment.index')],['label' => 'Edit Supplier Payment', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('supplier-payment.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                <!-- ====== Voucher Number ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Voucher Number"
                    name="voucher_number"
                    value="{{ $data['payment']->voucher_number ?? '' }}"
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
                    <option value="{{ $supplier->id }}" {{ ($data['payment']->supplier_id ?? null) == $supplier->id ? 'selected'  : ''  }}>{{ $supplier->supplier_name ?? '' }}</option>
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
                    <option value="{{ $branch->id }}" {{ ($data['payment']->pharmacy_branch_id ?? null) == $branch->id ? 'selected'  : ''  }}>{{ $branch->name ?? '' }}</option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!-- ====== Payment Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Payment Date"
                    name="payment_date"
                    value="{{ $data['payment']->payment_date ?? '' }}"
                    required
                    :svgUrl="asset('assets/svg/calendar-days.svg')" />

                <!-- ====== Amount ====== -->
                <x-admin.globals.forms.field
                    type="number"
                    label="Amount"
                    name="amount"
                    value="{{ $data['payment']->amount ?? '' }}"
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
                        <option value="CASH" {{ ($data['payment']->payment_method ?? null) == 'CASH' ? 'selected'  : ''  }}>Cash</option>
                        <option value="BANK_TRANSFER" {{ ($data['payment']->payment_method ?? null) == 'BANK_TRANSFER' ? 'selected'  : ''  }}>Bank Transfer</option>
                        <option value="CHEQUE" {{ ($data['payment']->payment_method ?? null) == 'CHEQUE' ? 'selected'  : ''  }}>Cheque</option>
                        <option value="UPI" {{ ($data['payment']->payment_method ?? null) == 'UPI' ? 'selected'  : ''  }}> UPI</option>
                        <option value="CARD" {{ ($data['payment']->payment_method ?? null) == 'CARD' ? 'selected'  : ''  }}>Card</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <!-- ====== Payment Reference ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Payment Reference"
                    name="payment_reference"
                    value="{{ $data['payment']->payment_reference ?? '' }}"
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
                        <option value="PENDING" {{ ($data['payment']->status ?? null) == 'PENDING' ? 'selected'  : ''  }}>Pending</option>
                        <option value="COMPLETED" {{ ($data['payment']->status ?? null) == 'COMPLETED' ? 'selected'  : ''  }}>Completed</option>
                        <option value="FAILED" {{ ($data['payment']->status ?? null) == 'FAILED' ? 'selected'  : ''  }}>Failed</option>
                        <option value="CANCELLED" {{ ($data['payment']->status ?? null) == 'CANCELLED' ? 'selected'  : ''  }}>Cancelled</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <!-- ====== Description ====== -->
                <x-admin.globals.forms.field
                    type="text"
                    label="Description"
                    name="description"
                    value="{{ $data['payment']->description ?? '' }}"
                    placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                <!-- ====== Payment Due Date ====== -->
                <x-admin.globals.forms.field
                    type="date"
                    label="Payment Due Date"
                    value="{{ $data['payment']->payment_due_date ?? '' }}"
                    name="payment_due_date"
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['payment']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('supplier-payment.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection