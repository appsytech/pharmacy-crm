<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    @vite('resources/css/admin/app.css')

</head>

<body class="flex min-h-screen overflow-hidden">

    <x-admin.sidebar />

    <!-- ====================== Main Content Area -with header ===================== -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden w-full">
        <x-admin.headers.header />

        @yield('breadcrumb')

        <!--================= Main content==================-->
        <main class="flex-1 overflow-y-auto p-3 bg-gray-50">
            @yield('content')
        </main>
    </div>

    @vite('resources/js/admin/script.js')
</body>

</html>
