<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        @yield('title')
    </title>

    @vite('resources/css/admin/app.css')

</head>

<body class="flex min-h-screen overflow-hidden">

    <!--================= Main content==================-->
    <main class="flex-1 overflow-y-auto p-3 bg-gray-50">
        @yield('content')
    </main>

    @vite('resources/js/admin/script.js')
</body>

</html>
