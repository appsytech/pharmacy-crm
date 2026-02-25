@extends('admin.layouts.main')
@section('title', 'Dashboard')

@section('content')

<!--===== Summary Cards ======-->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">


    <x-admin.globals.cards.summary-card label="Total Doctors" :value="$data['totalDoctors'] ?? 0" subLabel="Active Doctors" :svgUrl="asset('assets/svg/stethoscope-white.svg')" />

    <x-admin.globals.cards.summary-card label="Total Patients" :value="$data['totalPatients'] ?? 0" :svgUrl="asset('assets/svg/user-group-white.svg')" />

    <x-admin.globals.cards.summary-card label="Awards" :value="$data['totalAwards'] ?? 0"
        :svgUrl="asset('assets/svg/award.svg')" />

</div>

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

    </x-admin.globals.tables.table>

</div>

@endsection