@extends('admin.layouts.main')
@section('title', 'Doctors')


@section('breadcrumb')
<x-admin.globals.breadcrumb :items="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Doctors', 'url' => route('doctor.index')],['label' => 'Edit Doctor', 'active' => true]]" />
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
        <x-admin.globals.forms.form :action="route('doctor.update')" method="POST" enctype="multipart/form-data">
            <x-slot:extra_methods>
                @method('put')
            </x-slot:extra_methods>
            <x-slot name="fields">
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

                <x-admin.globals.forms.field type="hidden" name="id" value="{{ $data['doctor']->id }}" />

            </x-slot>

            <x-slot name="action_buttons">
                <x-admin.globals.buttons.quinary type="url" :url="route('doctor.index')" label="Cancel" :svgUrl="asset('assets/svg/corner-up-left.svg')" />
                <x-admin.globals.buttons.quaternary type="submit" class="flex-1" label="Save" :svgUrl="asset('assets/svg/white-save.svg')" />
            </x-slot>

        </x-admin.globals.forms.form>
    </x-slot>
</x-admin.globals.modal>

@endsection