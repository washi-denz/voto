@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')
<div class="py-0">

    <div class="absolute top-0 left-0 z-0 -mt-8 w-full bg-gray-100">
        <div class="py-4 px-14 md:ml-64 text-lg font-normal uppercase">
            Lista de candidatos
            <a href="{{ route('panel.candidate.create') }}" class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase text-xs">Nuevo candidato</a>        
        </div>
    </div>

    <div class="bg-white my-6">

        @include('panel.components.message')

        <table class="border-collapse w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                    <th class="py-3 px-6 text-center hidden lg:table-cell">#</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">DNI</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Nombre y Apellidos</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Foto</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Logo</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Nombre del partido</th>        
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @foreach ($candidates as $key => $candidate)
                <tr
                    class="bg-white lg:hover:bg-gray-300 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200 lg:text-left">                                                 
                        <div class="flex justify-center">
                            {{ $key+1 }}
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">DNI</span>
                        {{ $candidate->document }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">DNI</span>
                        {{ $candidate->name }} {{ $candidate->last_name }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">DNI</span>
                        <div class="flex justify-center lg:inline-flex">
                            <img class="w-6 h-6 rounded-full border-gray-200 border" src="{{ asset($candidate->photo) }}" />
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">DNI</span>
                        <div class="flex justify-center lg:inline-flex">
                            <img class="w-6 h-6 rounded-full border-gray-200 border" src="{{ asset($candidate->logo) }}" />
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">DNI</span>
                        {{ $candidate->party_name }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Accion</span>
                        <div class="flex item-center justify-center">
                            <a href="{{ route('panel.candidate.edit', $candidate) }}"
                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{route('panel.candidate.destroy',$candidate)}}" method="post"
                                x-ref="destroy{{$candidate->id}}" x-data="">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 focus:outline-none"
                                    x-on:click.prevent="if (confirm('Seguro que desea borrarlo?')) $refs.destroy{{$candidate->id}}.submit()">
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
            {{ $candidates->onEachSide(0)->links() }}
        </div>
    </div>
</div>
@endsection
