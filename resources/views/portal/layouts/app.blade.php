<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Voto electrónico')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <style>
        html{
            min-height:100%;
            position:relative;
        }
        .selection input[type="submit"]{
            display:none;
        }
    </style>
</head>

<body class="bg-indigo-900 m-0 mb-12 pb-12">
    @yield('content')
    @include('portal.parts.footer')
</body>

</html>
