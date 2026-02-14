@extends('admin.layouts.main')
@section('title', 'staff Salaries')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Staff Salary', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('staff-salary.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'staff_name', 'label' => 'staff Name', 'type' => null],
            ['key' => 'academic_year', 'label' => 'Academic Year', 'type' => null],
            ['key' => 'month', 'label' => 'Month', 'type' => null],
            ['key' => 'base_salary', 'label' => 'Base Salary', 'type' => null],
            ['key' => 'bonuses', 'label' => 'Bonus', 'type' => null],
            ['key' => 'tax_amount', 'label' => 'Tax Amount', 'type' => null],
            ['key' => 'advances', 'label' => 'Advance', 'type' => null],
            ['key' => 'total_salary', 'label' => 'Total Salary', 'type' => null],
            ['key' => 'paid_amount', 'label' => 'Paid Amount', 'type' => null],
            ['key' => 'remaining_amount', 'label' => 'Remaining Amount', 'type' => null],
            ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['staffSalaries']">

        <x-slot name="filters">
            <!-- Staff filter -->
            <x-admin.globals.forms.field type="select" label="Staff" :svgUrl="asset('assets/svg/user-check.svg')" name="staff_id">
                <option value="" selected>All</option>
                @foreach ($data['staffs'] ?? [] as $staff)
                <option value="{{ $staff->id }}"
                    {{ $staff->id == ($data['oldInputs']['staff_id'] ?? 0) ? 'selected' : '' }}>
                    {{ $staff->full_name }}
                </option>
                @endforeach
            </x-admin.globals.forms.field>

            <!-- Academic Year -->
            <x-admin.globals.forms.field label="Academic Year" type="text" placeholder="yyyy-yyyy" name="academic_year"
                value="{{ $data['oldInputs']['academic_year'] ?? '' }}" :svgUrl="asset('assets/svg/calendar.svg')" />

            <!--====== Month  ======-->
            <x-admin.globals.forms.field type="select" label="Month" :svgUrl="asset('assets/svg/calendar-digit.svg')" name="month">
                <option value="" selected>All</option>
                <option value="1"
                    {{ ($data['oldInputs']['month'] ?? null) == '1' ? 'selected' : '' }}>
                    January</option>
                <option value="2"
                    {{ ($data['oldInputs']['month'] ?? null) == '2' ? 'selected' : '' }}>
                    February</option>
                <option value="3"
                    {{ ($data['oldInputs']['month'] ?? null) == '3' ? 'selected' : '' }}>
                    March</option>
                <option value="4"
                    {{ ($data['oldInputs']['month'] ?? null) == '4' ? 'selected' : '' }}>
                    April</option>
                <option value="5"
                    {{ ($data['oldInputs']['month'] ?? null) == '5' ? 'selected' : '' }}>
                    May
                </option>
                <option value="6"
                    {{ ($data['oldInputs']['month'] ?? null) == '6' ? 'selected' : '' }}>
                    June
                </option>
                <option value="7"
                    {{ ($data['oldInputs']['month'] ?? null) == '7' ? 'selected' : '' }}>
                    July
                </option>
                <option value="8"
                    {{ ($data['oldInputs']['month'] ?? null) == '8' ? 'selected' : '' }}>
                    August</option>
                <option value="9"
                    {{ ($data['oldInputs']['month'] ?? null) == '9' ? 'selected' : '' }}>
                    September</option>
                <option value="10"
                    {{ ($data['oldInputs']['month'] ?? null) == '10' ? 'selected' : '' }}>
                    October</option>
                <option value="11"
                    {{ ($data['oldInputs']['month'] ?? null) == '11' ? 'selected' : '' }}>
                    November</option>
                <option value="12"
                    {{ ($data['oldInputs']['month'] ?? null) == '12' ? 'selected' : '' }}>
                    December</option>
            </x-admin.globals.forms.field>


            <!-- status -->
            <x-admin.globals.forms.field type="select" label="Status" :svgUrl="asset('assets/svg/tag.svg')" name="status">
                <option value="" selected>All</option>
                <option value="PAID"
                    {{ ($data['oldInputs']['status'] ?? null) == 'PAID' ? 'selected' : '' }}>Paid
                </option>
                <option value="PARTIALLY PAID"
                    {{ ($data['oldInputs']['status'] ?? null) == 'PARTIALLY PAID' ? 'selected' : '' }}>
                    Partially Paid
                </option>
                <option value="UNPAID"
                    {{ ($data['oldInputs']['status'] ?? null) == 'UNPAID' ? 'selected' : '' }}>
                    Unpaid
                </option>
            </x-admin.globals.forms.field>


            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Salary" class="open-modal"
                data-targetModalId="staff-salary-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>

        @scopedslot('cellmonth', ($row))
        @php
        $months = [
        '0' => 'N/A',
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
        ];
        @endphp
        {{ $months[$row->month ?? 0] }}
        @endscopedslot

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('staff-salary.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('staff-salary.delete')">
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

<x-admin.globals.modal id="staff-salary-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Staff Salary</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="staff-salary-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('staff-salary.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">

                <!--====== Staff ======-->
                <x-admin.globals.forms.field type="select" label="Staff" class="calculate-salary ajax-select ajax-select-staff" required :svgUrl="asset('assets/svg/user-check.svg')" name="staff_id"
                    data-target="{{ route('staff-salary.get-amounts') }}"
                    data-csrf="{{ csrf_token() }}" data-column="staff_id"
                    data-fill='{{ json_encode([ "remaining_amount" => "remaining_amount", "base_salary" => "base_salary","advance_amount" => "advances"]) }}'>
                    <option value="" selected>--select--</option>
                    @foreach ($data['staffs'] ?? [] as $staff)
                    <option value="{{ $staff->id }}">
                        {{ $staff->full_name }}
                    </option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!--====== Academic Year ======-->
                <x-admin.globals.forms.field label="Academic Year" type="text" placeholder="yyyy-yyyy" name="academic_year" required
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                <!--====== Month  ======-->
                <x-admin.globals.forms.field type="select" label="Month" required :svgUrl="asset('assets/svg/calendar-digit.svg')" name="month">

                    <option value="1">
                        January</option>
                    <option value="2">
                        February</option>
                    <option value="3">
                        March</option>
                    <option value="4">
                        April</option>
                    <option value="5">
                        May
                    </option>
                    <option value="6">
                        June
                    </option>
                    <option value="7">
                        July
                    </option>
                    <option value="8">
                        August</option>
                    <option value="9">
                        September</option>
                    <option value="10">
                        October</option>
                    <option value="11">
                        November</option>
                    <option value="12">
                        December</option>
                </x-admin.globals.forms.field>




                <!--====== Base Salary ======-->
                <x-admin.globals.forms.field label="Base Salary" class="calculate-salary cursor-not-allowed" id="base_salary" type="numeric" placeholder="Enter base salary" readOnly
                    name="base_salary" readOnly required
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                <!--====== Banusses ======-->
                <x-admin.globals.forms.field label="Bonus" class="calculate-salary" id="bonuses" type="numeric" placeholder="Enter bonuses" name="bonuses"
                    :svgUrl="asset('assets/svg/gift.svg')" />

                <!--====== Tax Percentage ======-->
                <x-admin.globals.forms.field label="Tax Percentage" class="calculate-salary" id="tax_percentage" type="numeric" placeholder="Enter tax percentage"
                    name="tax_percentage"
                    :svgUrl="asset('assets/svg/percent.svg')" />


                <!-- ====== Tax Amount ====== -->
                <x-admin.globals.forms.field label="Tax Amount" class="cursor-not-allowed" id="tax_amount" type="numeric" placeholder="Tax amount" disabled
                    :svgUrl="asset('assets/svg/coins.svg')" />

                <!-- ====== Advances ====== -->
                <x-admin.globals.forms.field label="Advance" class="calculate-salary" id="advances" type="numeric" placeholder="Enter adavance amount"
                    name="advances"
                    :svgUrl="asset('assets/svg/credit-card.svg')" />

                <!-- ====== Total Salary  ====== -->
                <x-admin.globals.forms.field label="Total Salary" class="cursor-not-allowed" id="total_salary" type="numeric" placeholder="Total salary" disabled
                    :svgUrl="asset('assets/svg/wallet.svg')" />

                <!-- ====== Paid Amount  ====== -->
                <x-admin.globals.forms.field label="Paid Amount" class="calculate-salary" id="paid_amount" type="numeric" placeholder="paid amount" name="paid_amount"
                    :svgUrl="asset('assets/svg/badge-check.svg')" />

                <!-- ====== Remaining Amount  ====== -->
                <x-admin.globals.forms.field label="Remaining Amount" class="cursor-not-allowed" id="remaining_amount" type="numeric" placeholder="Remaning amount" disabled
                    :svgUrl="asset('assets/svg/hour-glass.svg')" />

                <!-- ====== Payment Date  ====== -->
                <x-admin.globals.forms.field label="Payment Date" type="date" name="payment_date"
                    :svgUrl="asset('assets/svg/calendar-check.svg')" />

            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection