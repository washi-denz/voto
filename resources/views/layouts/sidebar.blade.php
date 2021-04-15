<div  x-data="{open:false}" @click.away="open=false">
    
    <div @click="open=!open" class="fixed bg-gray-600 text-gray-50 text-center rounded-r-lg pl-5 pr-2 py-2 mt-2 top-20 left-0 block sm:hidden z-20 cursor-pointer">&#9776;</div>

    <aside
        class="fixed overflow-hidden -ml-80 sm:m-0 w-auto sm:w-72 z-10 h-screen pt-20 pl-3 sm:pl-0  bg-green-500 border-r border-green-300" :class="{'active':open}">
        <div class="flex w-full p-4">
            <ul class="flex flex-col w-full">
                <li class="my-px">
                    <a href="{{ route('panel.index') }}"
                        class="flex flex-row items-center h-12 px-4 rounded-lg text-green-600 group hover:bg-green-200">
                        <span class="flex items-center justify-center text-lg text-green-300 group-hover:text-green-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-3 text-gray-100 group-hover:text-green-600">Inicio</span>
                    </a>
                </li>
                <li class="my-px">
                    <span class="flex font-medium text-sm text-green-100 px-4 mt-4 uppercase">Elecciones</span>
                </li>
                <li class="my-px">
                    <a href="{{route('panel.vote.index')}}"
                        class="flex flex-row items-center h-12 px-4 rounded-lg text-green-600 group hover:bg-green-200">
                        <span class="flex items-center justify-center text-lg text-green-300 group-hover:text-green-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-3 text-gray-100 group-hover:text-green-600">Votos</span>
                        <span
                            class="flex items-center justify-center text-sm text-green-500 font-semibold bg-green-200 h-6 px-2 rounded-full ml-auto">1k</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="{{route('panel.candidate.index')}}"
                        class="flex flex-row items-center h-12 px-4 rounded-lg text-green-600 group hover:bg-green-200">
                        <span class="flex items-center justify-center text-lg text-green-300 group-hover:text-green-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-3 text-gray-100 group-hover:text-green-600">Candidatos</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="{{route('panel.census.index')}}"
                        class="flex flex-row items-center h-12 px-4 rounded-lg text-green-600 group hover:bg-green-200">
                        <span class="flex items-center justify-center text-lg text-green-300 group-hover:text-green-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-3 text-gray-100 group-hover:text-green-600">Padron</span>
                    </a>
                </li>
                <li class="my-px">
                    <span class="flex font-medium text-sm text-green-100 px-4 mt-4 uppercase">Administrador</span>
                </li>
                <li class="my-px">
                    <a href="#" class="flex flex-row items-center h-12 px-4 rounded-lg text-green-600 group hover:bg-green-200">
                        <span class="flex items-center justify-center text-lg text-green-300 group-hover:text-green-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-3 text-gray-100 group-hover:text-green-600">Usuarios</span>
                    </a>
                </li>
                <li class="my-px">
                    <div class="bg-green-600 border-t border-green-300 border-opacity-20  my-4"></div>
                </li>
                <li class="my-px">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-green-600 group bg-green-400 hover:bg-green-200 w-full">
                            <span class="flex items-center justify-center text-lg text-red-400">
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path
                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-3 text-gray-100 group-hover:text-green-600">Cerrar Session</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

</div>