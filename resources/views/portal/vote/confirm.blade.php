@extends('portal.layouts.app')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

@include('portal.parts.header')

<div class="container mx-auto lg:px-40 md:px-8 sm:px-16">
        
    <p class="text-center text-gray-50 text-sm pt-3">{{ $census->name }} {{ $census->last_name }} con DNI : {{ $census->document }}</p>

    <h1 class="text-center text-gray-50 text-2xl font-medium mb-3">Confirme su selección</h1>
    
    <div class="flex justify-center">
        <div class="bg-{{ Session::get('color') }}-400 bg-opacity-30 rounded mx-3 shadow-lg p-4 md:w-1/2">
            <div class="flex gap-2">
                <img src="{{ asset($candidate->photo) }}" class="flex-none w-32 h-32 border-2 border-{{ Session::get('color') }}-900 rounded">
                <img src="{{ asset($candidate->logo) }}" class="flex-grow w-32 h-32 border-2 border-{{ Session::get('color') }}-900 rounded">
            </div>
            <div class="flex-grow text-center">
                <h3 class="text-{{ Session::get('color') }}-200 text-xl font-medium mt-3">{{ $candidate->party_name}}</h3>
                <p class="text-{{ Session::get('color') }}-200 text-sm">{{ $candidate->name }} {{ $candidate->last_name }}</p>
            </div>
        </div>
    </div>
        
    <div class="flex justify-center mt-3">
        <a  href="{{ route('portal.vote.show',$census->id) }}" class="focus:outline-none transition duration-500 w-auto py-2 px-4 font-semibold text-gray-200 {{ Session::get('bg') }} hover:bg-{{ Session::get('color') }}-800 ring-2 ring-gray-200 m-2">Atrás</a>
        <form action="{{ route('portal.update.confirm',$candidate->id) }}" method="POST">
            @csrf
            <button  class="focus:outline-none transition duration-500 w-32 py-2 px-2 font-semibold text-white bg-green-400 hover:bg-green-600 ring-2 ring-green-500 m-2">Confirmar</button>
        </form>        
    </div>
    
</div>
@endsection