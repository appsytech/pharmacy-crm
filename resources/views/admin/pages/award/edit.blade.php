@extends('admin.layouts.main')
@section('title', 'Award')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Award', 'url' => route('award.index')],['label' => 'Edit Award', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('award.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                <x-slot name="fields">
                    {{-- ====== Award Name ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Award Name"
                        name="award_name"
                        value="{{ $data['award']->award_name ?? '' }}"
                        placeholder="Enter award name"
                        required
                        :svgUrl="asset('assets/svg/award.svg')" />

                    {{-- ====== Award Type ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Award Type"
                        name="award_type"
                        value="{{ $data['award']->award_type ?? '' }}"
                        placeholder="Enter award type"
                        :svgUrl="asset('assets/svg/layers.svg')" />

                    {{-- ====== Award To ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Award To"
                        name="award_to"
                        value="{{ $data['award']->award_to ?? '' }}"
                        placeholder="Enter award receiver"
                        :svgUrl="asset('assets/svg/user.svg')" />

                    {{-- ====== Award By ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Award By"
                        name="award_by"
                        value="{{ $data['award']->award_by ?? '' }}"
                        placeholder="Enter awarding organization"
                        :svgUrl="asset('assets/svg/user-check.svg')" />

                    {{-- ====== Award Year ====== --}}
                    <x-admin.globals.forms.field
                        type="number"
                        label="Award Year"
                        name="award_year"
                        placeholder="Enter award year (YYYY)"
                        value="{{ $data['award']->award_year ?? '' }}"
                        required
                        :svgUrl="asset('assets/svg/calendar.svg')" />

                    {{-- ====== Award By Country ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Award By Country"
                        name="award_by_country"
                        value="{{ $data['award']->award_by_country ?? '' }}"
                        placeholder="Enter country name"
                        :svgUrl="asset('assets/svg/globe.svg')" />

                    {{-- ====== Image ====== --}}
                    <x-admin.globals.forms.field
                        type="file"
                        label="Upload Image"
                        name="image"
                        class="image-upload&preview"
                        :svgUrl="asset('assets/svg/image-plus.svg')">
                        @if (isset($data['award']->image))
                        <x-slot:file_preview>
                            <div class="relative inline-flex gap-2">
                                <img src="{{ asset('storage/' . $data['award']->image) }}"
                                    class="w-24 h-24 object-cover rounded border">
                            </div>
                        </x-slot:file_preview>
                        @endif
                    </x-admin.globals.forms.field>


                    <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['award']->id }}" />
                </x-slot>

                <x-slot name="action_buttons">
                    <x-admin.globals.buttons.quinary type="url" :url="route('award.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                    <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
                </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection