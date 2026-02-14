@extends('admin.layouts.main')
@section('title', 'staff Salary')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Staff Salary', 'url' => route('staff-salary.index')],['label' => 'Edit Staff Salary', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('staff-salary.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">


                <!--====== Staff ======-->
                <x-admin.globals.forms.field type="select" label="Staff" class="calculate-salary ajax-select ajax-select-staff" required :svgUrl="asset('assets/svg/user-check.svg')" name="staff_id"
                    data-target="{{ route('staff-salary.get-amounts') }}"
                    data-csrf="{{ csrf_token() }}" data-column="staff_id"
                    data-fill='{{ json_encode([ "remaining_amount" => "remaining_amount", "base_salary" => "base_salary","advance_amount" => "advances"]) }}'>
                    <option value="" selected>--select--</option>
                    @foreach ($data['staffs'] ?? [] as $staff)
                    <option value="{{ $staff->id }}"
                        {{ $staff->id == $data['staffSalary']->staff_id ?? 0 ? 'selected' : '' }}>
                        {{ $staff->full_name }}
                    </option>
                    @endforeach
                </x-admin.globals.forms.field>

                <!--====== Academic Year ======-->
                <x-admin.globals.forms.field label="Academic Year" value="{{ $data['staffSalary']->academic_year ?? '' }}" type="text" placeholder="yyyy-yyyy" name="academic_year" required
                    :svgUrl="asset('assets/svg/calendar.svg')" />


                <!--====== Month  ======-->
                <x-admin.globals.forms.field type="select" label="Month" required :svgUrl="asset('assets/svg/calendar-digit.svg')" name="month">
                    <option value="1" {{ $data['staffSalary']->month == '1' ? 'selected' : '' }}>
                        January</option>
                    <option value="2" {{ $data['staffSalary']->month == '2' ? 'selected' : '' }}>
                        February</option>
                    <option value="3" {{ $data['staffSalary']->month == '3' ? 'selected' : '' }}>
                        March</option>
                    <option value="4" {{ $data['staffSalary']->month == '4' ? 'selected' : '' }}>
                        April</option>
                    <option value="5" {{ $data['staffSalary']->month == '5' ? 'selected' : '' }}>May
                    </option>
                    <option value="6" {{ $data['staffSalary']->month == '6' ? 'selected' : '' }}>
                        June
                    </option>
                    <option value="7" {{ $data['staffSalary']->month == '7' ? 'selected' : '' }}>
                        July
                    </option>
                    <option value="8" {{ $data['staffSalary']->month == '8' ? 'selected' : '' }}>
                        August</option>
                    <option value="9" {{ $data['staffSalary']->month == '9' ? 'selected' : '' }}>
                        September</option>
                    <option value="10" {{ $data['staffSalary']->month == '10' ? 'selected' : '' }}>
                        October</option>
                    <option value="11" {{ $data['staffSalary']->month == '11' ? 'selected' : '' }}>
                        November</option>
                    <option value="12" {{ $data['staffSalary']->month == '12' ? 'selected' : '' }}>
                        December</option>
                </x-admin.globals.forms.field>



                <!--====== Base Salary ======-->
                <x-admin.globals.forms.field label="Base Salary" value="{{ $data['staffSalary']->base_salary ?? '' }}" class="calculate-salary cursor-not-allowed" id="base_salary" type="numeric" placeholder="Enter base salary" readOnly
                    name="base_salary" readOnly required
                    :svgUrl="asset('assets/svg/dollar-sign.svg')" />

                <!--====== Banusses ======-->
                <x-admin.globals.forms.field label="Bonus" value="{{ $data['staffSalary']->bonuses ?? '' }}" class="calculate-salary" id="bonuses" type="numeric" placeholder="Enter bonuses" name="bonuses"
                    :svgUrl="asset('assets/svg/gift.svg')" />

                <!--====== Tax Percentage ======-->
                <x-admin.globals.forms.field label="Tax Percentage" value="{{ $data['staffSalary']->tax_percentage ?? '' }}" class="calculate-salary" id="tax_percentage" type="numeric" placeholder="Enter tax percentage"
                    name="tax_percentage"
                    :svgUrl="asset('assets/svg/percent.svg')" />


                <!-- ====== Tax Amount ====== -->
                <x-admin.globals.forms.field label="Tax Amount" value="{{ $data['staffSalary']->tax_amount ?? '' }}" class="cursor-not-allowed" id="tax_amount" type="numeric" placeholder="Tax amount" disabled
                    :svgUrl="asset('assets/svg/coins.svg')" />

                <!-- ====== Advances ====== -->
                <x-admin.globals.forms.field label="Advance" value="{{ $data['staffSalary']->advances ?? '' }}" class="calculate-salary" id="advances" type="numeric" placeholder="Enter adavance amount"
                    name="advances"
                    :svgUrl="asset('assets/svg/credit-card.svg')" />

                <!-- ====== Total Salary  ====== -->
                <x-admin.globals.forms.field label="Total Salary" value="{{ $data['staffSalary']->total_salary ?? '' }}" class="cursor-not-allowed" id="total_salary" type="numeric" placeholder="Total salary" disabled
                    :svgUrl="asset('assets/svg/wallet.svg')" />

                <!-- ====== Paid Amount  ====== -->
                <x-admin.globals.forms.field label="Paid Amount" value="{{ $data['staffSalary']->paid_amount ?? '' }}" class="calculate-salary" id="paid_amount" type="numeric" placeholder="paid amount" name="paid_amount"
                    :svgUrl="asset('assets/svg/badge-check.svg')" />

                <!-- ====== Remaining Amount  ====== -->
                <x-admin.globals.forms.field label="Remaining Amount" name="remaining_amount" required value="{{ $data['staffSalary']->remaining_amount ?? '' }}" class="cursor-not-allowed" id="remaining_amount" type="numeric" placeholder="Remaning amount" readOnly
                    :svgUrl="asset('assets/svg/hour-glass.svg')" />

                <!-- ====== Payment Date  ====== -->
                <x-admin.globals.forms.field label="Payment Date" value="{{ $data['staffSalary']->payment_date ?? '' }}" type="date" name="payment_date"
                    :svgUrl="asset('assets/svg/calendar-check.svg')" />

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['staffSalary']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('staff-salary.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection