@extends('admin.layouts.main')
@section('title', 'Inquiry')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Inquiry', 'active' => true]]" />
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
        :filterFormAction="route('inquiry.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],

        ['key' => 'fullName', 'label' => 'Full Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'phoneNumber', 'label' => 'Phone Number'],
        ['key' => 'subject', 'label' => 'Subject'],

        [
            'key' => 'message',
            'label' => 'Message',
            'type' => 'limit',
            'limit' => 30
        ],

        [
            'key' => 'status',
            'label' => 'Status',
            'type' => 'badge',
        ],

        [
            'key' => 'action',
            'label' => 'Action',
        ],
    ]"
        :rows="$data['inquiries']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['email']) ? $data['oldInputs']['email'] : '' }}" label="Email" :svgUrl="asset('assets/svg/mail.svg')" name="email" placeholder="Search by Email" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Gallery" class="open-modal"
                data-targetModalId="gallery-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>


        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('inquiry.delete')">
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

@endsection