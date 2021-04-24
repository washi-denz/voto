<header class="flex justify-between items-center py-4 px-6 bg-white border-b border-gray-100">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>

        <div class="relative mx-4 lg:mx-0">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </span>

            <input class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                placeholder="Search">
        </div>
    </div>

    <div class="flex items-center">
        @auth
        <div x-data="{ notificationOpen: false }" class="relative">
            <button @click="notificationOpen = ! notificationOpen"
                class="flex mx-4 text-gray-600 focus:outline-none">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>

            <div x-show="notificationOpen" @click="notificationOpen = false"
                class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>

            <div x-show="notificationOpen"
                class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10"
                style="width: 20rem; display: none;">
                <a href="#"
                    class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                    <p class="text-sm mx-2">
                        <span class="font-bold" href="#">Voto Electrónico 1.2</span><br><span> Desarrollado con Laravel 8 </span>
                    </p>
                </a>
            </div>
        </div>

        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = ! dropdownOpen"
                class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                <img class="h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80"
                    alt="Your avatar">
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                style="display: none;"></div>

            <div x-show="dropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                style="display: none;">
                <a href="{{ route('panel.vote.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Resultados</a>
                <a href="{{ route('panel.candidate.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Candidatos</a>
                <a href="{{ route('panel.census.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Padrón</a>
                <hr>
                <form action="{{route('logout')}}" method="post">
                        @csrf
                    <button type="submit"
                    class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Cerrar sesión</button>
                </form>
            </div>
        </div>
        @else
        <div class="menu flex justify-end items-center space-x-4">
            <nav>
                <ul class="md:flex items-right justify-end text-base text-gray-700 pt-0">
                    <li>
                        <a class="font-bold md:px-4 pb-3 px-0 block border-b-2 border-transparent hover:border-indigo-400"
                            href="{{route('login')}}">
                            Iniciar sesion
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @endauth

    </div>
</header>


{{--
<header class="bg-white shadow-md w-full fixed z-20 top-0 h-20">
    <div class="max-auto px-8 py-5 bg-white">
        <div class="flex justify-between">

            <div class="logo flex items-center space-x-4 mr-10">
                <img class="h-10 w-11" 
                    src="{{ asset('images/vote/logo_chacaneque.png') }}"
                    alt="IES Agropecuario Chacaneque">
                   <h1 class="text-gray-600 text-sm md:text-base"><strong class="font-mono">ADMIN</strong> <span class="hidden sm:inline-block">IES Agropecuario - Chacaneque</span></h1>
            </div>
            @auth
            <div class="menu flex justify-end items-center space-x-4">
                <svg class="h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg class="h-7 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <svg class="h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>

                <div @click.away="userMenu = false" class="ml-3 relative" x-data="{ userMenu: false }">
                    <div>
                        <button @click="userMenu = !userMenu" x-bind:aria-expanded="userMenu"
                            class="flex text-sm focus:outline-none items-center">
                            <img class="h-9 rounded-full border border-gray-100 shadow-sm"
                                src="https://randomuser.me/api/portraits/men/11.jpg" alt="{{Auth::user()->username}}" />
                        </button>
                    </div>
                    <div x-show="userMenu" x-description="Profile dropdown panel, show/hide based on dropdown state."
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu" style="display: none;">
                        <a href="{{route('panel.index')}}"
                            class="px-3 py-2 text-sm flex items-center h-full hover:text-blue-600 hover:bg-gray-100">
                            <span>Panel</span>
                        </a>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit"
                                class="w-full focus:outline-none border-gray-300 border-t block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-bold">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            @else
            <div class="menu flex justify-end items-center space-x-4">
                <nav>
                    <ul class="md:flex items-right justify-end text-base text-gray-700 pt-0">
                        <li>
                            <a class="font-bold md:px-4 pb-3 px-0 block border-b-2 border-transparent hover:border-indigo-400"
                                href="{{route('login')}}">
                                Iniciar sesion
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            @endauth
        </div>
    </div>
</header>
--}}