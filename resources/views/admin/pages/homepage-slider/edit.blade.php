@extends('admin.layouts.main')
@section('title', 'Homepage Slider')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Homepage Sliders', 'url' => route('homepage-slider.index')],['label' => 'Edit Homepage Slider', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('homepage-slider.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">

                {{-- ====== title ====== --}}
                <x-admin.globals.forms.field type="text" label="Title" value="{{ $data['slider']->title ?? '' }}" placeholder="Enter title" name="title" required
                    :svgUrl="asset('assets/svg/hash.svg')" />

                {{-- ====== Type====== --}}
                <x-admin.globals.forms.field type="text" label="Type" value="{{ $data['slider']->type ?? '' }}" placeholder="Enter Type" name="type" required
                    :svgUrl="asset('assets/svg/layers.svg')" />


                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1" {{ ($data['slider']->status ?? null) == '1' ? 'selected' : '' }}>
                            Active</option>
                        <option value="0" {{ ($data['slider']->status ?? null) == '0' ? 'selected' : '' }}>
                            Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                {{-- ====== Device Type  ====== --}}
                <x-admin.globals.forms.field id="device_type" type="select" label="Device type" name="device_type" required
                    :svgUrl="asset('assets/svg/layers.svg')">
                    <x-slot>
                        <option value="0"
                            {{ ($data['slider']->device_type ?? null) == '0' ? 'selected' : '' }}>Web</option>
                        <option value="1"
                            {{ ($data['slider']->device_type ?? null) == '1' ? 'selected' : '' }}>Android
                        </option>
                        <option value="2"
                            {{ ($data['slider']->device_type ?? null) == '2' ? 'selected' : '' }}>H5</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Jump Type  ====== --}}
                <x-admin.globals.forms.field id="jump_type" type="select" label="Jump type" name="jump_type" required
                    :svgUrl="asset('assets/svg/layout-grid.svg')">
                    <x-slot>
                        <option value="ABOUT"
                            {{ ($data['slider']->jump_type ?? null) == 'ABOUT' ? 'selected' : '' }}>About
                        </option>
                        <option value="ACTIVITY"
                            {{ ($data['slider']->jump_type ?? null) == 'ACTIVITY' ? 'selected' : '' }}>Activity
                        </option>
                        <option value="ADMISSION"
                            {{ ($data['slider']->jump_type ?? null) == 'ADMISSION' ? 'selected' : '' }}>
                            Admission</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field id="voucherInput" type="file" class="image-upload&preview" label="Upload Image" name="images" 
                    :svgUrl="asset('assets/svg/image-plus.svg')">

                    @if (isset($data['slider']->images))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['slider']->images) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field type="textarea" label="Description" value="{{ $data['slider']->description ?? '' }}" name="description" placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['slider']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('homepage-slider.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection