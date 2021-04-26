<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Voto virtual')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <style>
        html{
            min-height:100%;
            position:relative;
        }
    </style>

    <!-- livewire -->
    @livewireStyles

</head>

<body class="bg-indigo-800 m-0 mb-12 pb-12">

    @include('portal.parts.header')

    <div class="container mx-auto lg:px-40 md:px-8 sm:px-16">
        {{ $slot }}
    </div>
    
    @include('portal.parts.footer')

    <!-- livewire -->
    @livewireScripts

    <script>
        Livewire.on('alert',function(message){
            Swal.fire(
                'The Internet?',
                message,
                'question'
            )
        });
    </script>
</body>

</html>
