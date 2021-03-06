<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title','Voto Virtual')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Custom JS -->
        <script src="{{ asset('js/custom.js') }}"></script>
    </head>
    </body class="text-gray-800">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <nav class="bg-white border-b border-gray-100 dark:border-gray-700 dark:bg-gray-800">
                <!-- Primary Navigation Menu -->
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="flex-shrink-0">
                                <a href="{{ route('portal.home') }}">
                                    <svg class="h-12 w-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z" fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z" fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                                    
                                    <!-- Navigation Links -->
                            <div class="">                            
                                <a class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 transition duration-150 ease-in-out border-b-2 border-indigo-400 dark:border-indigo-300 dark:text-gray-200 focus:outline-none focus:border-indigo-700 h-16"
                                    >Voto Virtual</a>
                            </div>

                        </div>
                        
                        <div class="flex items-center ml-6">

                            <div class="relative ml-3">
                                <div>
                                    <span class="inline-flex rounded-md">
                                        <a href="#help"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-200 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-700 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50">
                                            Ayuda !
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div><!-- Full Screen Dropdown Overlay -->

                            <div class="fixed inset-0 z-40" style="display: none;"></div>

                            </div>
                        </div>            

                    </div>
                </div>

            </nav>
            {{--
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">???? Bienvenido !! Web desarrollada para las elecciones Municipio Escolar 2021</h2>
                </div>
            </header>
            --}}
            <main>
                <div class="pt-3 md:pt-8 pb-12">
                    <div class="mx-auto max-w-7xl px-3 sm:px-6 lg:px-8">
                        <div class="overflow-hidden bg-white shadow-xl rounded-md sm:rounded-lg">
                            <div>
                                <div class="pb-12 bg-white px-3 sm:px-20">

                                    <div class="mt-3 md:mt-8 text-lg text-center md:text-left md:text-2xl mb-4">Para emitir su voto seleccione su <strong>Instuci??n Educativa</strong>:</div>

                                    <div>

                                        @if(Session::has('message'))
                                            @if(Session::get('type') == 'success')
                                                @include('portal.components.alert.success',['message'=>Session::get('message')])
                                            @endif

                                            @if(Session::get('type') == 'danger')
                                                @include('portal.components.alert.danger',['message'=>Session::get('message')])
                                            @endif

                                            @if(Session::get('type') == 'warning')
                                                @include('portal.components.alert.warning',['message'=>Session::get('message')])
                                            @endif

                                        @endif

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2_ md:grid-cols-3 md:gap-8">
                                            @foreach($schools as $school)
                                                <a href="{{url('portal/'.$school->slug)}}" class="sm:flex bg-white rounded-lg shadow-md p-6 block transition duration-500 group bg-gray-300 hover:bg-blue-400 hover:border-indigo-900 hover:shadow-sm bg-opacity-25 relative">
                                                    <div class="sm:flex-none">
                                                        <img src="{{ asset($school->logo) }}" alt="" class="w-14 md:16 mx-auto sm:pr-4">
                                                    </div>
                                                    <div class="text-center md:text-left">
                                                        <h3 class="text-indigo-700 group-hover:text-indigo-900 text-md md:text-lg font-medium">{{ $school->name }}</h3>
                                                        <p class="group-hover:text-white text-gray-500 text-xs md:text-sm">{{ $school->description }}</p>
                                                    </div>
                                                    
                                                    <div class="absolute bottom-0 right-0 m-2 text-indigo-500 group-hover:text-gray-50">
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>

                                <div class="bg-indigo-50 bg-opacity-90" id="help">
                                    <h1 class="text-center font-bold text-lg text-indigo-500 p-4">Realiza su voto en 4 sencillos pasos</h1>
                                </div>

                                <div class="grid grid-cols-1 bg-gray-200 bg-opacity-25 dark:bg-gray-800 md:grid-cols-2">
                                
                                    <div class="p-6 bg-green-200">
                                        <div class="flex items-center">
                                            <div class="flex-none text-xl text-center font-bold text-green-500 bg-green-300 rounded-full w-8 h-8 pt-1 md:p-0">1</div>
                                            <div
                                                class="ml-4 text-lg font-semibold leading-7 text-gray-600 dark:text-gray-200">
                                                <a href="https://laravel.com/docs">Recibe SMS con tu c??digo de votaci??n</a>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                Si el mensaje no te lleg??, consulte con la Comisi??n Electoral o con la persona encargada del Voto Virtual.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-6 bg-yellow-200 border-t border-yellow-200 dark:border-yellow-700 md:border-t-0 md:border-l">
                                        <div class="flex items-center">
                                            <div class="flex-none text-xl text-center font-bold text-yellow-500 bg-yellow-300 rounded-full w-8 h-8 pt-1 md:p-0">2</div>
                                            <div
                                                class="ml-4 text-lg font-semibold leading-7 text-gray-600 dark:text-gray-200">
                                                <a href="https://laracasts.com">Ingrese su DNI y c??digo de votaci??n</a>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                Seleccione la IE en donde est?? estudiando, luego ingrese su DNI y C??digo de votaci??n.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-6 bg-pink-200 border-t border-pink-200 dark:border-pink-700">
                                        <div class="flex items-center">
                                            <div class="flex-none text-xl text-center font-bold text-pink-500 bg-pink-300 rounded-full w-8 h-8 pt-1 md:p-0">3</div>
                                            <div
                                                class="ml-4 text-lg font-semibold leading-7 text-gray-600 dark:text-gray-200">
                                                <a href="https://tailwindcss.com/">Seleccione su candidato</a>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400"> 
                                                {{-- El m??nimo de candidatos elegibles son dos.--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-6 bg-indigo-200 border-t border-indigo-200 dark:border-indigo-700 md:border-l">
                                        <div class="flex items-center">
                                            <div class="flex-none text-xl text-center font-bold text-indigo-500 bg-indigo-300 rounded-full w-8 h-8 pt-1 md:p-0">4</div>
                                            <div
                                                class="ml-4 text-lg font-semibold leading-7 text-gray-600 dark:text-gray-200">
                                                Confirme su candidato preferido , y ??listo!...??ya votaste! :)</div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                D??spues de confirmar le aparecer?? un mensaje verde de ?? EXITO ! , el cu??l indica que su voto se realiz?? de manera exitosa y sin problemas.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </body>
</html>