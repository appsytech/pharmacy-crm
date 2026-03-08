@extends('admin.layouts.main')
@section('title', 'Services')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Services', 'url' => route('service.index')],['label' => 'Edit Service', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('service.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">

                {{-- ====== Title ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Title"
                    name="title"
                    value="{{ $data['service']->title ?? '' }}"
                    required
                    placeholder="Enter Title"
                    :svgUrl="asset('assets/svg/hash.svg')" />

                {{-- ====== Category ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Category"
                    name="category_id"
                    required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        @foreach($data['categories'] ?? [] as $category)
                        <option value="{{ $category->id }}" {{ $data['service']->category_id == $category->id ? 'selected' : '' }}>{{ $category->title ?? '' }}</option>
                        @endforeach
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Icon ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    label="Icon"
                    name="icon"

                    class="image-upload&preview"
                    :svgUrl="asset('assets/svg/image-plus.svg')">

                    @if (isset($data['service']->icon))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['service']->icon) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Description"
                    name="description"
                    id="description"
                    value="{!! $data['service']->description ?? '' !!}"
                    placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Location ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Location"
                    name="location"
                    value="{{ $data['service']->location ?? '' }}"
                    placeholder="Enter Location"
                    :svgUrl="asset('assets/svg/map-pin.svg')" />



                {{-- ====== Images 1 ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    label="Image 1"
                    class="image-upload&preview"
                    name="images1"
                    :svgUrl="asset('assets/svg/image-plus.svg')">
                    @if (isset($data['service']->images1))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['service']->images1) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                {{-- ====== Images 2 ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    label="Image 2"
                    name="images2"
                    class="image-upload&preview"
                    :svgUrl="asset('assets/svg/image-plus.svg')">
                    @if (isset($data['service']->images2))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['service']->images2) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                {{-- ====== Images 3 ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    label="Image 3"
                    name="images3"
                    class="image-upload&preview"
                    :svgUrl="asset('assets/svg/image-plus.svg')">
                    @if (isset($data['service']->images3))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['service']->images3) }}"
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
                        <option value="1" {{ $data['service']->status == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $data['service']->status == '0' ? 'selected' : '' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Sort ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Sort Order"
                    name="sort"
                    value="{{ $data['service']->sort ?? '' }}"
                    required
                    placeholder="Enter Sort Order"
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />


                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['service']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('service.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection