@extends('admin.layouts.main')
@section('title', 'Admins')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Admins', 'active' => true]]" />
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
    <x-admin.globals.tables.table :filterFormAction="route('admin.index')" :columns="[
            ['key' => 'sn', 'label' => 'S.N', 'type' => null],
            ['key' => 'name', 'label' => 'Name', 'type' => null],
            ['key' => 'profile_image', 'label' => 'Profile', 'type' => 'file'],
            ['key' => 'username', 'label' => 'Username', 'type' => null],
            ['key' => 'email', 'label' => 'Email', 'type' => null],
            ['key' => 'phone', 'label' => 'Phone no', 'type' => null],
            ['key' => 'admin_role', 'label' => 'Role', 'type' => null],
            ['key' => 'status', 'label' => 'Status', 'type' => 'toggle', 'route' => 'admin.status.update','idKey' => 'id',],
            ['key' => 'last_login_at', 'label' => 'Last Login At', 'type' => null],
            ['key' => 'action', 'label' => 'Action', 'type' => null],
        ]" :rows="$data['admins']">

        <x-slot name="filters">
            <x-admin.globals.forms.field type="text" label="Name" value="{{ isset($data['oldInputs']['name']) ? $data['oldInputs']['name'] : '' }}" :svgUrl="asset('assets/svg/user-check.svg')" name="name"
                placeholder="Enter Name" />
            <x-admin.globals.forms.field type="text" value="{{ isset($data['oldInputs']['username']) ? $data['oldInputs']['username'] : '' }}" label="Username" :svgUrl="asset('assets/svg/user.svg')" name="username"
                placeholder="Enter Username" />

            <div class="flex items-end">
                <x-admin.buttons.secondary type="submit" class="px-6 py-2.5" label="Search" :svgUrl="asset('assets/svg/white-magnifier.svg')" />
            </div>
        </x-slot>

        <x-slot name="action_buttons">
            <x-admin.buttons.primary type="reset" label="Clear Filter" :svgUrl="asset('assets/svg/setting-vertical.svg')" />
            <x-admin.buttons.secondary type="button" label="Add Admin" class="open-modal"
                data-targetModalId="admin-add-modal" :svgUrl="asset('assets/svg/plus-white.svg')" />
        </x-slot>


        @scopedslot('celladmin_role', ($row))
        @php
        if ($row->admin_role == 1) {
        $roleText = 'Super Admin';
        } elseif ($row->admin_role == 2) {
        $roleText = 'Admin';
        } else {
        $roleText = 'Editor';
        }
        @endphp
        {{ $roleText ?? '' }}
        @endscopedslot

        @scopedslot('cellaction', ($row))
        <div class="flex items-center justify-center gap-1">
            <x-admin.headers.icon-button :url="route('admin.edit', encrypt($row->id))" class="px-0!" :svgUrl="asset('assets/svg/pencil.svg')" />

            <x-admin.globals.forms.form method="POST" class="flex items-center justify-center" :action="route('admin.delete')">
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

<x-admin.globals.modal id="admin-add-modal">

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Add New Admin</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below</p>
        </div>
        <x-admin.globals.buttons.tertiary class="close-modal" data-targetModalId="admin-add-modal"
            :svgUrl="asset('assets/svg/cross.svg')" />
    </x-slot>

    <x-slot name="body">
        <x-admin.globals.forms.form :action="route('admin.store')" class="ajax-form reload-on-success" method="POST" enctype="multipart/form-data">

            <x-slot name="fields">
                {{-- ====== name ====== --}}
                <x-admin.globals.forms.field type="text" label="Name" name="name" required
                    placeholder="Enter Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                {{-- ====== Username ====== --}}
                <x-admin.globals.forms.field type="text" label="Username" name="username"
                    placeholder="Enter Username" :svgUrl="asset('assets/svg/user.svg')" />

                {{-- ====== Email ====== --}}
                <x-admin.globals.forms.field type="text" label="Email" name="email" required
                    placeholder="Enter Email" :svgUrl="asset('assets/svg/mail.svg')" />

                {{-- ====== Phone ====== --}}
                <x-admin.globals.forms.field type="text" label="Phone" name="phone" placeholder="Enter Phone No"
                    :svgUrl="asset('assets/svg/phone.svg')" />

                {{-- ====== Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Password" name="password" required placeholder="Enter password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Confirm Password ====== --}}
                <x-admin.globals.forms.field type="password" label="Confirm Password" required name="password_confirmation" placeholder="Enter confirm password"
                    :svgUrl="asset('assets/svg/lock.svg')" />

                {{-- ====== Role ====== --}}
                <x-admin.globals.forms.field type="select" label="Role" name="admin_role" required
                    :svgUrl="asset('assets/svg/shield-user.svg')">
                    <x-slot>
                        <option value="1">Super Admin</option>
                        <option value="2">Admin</option>
                        <option value="3">Editor</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                {{-- ====== Status ====== --}}
                <x-admin.globals.forms.field type="select" label="Status" name="status" required
                    :svgUrl="asset('assets/svg/tag.svg')">
                    <x-slot>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-slot>
                </x-admin.globals.forms.field>

                

                {{-- ====== Profile ====== --}}
                <x-admin.globals.forms.field type="file" class="image-upload&preview" label="Profile" name="profile_image"
                    :svgUrl="asset('assets/svg/image-plus.svg')" />
            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>
@endsection