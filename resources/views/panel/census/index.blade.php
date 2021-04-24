@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')

<x-sub-title>
    <x-slot name="title">Lista de electores</x-slot>
    <x-slot name="content1">
        <a href="{{route('panel.census.create')}}" class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-2 mb-2 ml-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase text-xs inline-block">Registrar</a>
    </x-slot>
    <x-slot name="content2">
        <div class="relative inline-block">
            <form>
                <input type="text" name="document" placeholder="Nombre o Apellido" class="mb-2 ml-2 p-1 rounded border">
                <button type="submit" class="absolute top-1.5 right-2">
                    <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>     
                </button>
            </form>
        </div>
        
        <div class="relative inline-block">
            <form action="{{ route('panel.census.index') }}" method="GET">
                @csrf
                <input type="text" name="document" placeholder="DNI" class="w-32 mb-2 ml-2 p-1 rounded border">
                <button type="submit" class="absolute top-1.5 right-2">
                    <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>     
                </button>
            </form>
        </div>
        <a href="{{route('panel.census.index')}}" class="border border-gray-500 bg-gray-500 text-white rounded-md px-3 py-2 mb-2 ml-2 transition duration-500 ease select-none hover:bg-gray-600 focus:outline-none focus:shadow-outline text-xs inline-block">Todo</a>
    </x-slot>
</x-sub-title>

@include('panel.components.message')

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div
            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Nombres y Apellidos
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Telefono
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Código
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Estado de voto
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                </thead>

                <tbody class="bg-white">
                    @foreach ($censuses as $census)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ asset($census->photo) }}"
                                            alt="{{ $census->name }} {{ $census->last_name }}">
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$census->name}} {{$census->last_name}}
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500">
                                            DNI: {{$census->document}} . {{ $census->grade }} . {{ $census->group }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">

                                <div class="flex justify-center ">
                                    <div class="text-center">
                                        <span class="block">{{$census->phone}}</span>

                                        <div class="text-xs"
                                            x-data="{send:sendSMS('{{$census->phone}}','Participa en la Eleccion escolar\nDNI: {{$census->document}}\nCodigo: {{$census->code}}\n{{asset('/')}}')}">
                                            <button type="button"
                                                class="rounded-md px-2 py-1 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none"
                                                :class="{'hidden':(send.alert!='' || send.isSuccess)}" title="Notificar por SMS"
                                                @click="send.fetchSMS()">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                    class="h-4 w-4 transform rotate-90 inline">
                                                    <path
                                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                    </path>
                                                </svg>
                                                <p class="inline">sms</p>
                                            </button>
                                            <span class="text-xs text-blue-700" :class="{'hidden':send.isFail}" x-text="send.alert"></span>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <div class="text-sm">{{ $census->code }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">

                                @if ($census->condition == false)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">No Emitido</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Emitido</span>
                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">

                                <div class="flex item-center justify-center">
                                    <a href="{{ route('panel.census.edit', $census) }}"
                                        class="w-4 mr-2 transform hover:text-indigo-500 hover:scale-110">
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
                                            class="w-4 mr-2 transform hover:text-indigo-500 hover:scale-110 focus:outline-none"
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

        </div>
    </div>
</div>

<div class="py-5">
    {{ $censuses->onEachSide(0)->links() }}
</div>

@endsection