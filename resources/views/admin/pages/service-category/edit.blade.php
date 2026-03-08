@extends('admin.layouts.main')
@section('title', 'Service Category')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Services', 'url' => route('service-category.index')],['label' => 'Edit Service Category', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('service-category.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">

                {{-- ====== Title ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Title"
                    name="title"
                    value="{{ $data['serviceCategory']->title ?? '' }}"
                    required
                    placeholder="Enter Title"
                    :svgUrl="asset('assets/svg/hash.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1" {{ $data['serviceCategory']->status == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $data['serviceCategory']->status == '0' ? 'selected' : '' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Sort ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Sort Order"
                    name="sort"
                    value="{{ $data['serviceCategory']->sort ?? '' }}"
                    required
                    placeholder="Enter Sort Order"
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />


                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['serviceCategory']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('service-category.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection