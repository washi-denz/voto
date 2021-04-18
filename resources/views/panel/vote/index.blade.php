@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')
<div class="py-0">

    <div class="">
        <h4 class="text-lg font-bold uppercase">
            Resultados de votación
            <a href="{{route('panel.vote.report')}}"
                class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase text-xs"
                target="_blank">Generar
                PDF</a>
        </h4>
    </div>

    <div class="my-6">

        <div class="w-full">
            <div class="mx-auto my-6">
                <div class="bg-gray-50 shadow p-6 rounded-lg">
                    <div class="md:flex md:justify-between md:items-center">
                        <div>
                            <h2 class="text-xl text-gray-800 font-bold leading-tight">Alcaldía</h2>
                            <p class="mb-2 text-gray-600 text-sm">Padrón electoral : {{ $total }}</p>
                            <p class="mb-2 text-gray-600 text-sm">Actas procesadas : {{ ($total/100)*$emitido  }}%</p>
                        </div>

                        <!-- Legends -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-green-500 mr-2 rounded-full"></div>
                                <div class="text-sm text-gray-700">Votos</div>
                            </div>
                        </div>
                    </div>


                    <div class="line relative my-20">

                        <!-- Bar Chart ml-6 -mt-9 -->
                        <div class="flex -mx-2 items-end my-2">
                            @foreach ($candidates as $candidate)
                            <div class="px-2 w-1/6 md:w-1/12">
                                <div class="transition ease-in duration-200 bg-green-500 hover:bg-green-400 relative"
                                    style="height:{{ round( ((100/$total)*$candidate->votes->count()), 2) }}px">
                                    <div class="absolute ml-2 -mt-5 sm:ml-6 sm:-mt-9">
                                        <img src="{{ asset($candidate->logo) }}" class="w-8"
                                            title="{{ $candidate->party_name }}" />
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Labels -->
                        <div class="border-t border-gray-400 mx-auto"></div>
                        <div class="flex -mx-2 items-end">
                            @foreach ($candidates as $candidate)
                            <div class="px-2 w-1/6 md:w-1/12">
                                <div class="bg-red-600 relative">
                                    <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto"
                                        style="width: 1px"></div>
                                    <div x-text="data"
                                        class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm">
                                        {{round( ((100/$total)*$candidate->votes->count()), 2)}}% </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <table class="border-collapse w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center hidden lg:table-cell" style="width: 60%">Candidato</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell" style="width: 40%" colspan="3">Votos</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @foreach ($candidates as $candidate)
                <tr class="bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200 lg:text-left">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Candidato</span>

                        <div class="bg-white">
                            <div class="flex flex-col items-center w-full bg-white rounded-3xl lg:flex-row">
                                <div class="relative flex border-2 border-gray-400 rounded-lg">
                                    <div class="object-contain flex items-center overflow-hidden w-24 h-24 bg-white">
                                        <img src="{{asset($candidate->census->photo)}}"
                                            alt="{{$candidate->census->name}} {{$candidate->census->last_name}}" />
                                    </div>
                                    <img class="absolute w-12 h-12 right-0 bottom-0 rounded-full"
                                        src="{{asset($candidate->logo)}}" alt="{{$candidate->party_name}}">
                                </div>
                                <div class="flex flex-col space-y-4 ml-0 lg:ml-4">
                                    <div class="flex flex-col items-center lg:items-start">
                                        <h2 class="text-xl font-medium">{{$candidate->census->name}}
                                            {{$candidate->census->last_name}}</h2>
                                        <p class="text-base font-medium text-gray-400">{{$candidate->party_name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200 lg:text-left">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Votos</span>
                        <p class="text-center">{{$candidate->votes->count()}}</p>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200 lg:text-left">
                        <div class="mt-4 lg:mt-0">
                            <div class="bg-gray-400 w-full h-4 rounded-lg mt-2 overflow-hidden">
                                <div class="bg-green-400 h-full rounded-lg shadow-md"
                                    style="width: {{round( ((100/$total)*$candidate->votes->count()), 2)}}%"></div>
                            </div>
                            <p class="text-gray-600 text-center font-bold">
                                {{round( ((100/$total)*$candidate->votes->count()), 2)}}%
                            </p>
                        </div>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200 lg:text-left">
                        <div class="mt-4 lg:mt-0">
                            <div class="bg-gray-400 w-full h-4 rounded-lg mt-2 overflow-hidden">
                                <div class="bg-green-400 h-full rounded-lg shadow-md"
                                    style="width: {{round( ((100/$emitido)*$candidate->votes->count()), 2)}}%"></div>
                            </div>
                            <p class="text-gray-600 text-center font-bold">
                                {{round( ((100/$emitido)*$candidate->votes->count()), 2)}}%
                            </p>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
