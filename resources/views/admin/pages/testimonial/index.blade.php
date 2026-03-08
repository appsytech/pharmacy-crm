@extends('admin.layouts.main')
@section('title', 'Testimonials')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Testimonial', 'active' => true]]" />
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
    <x-admin.globals.tables.table
        :filterFormAction="route('testimonial.index')"
        :columns="[
        ['key' => 'sn', 'label' => 'S.N', 'type' => null],
        ['key' => 'name', 'label' => 'Name', 'type' => null],
        ['key' => 'email', 'label' => 'Email', 'type' => null],
        ['key' => 'company', 'label' => 'Company', 'type' => null],
        ['key' => 'position', 'label' => 'Position', 'type' => null],
        ['key' => 'image', 'label' => 'Image', 'type' => 'file'],
        ['key' => 'stars', 'label' => 'Stars', 'type' => null],
        ['key' => 'description', 'label' => 'Description', 'type' => null],
        ['key' => 'sort', 'label' => 'Sort', 'type' => null],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'action', 'label' => 'Action', 'type' => null],
    ]"
        :rows="$data['testimonials']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="Testimonial By Name" value="{{ isset($data['oldInputs']['name']) ? $data['oldInputs']['name'] : '' }}" :svgUrl="asset('assets/svg/user-check.svg')" name="name"
                placeholder="Enter Name" />

            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['email']) ? $data['oldInputs']['email'] : '' }}" label="Testimonial By Email" :svgUrl="asset('assets/svg/user.svg')" name="email"
                placeholder="Enter Email" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Testimonial" class="open-modal"
                data-targetModalId="testimonial-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>

        @scopedslot('celldescription', ($row))
        {!! \Illuminate\Support\Str::words(strip_tags($row->description), 20, '...') !!}
        @endscopedslot

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('testimonial.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('testimonial.delete')">
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

<x-admin.globals.modal id="testimonial-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Testimonial</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="testimonial-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('testimonial.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== Name ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Name"
                    name="name"
                    required
                    placeholder="Enter Name"
                    :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field
                    type="email"
                    label="Email"
                    name="email"
                    placeholder="Enter Email"
                    :svgUrl="asset('assets/svg/mail.svg')" />

                {{-- ====== Company ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Company"
                    name="company"
                    placeholder="Enter Company Name"
                    :svgUrl="asset('assets/svg/building.svg')" />

                {{-- ====== Position ====== --}}
                <x-admin.globals.forms.field
                    type="text"
                    label="Position"
                    name="position"
                    placeholder="Enter Position"
                    :svgUrl="asset('assets/svg/briefcase.svg')" />

                {{-- ====== Image ====== --}}
                <x-admin.globals.forms.field
                    type="file"
                    class="image-upload&preview"
                    label="Image"
                    name="image"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />

                {{-- ====== Stars ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Stars"
                    name="stars"
                    required
                    min="1"
                    max="5"
                    placeholder="Enter rating (1-5)"
                    :svgUrl="asset('assets/svg/star.svg')" />

                {{-- ====== Description ====== --}}
                <x-admin.globals.forms.field
                    type="textarea"
                    label="Description"
                    id="description"
                    name="description"
                    required
                    placeholder="Enter Description"
                    :svgUrl="asset('assets/svg/file-text.svg')" />

                {{-- ====== Sort ====== --}}
                <x-admin.globals.forms.field
                    type="number"
                    label="Sort Order"
                    name="sort"
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
                        <option value="PENDING">Pending</option>
                        <option value="APPROVED">Approved</option>
                        <option value="REJECTED">Rejected</option>
                    </x-slot>
                </x-admin.globals.forms.field>
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection