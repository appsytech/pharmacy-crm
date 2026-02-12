@extends('admin.layouts.main')
@section('title', 'Activities')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Activities', 'url' => route('activity.index')],['label' => 'Edit Activity', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('activity.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                {{-- ====== title ====== --}}
                <x-admin.globals.forms.field type="text" value="{{ $data['activity']->title ?? '' }}" label="Title" name="title" required
                    placeholder="Enter Full Name" :svgUrl="asset('assets/svg/book-type.svg')" />

                {{-- ====== Sort ====== --}}
                <x-admin.globals.forms.field type="number" value="{{ $data['activity']->sort ?? '' }}" label="Sort" name="sort" placeholder="Enter sort" required
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />

                {{-- ====== Activity Type ====== --}}
                <x-admin.globals.forms.field type="select" label="Activity Type" name="type" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <option value="CURRENT" {{ ($data['activity']->type ?? null) == 'CURRENT' ? 'selected' : '' }}>current</option>
                    <option value="UPCOMING" {{ ($data['activity']->type ?? null) == 'UPCOMING' ? 'selected' : '' }}>Upcoming</option>

                </x-admin.globals.forms.field>

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1" {{ ($data['activity']->status ?? null) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ ($data['activity']->status ?? null) == '0' ? 'selected' : '' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field type="textarea" value="{{ $data['activity']->description ?? '' }}" label="Description" name="description" placeholder="Enter Description" required
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field type="file" class="image-upload&preview" label="Upload Image" name="images"
                    :svgUrl="asset('assets/svg/image-plus.svg')">
                    @if (isset($data['activity']->images))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['activity']->images) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['activity']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('activity.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection