<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title',config('app.name', 'Laravel'))</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            span[aria-current="page"]>span{
                background:#3B82F6;
                color:white;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <!-- livewire -->
        @livewireStyles

    </head>

    <body class="text-gray-800">

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">

            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">

                @include('layouts.navigate')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                    <div class="container mx-auto px-6 py-8">

                        @yield('content')

                    </div>
                </main>

            </div>

        </div>
        <!-- Custom JS -->
        <script src="{{ asset('js/custom.js') }}"></script>
        
        <!-- livewire -->
        @livewireScripts
    </body>
    
</html>
