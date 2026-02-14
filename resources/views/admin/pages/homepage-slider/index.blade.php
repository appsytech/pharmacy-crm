@extends('admin.layouts.main')
@section('title', 'Homepage Slider')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Homepage Slider', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('homepage-slider.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'title', 'label' => 'Title', 'type' => null],
            ['key' => 'images', 'label' => 'Image', 'type' => 'file'],
            ['key' => 'type', 'label' => 'Type', 'type' => null],
            ['key' => 'jump_type', 'label' => 'Jump Type', 'type' => null],
            ['key' => 'status', 'label' => 'status', 'type' => 'toggle', 'route' => 'homepage-slider.status.update','idKey' => 'id'],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['sliders']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['type']) ? $data['oldInputs']['type'] : '' }}" label="Type" :svgUrl="asset('assets/svg/layers.svg')" name="type" placeholder="Search type" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Slider" class="open-modal"
                data-targetModalId="slider-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>


        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('homepage-slider.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('homepage-slider.delete')">
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

<x-admin.globals.modal id="slider-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Slider</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="slider-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('homepage-slider.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">

                {{-- ====== title ====== --}}
                <x-admin.globals.forms.field type="text" label="Title" placeholder="Enter title" name="title" required
                    :svgUrl="asset('assets/svg/hash.svg')" />

                {{-- ====== Type====== --}}
                <x-admin.globals.forms.field type="text" label="Type" placeholder="Enter Type" name="type" required
                    :svgUrl="asset('assets/svg/layers.svg')" />


                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Device Type  ====== --}}
                <x-admin.globals.forms.field id="device_type" type="select" label="Device type" name="device_type" required
                    :svgUrl="asset('assets/svg/layers.svg')">
                    <x-slot>
                        <option value="0">Web</option>
                        <option value="1">Android</option>
                        <option value="2">H5</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Jump Type  ====== --}}
                <x-admin.globals.forms.field id="jump_type" type="select" label="Jump type" name="jump_type" required
                    :svgUrl="asset('assets/svg/layout-grid.svg')">
                    <x-slot>
                        <option value="ABOUT">About</option>
                        <option value="ACTIVITY">Activity</option>
                        <option value="ADMISSION">Admission</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field id="voucherInput" type="file" class="image-upload&preview" label="Upload Image" name="images" required
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