@extends('admin.layouts.main')
@section('title', 'Testimonials')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Testimonials', 'url' => route('testimonial.index')],['label' => 'Edit Testimonial', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('testimonial.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                {{-- ====== Name ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Name"
                    name="name"
                    value="{{ $data['testimonial']->name ?? '' }}"
                    required
                    placeholder="Enter Name"
                    :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field
                    type="email"
                    label="Email"
                    name="email"
                    value="{{ $data['testimonial']->email ?? '' }}"
                    placeholder="Enter Email"
                    :svgUrl="asset('assets/svg/mail.svg')" />

                {{-- ====== Company ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Company"
                    name="company"
                    value="{{ $data['testimonial']->company ?? '' }}"
                    placeholder="Enter Company Name"
                    :svgUrl="asset('assets/svg/building.svg')" />

                {{-- ====== Position ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Position"
                    name="position"
                    value="{{ $data['testimonial']->position ?? '' }}"
                    placeholder="Enter Position"
                    :svgUrl="asset('assets/svg/briefcase.svg')" />

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    class="image-upload&preview"
                    label="Image"
                    name="image"
                    :svgUrl="asset('assets/svg/image-plus.svg')">
                    @if (isset($data['testimonial']->image))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['testimonial']->image) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif
                </x-admin.globals.forms.field>

                {{-- ====== Stars ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Stars"
                    name="stars"
                    value="{{ $data['testimonial']->stars ?? '' }}"
                    required
                    min="1"
                    max="5"
                    placeholder="Enter rating (1-5)"
                    :svgUrl="asset('assets/svg/star.svg')" />

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Description"
                    name="description"
                    value="{{ $data['testimonial']->description ?? '' }}"
                    required
                    placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Sort ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Sort Order"
                    name="sort"
                    value="{{ $data['testimonial']->sort ?? '' }}"
                    min="0"
                    placeholder="Enter Sort Order"
                    :svgUrl="asset('assets/svg/arrow-up-down.svg')" />

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field
                    type="select"
                    label="Status"
                    name="status"
                    required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="PENDING" {{ $data['testimonial']->status  == 'PENDING' ? 'selected' : ''}}>Pending</option>
                        <option value="APPROVED" {{ $data['testimonial']->status  == 'APPROVED' ? 'selected' : ''}}>Approved</option>
                        <option value="REJECTED" {{ $data['testimonial']->status  == 'REJECTED' ? 'selected' : ''}}>Rejected</option>
                    </x-slot>
                </x-admin.globals.forms.field>


                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['testimonial']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('testimonial.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection