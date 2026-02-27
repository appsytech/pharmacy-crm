<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <x-web.layouts.head>
        <x-slot:title>
            @yield('title')
        </x-slot:title>
    </x-web.layouts.head>
</head>

<body>
    <!--********************************
   		Code Start From Here
	******************************** -->
    <x-web.layouts.sidemenu />

    <x-web.layouts.search-popup />

    <!--==============================
    Mobile Menu
    ============================== -->
    <x-web.layouts.mobile-menu />

    <!--==============================
	Header Area
    ==============================-->
    <x-web.headers.header />

    @yield('content')


    <!--==============================
	Footer Area
    ==============================-->
    <x-web.footers.footer />


    <!--==============================
    All Js File
    ============================== -->

    <!-- Bootstrap -->
    <!-- <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> -->
    @vite('resources/js/web/script.js');


    <!-- Counter Up -->
    <!-- <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script> -->
    <!-- datetimepicker -->
    <!-- <script src="{{ asset('assets/js/jquery.datetimepicker.min.js') }}"></script> -->
    <!-- Range Slider -->
    <!-- <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script> -->
    <!-- Isotope Filter -->
    <!-- <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script> -->

    <!-- Main Js File -->
    <!-- <script src="{{ asset('assets/js/main.js') }}"></script> -->
</body>

</html>