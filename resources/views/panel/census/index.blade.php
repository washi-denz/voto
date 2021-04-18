@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')
<div class="py-0">

    <div class="absolute top-0 left-0 z-0 -mt-8 w-full bg-gray-100">
        <h4 class="py-4 px-14 md:ml-64 text-lg font-normal uppercase">
            Lista de electores
            <a href="{{route('panel.census.create')}}"
                class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase text-xs">Registrar</a>
            <form action="{{ route('panel.census.index') }}" method="GET" class="inline float-right">
                @csrf
                <input type="text" name="document" placeholder="Buscar DNI" class="p-1 rounded">
                <button class="border border-gray-500 bg-gray-500 text-white rounded-md px-3 py-2 m-1 transition duration-500 ease select-none hover:bg-gray-600 focus:outline-none focus:shadow-outline text-xs">Buscar</button>
            </form>
        </h4>
    </div>
    <div class="bg-white my-6 grid justify-items-center">

        @include('panel.components.message')

        <table class="border-collapse w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Nombre y Apellidos</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Telefono</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Codigo</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Estado de Voto</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Accion</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @foreach ($censuses as $census)
                <tr
                    class="bg-white lg:hover:bg-gray-300 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200 lg:text-left">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nombres
                            y Apellidos</span>

                        <div class="">
                            <div class="flex flex-col items-center w-full  rounded-3xl lg:flex-row">
                                <div class="relative flex border-2 border-gray-400 rounded-lg">
                                    <div class="object-contain flex items-center overflow-hidden w-24 h-24 bg-white">
                                        <img src="{{asset($census->photo)}}"
                                            alt="{{$census->name}} {{$census->last_name}}" />
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-4 ml-0 lg:ml-4">
                                    <div class="flex flex-col items-center lg:items-start">
                                        <h2 class="text-xl font-medium">
                                            {{$census->name}}
                                            {{$census->last_name}}
                                        </h2>
                                        <p class="text-base font-medium text-gray-400">
                                            DNI: {{$census->document}}
                                        </p>
                                        <p class="text-base font-medium text-gray-400">
                                            {{$census->grade}}
                                            {{$census->group}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Telefono</span>
                        <span class="block">{{$census->phone}}</span>

                        <div class="flex items-center justify-center text-center space-x-1"
                            x-data="{send:sendSMS('{{$census->phone}}','Participa en la Eleccion escolar\nDNI: {{$census->document}}\nCodigo: {{$census->code}}\n{{asset('/')}}')}">
                            <button type="button"
                                class="block rounded-full h-10 w-10 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none"
                                :class="{'hidden':(send.alert!='' || send.isSuccess)}" title="Notificar por SMS"
                                @click="send.fetchSMS()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-4 w-4 transform rotate-90 inline">
                                    <path
                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                    </path>
                                </svg>
                                <p class="inline text-xs">sms</p>
                            </button>
                            <span class="text-xs text-blue-700" :class="{'hidden':send.isFail}" x-text="send.alert">
                            </span>
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Codigo</span>
                        {{$census->code}}
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Estado
                            de Voto</span>
                        @if ($census->condition == false)
                        <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs font-bold">No Emitido</span>
                        @else
                        <span
                            class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-bold">Emitido</span>
                        @endif
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Accion</span>
                        <div class="flex item-center justify-center">
                            <a href="{{ route('panel.census.show', $census) }}"
                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('panel.census.edit', $census) }}"
                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{route('panel.census.destroy',$census)}}" method="post"
                                x-ref="destroy{{$census->id}}" x-data="">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 focus:outline-none"
                                    x-on:click.prevent="if (confirm('Seguro que desea borrarlo?')) $refs.destroy{{$census->id}}.submit()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-5">
            {{ $censuses->onEachSide(0)->links() }}
        </div>
    </div>
</div>
@endsection
