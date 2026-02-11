@extends('admin.layouts.auth')
@section('title', 'Login')

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

<div class="min-h-screen w-full flex justify-center items-center">
    <div class="w-full max-w-md">
        <!--======= Login Card =====-->
        <div class="bg-white rounded-2xl shadow-lg p-8">

            <div class="flex justify-center items-center mb-3">
                <div class="w-18 h-18 rounded-lg flex items-center justify-center shadow-lg">
                    <img src="https://www.creativefabrica.com/wp-content/uploads/2022/04/14/A-Symbol-Company-Logo-Design-Vector-Graphics-28995233-3-580x387.jpg"
                        alt="Logo" class="w-full h-full object-cover rounded-lg">
                </div>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h1>
                <p class="text-gray-600">Sign in to your account to continue</p>
            </div>

            <x-admin.globals.forms.form-secondary :action="route('login.proceed')" method="POST" class="space-y-5">
                <x-slot name="fields">

                    {{-- ==== Email ==== --}}
                    <x-admin.globals.forms.form-field-secondary type="email" name="credential" label="credential" required
                        :leftIcon="asset('assets/svg/mail-light-gray.svg')" placeholder="Enter Email" />

                    {{-- ==== Password ==== --}}
                    <x-admin.globals.forms.form-field-secondary type="password" id="password-field" name="password" required
                        label="Password" :leftIcon="asset('assets/svg/lock-light-gray.svg')" placeholder="Enter Password">

                        <x-slot name="right_button">
                            <x-admin.globals.buttons.no-class-button
                                class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password-field"
                                :svgUrl="asset('assets/svg/eye-light-gray.svg')" data-targetId="password-field"
                                data-eye="{{ asset('assets/svg/eye-light-gray.svg') }}"
                                data-eyeoff="{{ asset('assets/svg/eye-off-light-gray.svg') }}" />
                        </x-slot>

                    </x-admin.globals.forms.form-field-secondary>

                </x-slot>

                <x-slot name="action_button">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-200 flex items-center justify-center gap-2 transform hover:scale-105 hover:shadow-lg group/signin">
                        Sign In
                        <img src="{{ asset('assets/svg/arrow-right-white.svg') }}"
                            class="w-5 h-5 pointer-events-none transition-all duration-300 group-hover/signin:translate-x-2">
                    </button>
                </x-slot>
            </x-admin.globals.forms.form-secondary>

        </div>

        <!--======= Footer =======-->
        <p class="text-center text-sm text-gray-500 mt-6">
            © 2025 Buddha School. All rights reserved.
        </p>
    </div>
</div>
@endsection