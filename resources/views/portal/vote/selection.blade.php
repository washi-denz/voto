@extends('portal.layouts.app')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

@include('portal.parts.header')

<div class="container mx-auto lg:px-40 md:px-8 sm:px-16">
        
        <p class="text-center text-gray-50 text-sm pt-3">{{ $census->name }} {{ $census->last_name }} con DNI : {{ $census->document }}</p>

        <h1 class="text-center text-gray-50 text-2xl font-medium mb-3">Seleccione su candidato</h1>
        
        <form action="{{ route('portal.show.confirm',$census->id) }}" action="POST">
            @csrf
            <div class="bg-{{ Session::get('color') }}-400 bg-opacity-30 rounded mx-2 md:mx-3 shadow-lg">
                <div class="flex flex-wrap md:justify-center gap-3 text-center mx-5 py-5 selection">

                    @foreach($candidates as $candidate)
                        <input type="hidden" name="census_id" value="{{ $census->id }}">
                        <input type="submit" id="candidate_id{{ $candidate->id }}" name="candidate_id" value="{{ $candidate->id }}">
                        <label for="candidate_id{{ $candidate->id }}" class="flex items-center md:flex-col gap-2 bg-gray-50 rounded p-2 w-full md:w-40 cursor-pointer transition duration-300 hover:bg-yellow-300 border-4 border-{{ Session::get('color') }}-900 border-opacity-90">
                            <img src="{{ asset($candidate->photo) }}" alt="" class="flex-none w-20 h-20 md:w-full md:h-40 rounded">
                            <img src="{{ asset($candidate->logo) }}" alt="" class="flex-none w-20 h-20 md:w-full md:h-24 rounded-full md:rounded">
                            <div class="flex-grow text-center">
                                <h3 class="text-indigo-900 font-bold text-sm text-normal sm:text-lg md:text-lg mt-0 md:mt-3 px-2">{{ $candidate->party_name }}</h3>
                                <p class="mb-3 text-xs sm:text-sm md:text-sm">{{ $candidate->name }} {{ $candidate->last_name }}</p>
                            </div>
                        </label>
                    @endforeach
                    
                </div>
            </div>
        </form>

        <div class="flex justify-center">
            <a  href="" class="focus:outline-none transition duration-500 w-auto py-2 px-4 font-semibold text-gray-200 {{ Session::get('bg') }} hover:bg-{{ Session::get('color') }}-800 ring-2 ring-gray-200 m-4 inline-block">Atrás</a>
        </div>
        
    </div>

@endsection
