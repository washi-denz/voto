<header class="bg-white shadow-md w-full fixed z-20 top-0 h-20">
    <div class="max-auto px-8 py-5 bg-white">
        <div class="flex justify-between">

            <div class="logo flex items-center space-x-4 mr-10">
                <img class="h-10 w-11" 
                    src="{{ asset('images/vote/logo_chacaneque.png') }}"
                    alt="IES Agropecuario Chacaneque">
                   <h1 class="text-gray-600 text-sm md:text-2xl"><strong class="font-mono">ADMIN</strong> <span class="hidden sm:block">IES Agropecuario - Chacaneque</span></h1>
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
