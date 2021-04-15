@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')
<div class="py-0">

    <div class="absolute top-0 left-0 z-0 -mt-8 w-full bg-gray-100">
        <h4 class="py-4 px-14 sm:ml-64 text-lg font-normal uppercase">
            Resultados de votación        
        </h4>
    </div>

    <div class="bg-white my-6 grid justify-items-center">
        <table class="border-collapse w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center hidden lg:table-cell">Candidato</th>
                    <th class="py-3 px-6 text-center hidden lg:table-cell" colspan="2">Votos</th>
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
                                    <img class="w-auto h-24" src="{{asset($candidate->census->photo)}}"
                                        alt="{{$candidate->census->name}} {{$candidate->census->last_name}}" />
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
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
