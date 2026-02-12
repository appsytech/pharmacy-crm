@extends('admin.layouts.main')
@section('title', 'Admins')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Admins', 'url' => route('admin.index')],['label' => 'Edit Admin', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('admin.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
                {{-- ====== name ====== --}}
                <x-admin.globals.forms.field type="text" label="Name" name="name" value="{{ $data['admin']->name }}" required
                    placeholder="Enter Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                {{-- ====== Username ====== --}}
                <x-admin.globals.forms.field type="text" label="Username" value="{{ $data['admin']->username }}" name="username"
                    placeholder="Enter Username" :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field type="text" label="Email" value="{{ $data['admin']->email }}" name="email" required
                    placeholder="Enter Company Name" :svgUrl="asset('assets/svg/sigma.svg')" />

                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" label="Phone" value="{{ $data['admin']->phone }}" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Password" name="password" placeholder="Enter password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Confirm Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Confirm Password" name="password_confirmation" placeholder="Enter confirm password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Role ====== --}}
                <x-admin.globals.forms.field type="select" label="Role" name="admin_role" required
                    :svgUrl="asset('assets/svg/shield-user.svg')">
                    <x-slot>
                        <option value="1" {{ $data['admin']->admin_role == '1' ? 'selected' : '' }}>Super Admin</option>
                        <option value="2" {{ $data['admin']->admin_role == '2' ? 'selected' : '' }}>Admin</option>
                        <option value="3" {{ $data['admin']->admin_role == '3' ? 'selected' : '' }}>Editor</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1" {{ $data['admin']->status  ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $data['admin']->status  ? '' : 'selected' }}>Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Profile ====== --}}
                <x-admin.globals.forms.field type="file" class="image-upload&preview" label="Profile" name="profile_image"
                    :svgUrl="asset('assets/svg/image-plus.svg')">

                    @if (isset($data['admin']->profile_image))
                    <x-slot:file_preview>
                        <div class="relative inline-flex gap-2">
                            <img src="{{ asset('storage/' . $data['admin']->profile_image) }}"
                                class="w-24 h-24 object-cover rounded border">
                        </div>
                    </x-slot:file_preview>
                    @endif

                </x-admin.globals.forms.field>
                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['admin']->id }}" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('admin.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection