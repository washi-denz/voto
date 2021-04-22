@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')

<h3 class="text-gray-700 text-3xl font-medium">Resultados</h3>

<div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 28 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                fill="currentColor"></path>
                            <path
                                d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                fill="currentColor"></path>
                            <path
                                d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                fill="currentColor"></path>
                            <path
                                d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                fill="currentColor"></path>
                            <path
                                d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                fill="currentColor"></path>
                            <path
                                d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $total }}</h4>
                        <div class="text-gray-500">Padrón Electoral</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-green-600 bg-opacity-75">
                        <svg class="w-8 h-8 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                            </path>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ round((100/$total)*$emitido,2)  }}%</h4>
                        <div class="text-gray-500">Actas procesadas</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-yellow-600 bg-opacity-75">
                        <svg class="h-8 w-8 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $candidates->count() }}</h4>
                        <div class="text-gray-500">Número de candidatos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<div class="w-full">
    <div class="mx-auto my-6">
        <div class="bg-gray-50 shadow p-6 rounded-lg">
            <div class="md:flex md:justify-between md:items-center">
                <div>
                    <h2 class="text-xl text-gray-800 font-bold leading-tight">Alcaldía</h2>
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
                            style="height:{{ round( ((100/$total)*$candidate->votes), 2) }}px">
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
                                {{round( ((100/$total)*$candidate->votes), 2)}}% </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
<div class="">


        <a href="{{route('panel.vote.report')}}"
            class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase text-xs"
            target="_blank">Generar
            PDF</a>

</div>

<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div
            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                           Candidato
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Votos
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            %
                        </th>
                </thead>

                <tbody class="bg-white">
                    @foreach ($candidates as $candidate)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                <div class="flex items-center">
                                    <div class="relative">
                                        <img class="h-16 w-16 rounded" 
                                            src="{{ asset($candidate->photo) }}" alt="{{ $candidate->name }} {{ $candidate->last_name }}">
                                        <img  class="absolute w-10 h-10 -right-3 -bottom-3 rounded-full"
                                                src="{{ asset($candidate->logo) }}" alt="{{ $candidate->party_name }}">
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$candidate->name}} {{$candidate->last_name}}
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500">
                                            {{$candidate->party_name}}
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <p class="text-center">{{ $candidate->votes }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                <div class="mt-4 lg:mt-0">
                                    <div class="bg-gray-400 w-full h-4 rounded-lg mt-2 overflow-hidden">
                                        <div class="bg-green-400 h-full rounded-lg shadow-md"
                                            style="width: {{round( ((100/$total)*$candidate->votes), 2)}}%"></div>
                                    </div>
                                    <p class="text-gray-600 text-center font-bold">
                                        {{round( ((100/$total)*$candidate->votes), 2)}}%
                                    </p>
                                </div>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection





{{--
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
                            <p class="mb-2 text-gray-600 text-sm">Actas procesadas : {{ (100/$total)*$emitido  }}%</p>
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
                                    style="height:{{ round( ((100/$total)*$candidate->votes), 2) }}px">
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
                                        {{round( ((100/$total)*$candidate->votes), 2)}}% </div>
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
                                        <img src="{{asset($candidate->photo)}}"
                                            alt="{{$candidate->name}} {{$candidate->last_name}}" />
                                    </div>
                                    <img class="absolute w-12 h-12 right-0 bottom-0 rounded-full"
                                        src="{{asset($candidate->logo)}}" alt="{{$candidate->party_name}}">
                                </div>
                                <div class="flex flex-col space-y-4 ml-0 lg:ml-4">
                                    <div class="flex flex-col items-center lg:items-start">
                                        <h2 class="text-xl font-medium">{{$candidate->name}}
                                            {{$candidate->last_name}}</h2>
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
                        <p class="text-center">{{ $candidate->votes }}</p>
                    </td>
                    <td
                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block relative lg:table-cell lg:static lg:border-gray-200 lg:text-left">
                        <div class="mt-4 lg:mt-0">
                            <div class="bg-gray-400 w-full h-4 rounded-lg mt-2 overflow-hidden">
                                <div class="bg-green-400 h-full rounded-lg shadow-md"
                                    style="width: {{round( ((100/$total)*$candidate->votes), 2)}}%"></div>
                            </div>
                            <p class="text-gray-600 text-center font-bold">
                                {{round( ((100/$total)*$candidate->votes), 2)}}%
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

--}}