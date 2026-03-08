@extends('admin.layouts.main')
@section('title', 'Checkup Process')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Checkup Process', 'url' => route('checkup-process.index')],['label' => 'Edit Checkup Process', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('checkup-process.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                {{-- ====== S.N ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="S.N"
                    name="sn"
                    min="1"
                    :value="old('sn', $data['process']->sn ?? '')"
                    required
                    placeholder="Enter Serial Number"
                    :svgUrl="asset('assets/svg/hash.svg')" />



                {{-- ====== Title ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Title"
                    name="title"
                    :value="old('title', $data['process']->title ?? '')"
                    required
                    placeholder="Enter Title"
                    :svgUrl="asset('assets/svg/book-type.svg')" />



                {{-- ====== Images ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    class="image-upload&preview"
                    label="Images"
                    name="images"
                    :svgUrl="asset('assets/svg/image-plus.svg')">
                    @if (isset($data['process']->images))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['process']->images) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field
                    type="textarea"
                    id="description"
                    label="Description"
                    name="description"
                    value="{!! $data['process']->description ?? '' !!}"
                    placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />


                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1" {{ old('status', $data['process']->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $data['process']->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['process']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('checkup-process.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection