@extends('admin.layouts.main')
@section('title', 'Faq')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Faq', 'url' => route('faq.index')],['label' => 'Edit Faq', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('faq.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                {{-- ====== Question ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Question"
                    name="question"
                    :value="old('question', $data['faq']->question ?? '')"
                    required
                    placeholder="Enter Question"
                    :svgUrl="asset('assets/svg/message-circle-question-mark.svg')" />

                {{-- ====== Answer ====== --}}
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Answer"
                    name="answer"
                    :value="old('answer', $data['faq']->answer ?? '')"
                    required
                    placeholder="Enter Answer"
                    :svgUrl="asset('assets/svg/message-circle-reply.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1" {{ old('status', $data['faq']->is_active ?? '') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $data['faq']->is_active ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Sort ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Sort Order"
                    name="sort"
                    min="0"
                    :value="old('sort', $data['faq']->sort ?? '')"
                    placeholder="Enter Sort Value"
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['faq']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('faq.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection