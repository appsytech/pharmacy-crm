@extends('admin.layouts.main')
@section('title', 'Activity')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Activity', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('activity.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'title', 'label' => 'Title', 'type' => null],
            ['key' => 'images', 'label' => 'Image', 'type' => 'file'],
            ['key' => 'type', 'label' => 'Type', 'type' => null],
            ['key' => 'author', 'label' => 'Author', 'type' => null],
            ['key' => 'description', 'label' => 'Description', 'type' => null],
            ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
            ['key' => 'sort', 'label' => 'Sort', 'type' => null],
            ['key' => 'created_at', 'label' => 'Created At', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['activities']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="Title" value="{{ isset($data['oldInputs']['title']) ? $data['oldInputs']['title'] : '' }}" :svgUrl="asset('assets/svg/book-type.svg')" name="title"
                placeholder="Enter title" />

            <x-admin.globals.forms.field type="text" label="Author" value="{{ isset($data['oldInputs']['author']) ? $data['oldInputs']['author'] : '' }}" :svgUrl="asset('assets/svg/user-check.svg')" name="author"
                placeholder="Enter Author Name" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Activity" class="open-modal"
                data-targetModalId="activity-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('activity.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('activity.delete')">
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

<x-admin.globals.modal id="activity-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Activity</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="activity-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('activity.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== title ====== --}}
                <x-admin.globals.forms.field type="text" label="Title" name="title" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/book-type.svg')" />

                {{-- ====== Sort ====== --}}
                <x-admin.globals.forms.field type="number" label="Sort" name="sort" placeholder="Enter sort" required
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />

                {{-- ====== Activity Type ====== --}}
                <x-admin.globals.forms.field type="select" label="Activity Type" name="type" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <option value="CURRENT">current</option>
                    <option value="UPCOMING">Upcoming</option>

                </x-admin.globals.forms.field>

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field type="textarea" label="Description" name="description" placeholder="Enter Description" required
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field type="file" class="image-upload&preview" label="Upload Image" name="images" required
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