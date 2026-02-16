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



@if(isset($data['admin']))

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
@endif


@if(isset($data['staff']))
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

    {{-- -========  PROFILE HEADER BANNER ======== --}}
    <x-admin.globals.profile.header :admin="$data['staff']" />

    {{-- -======== Form ======== --}}
    <div class="px-8 py-6 overflow-y-auto h-[90%]">
        <x-admin.globals.forms.form-secondary id="dataForm" :action="route('profile.update')" method="POST" enctype="multipart/form-data">

            <x-slot:fields>

                @method('put')
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 mb-5">
                    {{-- ====== Full Name ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Full Name"
                        name="full_name"
                        value="{{ $data['staff']->full_name ?? '' }}"
                        required
                        placeholder="Enter Full Name"
                        :svgUrl="asset('assets/svg/user-check.svg')" />

                    {{-- ====== Email ====== --}}
                    <x-admin.globals.forms.field
                        type="email"
                        label="Email"
                        name="email"
                        value="{{ $data['staff']->email ?? '' }}"
                        required
                        placeholder="Enter Email"
                        :svgUrl="asset('assets/svg/mail.svg')" />

                    {{-- ====== Password ====== --}}
                    <x-admin.globals.forms.field
                        type="password"
                        label="Password"
                        name="password"
                        placeholder="Enter Password"
                        :svgUrl="asset('assets/svg/lock.svg')" />

                    {{-- ====== Confirm Password ====== --}}
                    <x-admin.globals.forms.field
                        type="password"
                        label="Confirm Password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        :svgUrl="asset('assets/svg/lock.svg')" />

                    {{-- ====== Phone ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Phone"
                        name="phone"
                        value="{{ $data['staff']->phone ?? '' }}"
                        placeholder="Enter Phone Number"
                        :svgUrl="asset('assets/svg/phone.svg')" />

                    {{-- ====== Gender ====== --}}
                    <x-admin.globals.forms.field
                        type="select"
                        label="Gender"
                        name="gender"
                        required
                        :svgUrl="asset('assets/svg/venus.svg')">
                        <x-slot>
                            <option value="MALE" {{ ($data['staff']->gender ?? '') === 'MALE' ? 'selected' : '' }}>Male</option>
                            <option value="FEMALE" {{ ($data['staff']->gender ?? '') === 'FEMALE' ? 'selected' : '' }}>Female</option>
                            <option value="OTHER" {{ ($data['staff']->gender ?? '') === 'OTHER' ? 'selected' : '' }}>Other</option>
                        </x-slot>
                    </x-admin.globals.forms.field>

                    {{-- ====== Role ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Role"
                        name="role"
                        value="{{ $data['staff']->role ?? '' }}"
                        required
                        placeholder="Enter Role"
                        :svgUrl="asset('assets/svg/shield-user.svg')">
                        <option>Staff</option>
                    </x-admin.globals.forms.field>

                    {{-- ====== Date of Birth ====== --}}
                    <x-admin.globals.forms.field
                        type="date"
                        label="Date of Birth"
                        name="date_of_birth"
                        value="{{ $data['staff']->date_of_birth ?? '' }}"
                        placeholder="Select Date of Birth"
                        :svgUrl="asset('assets/svg/calendar.svg')" />

                    {{-- ====== Join Date ====== --}}
                    <x-admin.globals.forms.field
                        type="date"
                        label="Join Date"
                        name="join_date"
                        value="{{ $data['staff']->join_date ?? '' }}"
                        required
                        placeholder="Select Join Date"
                        :svgUrl="asset('assets/svg/calendar-check.svg')" />

                    {{-- ====== Job Title ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Job Title"
                        name="job_title"
                        value="{{ $data['staff']->job_title ?? '' }}"
                        placeholder="Enter Job Title"
                        :svgUrl="asset('assets/svg/briefcase.svg')" />

                    {{-- ====== Department ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        label="Department"
                        name="department"
                        value="{{ $data['staff']->department ?? '' }}"
                        placeholder="Enter Department"
                        :svgUrl="asset('assets/svg/building.svg')" />


                    {{-- ====== Status ====== --}}
                    <x-admin.globals.forms.field
                        type="select"
                        label="Status"
                        name="status"
                        required
                        :svgUrl="asset('assets/svg/status.svg')">
                        <x-slot>
                            <option value="ACTIVE" {{ ($data['staff']->status ?? '') === 'ACTIVE' ? 'selected' : '' }}>Active</option>
                            <option value="INACTIVE" {{ ($data['staff']->status ?? '') === 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                            <option value="ONLEAVE" {{ ($data['staff']->status ?? '') === 'ONLEAVE' ? 'selected' : '' }}>On Leave</option>
                        </x-slot>
                    </x-admin.globals.forms.field>

                    <div class="col-span-1">
                        {{-- ====== Address ====== --}}
                        <x-admin.globals.forms.field
                            type="textarea"
                            label="Address"
                            name="address"
                            value="{{ $data['staff']->address ?? '' }}"
                            placeholder="Enter Address"
                            :svgUrl="asset('assets/svg/map.svg')" />
                    </div>


                </div>
                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['staff']->id }}" />
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
@endif



@if(isset($data['doctor']))
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

    {{-- -========  PROFILE HEADER BANNER ======== --}}
    <x-admin.globals.profile.header :admin="$data['doctor']" />

    {{-- -======== Form ======== --}}
    <div class="px-8 py-6 overflow-y-auto h-[90%]">
        <x-admin.globals.forms.form-secondary id="dataForm" :action="route('profile.update')" method="POST" enctype="multipart/form-data">

            <x-slot:fields>

                @method('put')
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 mb-5">
                    {{-- ====== name ====== --}}
                    <x-admin.globals.forms.field type="text" value="{{ $data['doctor']->full_name ?? '' }}" label="Full Name" name="full_name" required
                        placeholder="Enter Full Name" :svgUrl="asset('assets/svg/user-check.svg')" />

                    {{-- ====== Phone ====== --}}
                    <x-admin.globals.forms.field type="text" value="{{ $data['doctor']->phone_number ?? '' }}" label="Phone" name="phone_number" placeholder="Enter Phone No"
                        :svgUrl="asset('assets/svg/phone.svg')" />

                    {{-- ====== Email ====== --}}
                    <x-admin.globals.forms.field type="email" value="{{ $data['doctor']->email ?? '' }}" label="Email" name="email" required
                        placeholder="Enter Email" :svgUrl="asset('assets/svg/sigma.svg')" />


                    {{-- ====== Password ====== --}}
                    <x-admin.globals.forms.field type="password" label="Password" name="password" placeholder="Enter password"
                        :svgUrl="asset('assets/svg/lock.svg')" />

                    {{-- ====== Confirm Password ====== --}}
                    <x-admin.globals.forms.field type="password" label="Confirm Password" name="password_confirmation" placeholder="Enter confirm password"
                        :svgUrl="asset('assets/svg/lock.svg')" />

                    {{-- ====== Role ====== --}}
                    <x-admin.globals.forms.field type="select" label="Role" name="role" required
                        :svgUrl="asset('assets/svg/shield-check.svg')">
                        <x-slot>
                            <option value="DOCTOR">Doctor</option>
                        </x-slot>
                    </x-admin.globals.forms.field>

                    {{-- ====== Consultation Fee ====== --}}
                    <x-admin.globals.forms.field type="numeric" label="Consultation Fee" value="{{ $data['doctor']->consultation_fee ?? '' }}" name="consultation_fee" placeholder="Enter Consultation Fee"
                        :svgUrl="asset('assets/svg/=dollar-sign.svg')" />

                    {{-- ====== Speciality ====== --}}
                    <x-admin.globals.forms.field type="text" label="Speciality" value="{{ $data['doctor']->speciality ?? '' }}" name="speciality" placeholder="Enter Speciality"
                        :svgUrl="asset('assets/svg/stethoscope.svg')" />

                    {{-- ====== Department ====== --}}
                    <x-admin.globals.forms.field type="text" label="Department" value="{{ $data['doctor']->department ?? '' }}" name="department" placeholder="Enter Department"
                        :svgUrl="asset('assets/svg/building.svg')" />

                    {{-- ====== Experience ====== --}}
                    <x-admin.globals.forms.field type="number" label="Experience" value="{{ $data['doctor']->experience ?? '' }}" name="experience" placeholder="Enter Experience"
                        :svgUrl="asset('assets/svg/clock.svg')" />


                    {{-- ====== Status ====== --}}
                    <x-admin.globals.forms.field type="select" label="Status" name="status" required
                        :svgUrl="asset('assets/svg/tag.svg')">
                        <x-slot>
                            <option value="ACTIVE" {{ $data['doctor']->status == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                            <option value="INACTIVE" {{ $data['doctor']->status == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                            <option value="ONLEAVE" {{ $data['doctor']->status == 'ONLEAVE' ? 'selected' : '' }}>On Leave</option>
                        </x-slot>
                    </x-admin.globals.forms.field>

                    {{-- ====== Position ====== --}}
                    <x-admin.globals.forms.field type="select" label="Position" name="position" required
                        :svgUrl="asset('assets/svg/award.svg')">
                        <x-slot>
                            <option value="JUNIOR" {{ $data['doctor']->position == 'JUNIOR' ? 'selected' : '' }}>Junior</option>
                            <option value="SENIOR" {{ $data['doctor']->position == 'SENIOR' ? 'selected' : '' }}>Senior</option>
                            <option value="CONSULTANT" {{ $data['doctor']->position == 'CONSULTANT' ? 'selected' : '' }}>Consultant</option>
                            <option value="HEAD" {{ $data['doctor']->position == 'HEAD' ? 'selected' : '' }}>Head</option>
                        </x-slot>
                    </x-admin.globals.forms.field>

                    {{-- ====== License Number ====== --}}
                    <x-admin.globals.forms.field type="text" value="{{ $data['doctor']->license_number ?? '' }}" label="License Number" name="license_number" placeholder="Enter License Number" required
                        :svgUrl="asset('assets/svg/id-card.svg')" />

                    {{-- ====== Join Date ====== --}}
                    <x-admin.globals.forms.field type="date" label="Join Date" value="{{ $data['doctor']->join_date ?? '' }}" name="join_date" placeholder="Enter License Number"
                        :svgUrl="asset('assets/svg/calendar.svg')" />

                    {{-- ====== Availability ====== --}}
                    <x-admin.globals.forms.field type="text" label="Availability" value="{{ $data['doctor']->availability ?? '' }}" name="availability" placeholder="Enter Availability"
                        :svgUrl="asset('assets/svg/clock.svg')" />

                    {{-- ====== Location ====== --}}
                    <x-admin.globals.forms.field type="text" label="Location" value="{{ $data['doctor']->location ?? '' }}" name="location" placeholder="Enter Location"
                        :svgUrl="asset('assets/svg/map-pin.svg')" />


                    {{-- ====== Facebook ====== --}}
                    <x-admin.globals.forms.field type="text"
                        label="Facebook Profile" value="{{ $data['doctor']->fb_profile ?? '' }}"
                        name="fb_profile"
                        placeholder="Enter Facebook URL"
                        :svgUrl="asset('assets/svg/facebook.svg')" />

                    {{-- ====== Linkedin ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        value="{{ $data['doctor']->linkedin_profile ?? '' }}"
                        label="LinkedIn Profile"
                        name="linkedin_profile"
                        placeholder="Enter LinkedIn URL"
                        :svgUrl="asset('assets/svg/linkedin.svg')" />

                    {{-- ====== Twitter ====== --}}
                    <x-admin.globals.forms.field
                        type="text"
                        value="{{ $data['doctor']->twitter_profile ?? '' }}"
                        label="Twitter Profile"
                        name="twitter_profile"
                        placeholder="Enter Twitter URL"
                        :svgUrl="asset('assets/svg/twitter.svg')" />

                    {{-- ====== Profile ====== --}}
                    <x-admin.globals.forms.field type="file" class="image-upload&preview" label="Profile" name="profile_image"
                        :svgUrl="asset('assets/svg/image-plus.svg')">

                        @if (isset($data['doctor']->profile_image))
                        <x-slot:file_preview>
                            <div class="relative inline-flex gap-2">
                                <img src="{{ asset('storage/' . $data['doctor']->profile_image) }}"
                                    class="w-24 h-24 object-cover rounded border">
                            </div>
                        </x-slot:file_preview>
                        @endif
                    </x-admin.globals.forms.field>

                    {{-- ====== Description ====== --}}
                    <x-admin.globals.forms.field type="textarea" value="{{ $data['doctor']->description ?? '' }}" label="Description" name="description" placeholder="Enter Description"
                        :svgUrl="asset('assets/svg/file-text.svg')" />

                </div>
                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['doctor']->id }}" />
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
@endif

@endsection