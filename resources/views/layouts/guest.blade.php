<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title',config('app.name', 'Laravel'))</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>
</head>

<body class="font-sans antialiased">

    @include('layouts.navigate')

    <div class="grid grid-cols-12 h-screen relative">
        <div class="col-span-12 absolute w-full mt-20">
            <main class="bg-white max-auto px-8 py-5">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>
