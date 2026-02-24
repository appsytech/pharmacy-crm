@extends('admin.layouts.main')
@section('title', 'Award')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Award', 'active' => true]]" />
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
        :filterFormAction="route('award.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],

        ['key' => 'award_name', 'label' => 'Award Name'],
        ['key' => 'award_type', 'label' => 'Type'],
        ['key' => 'award_to', 'label' => 'Award To'],
        ['key' => 'award_by', 'label' => 'Award By'],
        ['key' => 'award_year', 'label' => 'Year'],
        ['key' => 'award_by_country', 'label' => 'Country'],

        [
            'key' => 'image',
            'label' => 'Image',
            'type' => 'file'
        ],

        [
            'key' => 'action',
            'label' => 'Action',
            'type' => 'action',
            'deleteRoute' => 'award.delete',
            'idKey' => 'id'
        ],
    ]"
        :rows="$data['awards']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['award_name']) ? $data['oldInputs']['award_name'] : '' }}" label="Award Name" :svgUrl="asset('assets/svg/hash.svg')" name="award_name" placeholder="Search Award Name" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Award" class="open-modal"
                data-targetModalId="award-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>


        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('award.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('award.delete')">
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

<x-admin.globals.modal id="award-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Award</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="award-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('award.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== Award Name ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Award Name"
                    name="award_name"
                    placeholder="Enter award name"
                    required
                    :svgUrl="asset('assets/svg/award.svg')" />

                {{-- ====== Award Type ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Award Type"
                    name="award_type"
                    placeholder="Enter award type"
                    :svgUrl="asset('assets/svg/layers.svg')" />

                {{-- ====== Award To ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Award To"
                    name="award_to"
                    placeholder="Enter award receiver"
                    :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Award By ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Award By"
                    name="award_by"
                    placeholder="Enter awarding organization"
                    :svgUrl="asset('assets/svg/user-check.svg')" />

                {{-- ====== Award Year ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Award Year"
                    name="award_year"
                    placeholder="Enter award year (YYYY)"
                    required
                    :svgUrl="asset('assets/svg/calendar.svg')" />

                {{-- ====== Award By Country ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Award By Country"
                    name="award_by_country"
                    placeholder="Enter country name"
                    :svgUrl="asset('assets/svg/globe.svg')" />

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    label="Upload Image"
                    name="image"
                    class="image-upload&preview"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection