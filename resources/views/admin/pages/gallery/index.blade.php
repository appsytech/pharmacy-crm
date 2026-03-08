@extends('admin.layouts.main')
@section('title', 'Gallery')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Gallery', 'active' => true]]" />
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
        :filterFormAction="route('gallery.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N'],
        ['key' => 'title', 'label' => 'Title'],
        ['key' => 'images', 'label' => 'Image', 'type' => 'file'],
        ['key' => 'big_image', 'label' => 'Big Image', 'type' => 'file'],

        [
            'key' => 'status',
            'label' => 'Status',
            'type' => 'badge',
        ],
        ['key' => 'action', 'label' => 'Action'],
    ]"
        :rows="$data['images']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['title']) ? $data['oldInputs']['title'] : '' }}" label="Title" :svgUrl="asset('assets/svg/hash.svg')" name="title" placeholder="Search Title" />

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
            <x-admin.headers.icon-button :url="route('gallery.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('gallery.delete')">
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

<x-admin.globals.modal id="gallery-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Gallery</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="gallery-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('gallery.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== Title ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Title"
                    name="title"
                    placeholder="Enter title"
                    required
                    :svgUrl="asset('assets/svg/hash.svg')" />

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field
                    id="description"
                    type="textarea"
                    label="Description"
                    name="description"
                    placeholder="Enter description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    label="Upload Image"
                    name="images"
                    required
                    class="image-upload&preview"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />

                {{-- ====== Big Image ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    label="Upload Big Image"
                    name="big_image"
                    class="image-upload&preview"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                        <option value="DRAFT">Draft</option>
                    </x-slot>
                </x-admin.globals.forms.field>
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection