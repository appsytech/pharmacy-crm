@extends('admin.layouts.main')
@section('title', 'Money Log')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Money Log', 'active' => true]]" />
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
        :filterFormAction="route('log-money.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],
        ['key' => 'type', 'label' => 'Type'],
        ['key' => 'method_type', 'label' => 'Method Type'],
        [
            'key' => 'amount',
            'label' => 'Amount',
        ],

        ['key' => 'payment_method', 'label' => 'Payment Method'],

        ['key' => 'vendor_name', 'label' => 'Vendor Name'],

        [
            'key' => 'transaction_date',
            'label' => 'Transaction Date',
        ],

        ['key' => 'created_by', 'label' => 'Created By'],

        [
            'key' => 'created_at',
            'label' => 'Created At',
        ],
    ]"
        :rows="$data['logs']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['email']) ? $data['oldInputs']['email'] : '' }}" label="Email" :svgUrl="asset('assets/svg/mail.svg')" name="email" placeholder="Search by Email" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />

        </x-slot>

    </x-admin.globals.tables.table>
</div>

@endsection