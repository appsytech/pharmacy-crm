@extends('admin.layouts.main')
@section('title', 'Gallery')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Gallery', 'url' => route('gallery.index')],['label' => 'Edit Gallery', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('gallery.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                <x-slot name="fields">

                    {{-- ====== Title ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Title"
                        name="title"
                        value="{{ $data['image']->title ?? '' }}"
                        placeholder="Enter title"
                        required
                        :svgUrl="asset('assets/svg/hash.svg')" />

                    {{-- ====== Description ====== --}}
                    <x-admin.globals.forms.field
                        type="textarea"
                        label="Description"
                        name="description"
                        value="{{  $data['image']->description ?? '' }}"
                        placeholder="Enter description"
                        :svgUrl="asset('assets/svg/file-text.svg')" />

                    {{-- ====== Image ====== --}}
                    <x-admin.globals.forms.field
                        type="file"
                        label="Upload Image"
                        name="images"
                        class="image-upload-preview"
                        :svgUrl="asset('assets/svg/image-plus.svg')">
                        @if (isset($data['image']->images))
                        <x-slot:file_preview>
                            <div class="relative inline-flex gap-2">
                                <img src="{{ asset('storage/' . $data['image']->images) }}"
                                    class="w-24 h-24 object-cover rounded border">
                            </div>
                        </x-slot:file_preview>
                        @endif
                    </x-admin.globals.forms.field>

                    {{-- ====== Big Image ====== --}}
                    <x-admin.globals.forms.field
                        type="file"
                        label="Upload Big Image"
                        name="big_image"
                        class="image-upload-preview"
                        :svgUrl="asset('assets/svg/image-plus.svg')">
                        @if (isset($data['image']->big_image))
                        <x-slot:file_preview>
                            <div class="relative inline-flex gap-2">
                                <img src="{{ asset('storage/' . $data['image']->big_image) }}"
                                    class="w-24 h-24 object-cover rounded border">
                            </div>
                        </x-slot:file_preview>
                        @endif
                    </x-admin.globals.forms.field>

                    {{-- ====== Status ====== --}}
                    <x-admin.globals.forms.field
                        type="select"
                        label="Status"
                        name="status"
                        required
                        :svgUrl="asset('assets/svg/tag.svg')">
                        <x-slot>
                            <option value="ACTIVE" {{ $data['image']->status === 'ACTIVE' ? 'selected' : '' }}>Active</option>
                            <option value="INACTIVE" {{ $data['image']->status === 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                            <option value="DRAFT" {{ $data['image']->status === 'DRAFT' ? 'selected' : '' }}>Draft</option>
                        </x-slot>
                    </x-admin.globals.forms.field>

                    <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['image']->id }}" />
                </x-slot>

                <x-slot name="action_buttons">
                    <x-admin.globals.buttons.quinary type="url" :url="route('gallery.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                    <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
                </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection