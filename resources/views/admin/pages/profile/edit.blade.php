@extends('admin.layouts.main')
@section('title', 'Profile')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Profile', 'url' => route('profile.index')], ['label' => 'Edit Profile', 'active' => true]]" />
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



<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

    {{-- -========  PROFILE HEADER BANNER ======== --}}
    <x-admin.globals.profile.header :admin="$data['admin']" />

    {{-- -======== Form ======== --}}
    <div class="px-8 py-6 overflow-y-auto h-[90%]">
        <x-admin.globals.forms.form-secondary id="dataForm" :action="route('profile.update')" method="POST" enctype="multipart/form-data">

            <x-slot:fields>

                @method('put')
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 mb-5">
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
                    <div class="col-span-1">
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
                    </div>
                    <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['admin']->id }}" />
                </div>
            </x-slot:fields>

            <x-slot:action_button>
                <div class="flex gap-3 justify-end pt-2">
                    <x-admin.globals.buttons.quinary type="url" :url="route('profile.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                    <x-admin.globals.buttons.quaternary type="submit" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
                </div>
            </x-slot:action_button>

        </x-admin.globals.forms.form-secondary>
    </div>
</div>
@endsection