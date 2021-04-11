@extends('portal.layouts.app')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

@include('portal.parts.header')

<div class="container mx-auto lg:px-40 md:px-8 sm:px-16">
        
        <p class="text-center text-gray-50 text-sm pt-3">{{ $candidate_id}} Washi LM con DNI : 12345678</p>
        <h1 class="text-center text-gray-50 text-2xl font-medium mb-3">Confirme su selección</h1>
        
        <div class="flex justify-center">
            <div class="bg-indigo-400 bg-opacity-30 rounded mx-3 shadow-lg p-4 md:w-1/2">
                <div class="flex gap-2">
                    <img src="{{ asset('images/selection/candidate_1.png') }}" class="flex-none w-32 h-32 border-2 border-indigo-900 rounded">
                    <img src="{{ asset('images/selection/party_1.png') }}" class="flex-grow w-32 h-32 border-2 border-indigo-900 rounded">
                </div>
                <div class="flex-grow text-center">
                    <h3 class="text-indigo-200 text-xl font-medium mt-3">Jovenes en acción</h3>
                    <p class="text-indigo-300 text-sm">jhosbet G.C.L</p>
                </div>
            </div>
        </div>
            
        <div class="flex justify-center mt-3">
            <a  href="" class="focus:outline-none transition duration-500 w-20 py-2 px-2 font-semibold text-gray-200 bg-indigo-900 hover:bg-indigo-800 ring-2 ring-gray-200 m-2">Atrás</a>
            <form action="{{ route('portal.vote.confirm.update',$candidate_id) }}" method="POST">
                @csrf
                <button  class="focus:outline-none transition duration-500 w-32 py-2 px-2 font-semibold text-white bg-green-400 hover:bg-green-500 ring-2 ring-green-500 m-2">Confirmar</button>
            </form>
        </div>
        
    </div>
<!--
<div class="container mx-auto lg:px-40 md:px-8 sm:px-16">

    Confirmar:::{{ $candidate_id}}

    <h1 class="text-xl font-bold">Confirme su selección</h1>

    <form action="{{ route('portal.vote.selection') }}" method="GET">
        @csrf
        <input type="submit" value="Eligir de nuevo">
    </form>

    <form action="{{ route('portal.vote.confirm.update',$candidate_id) }}" method="POST">
        @csrf
        <button type="submit" value="CONFIRMAR" x-on:click.prevent="if (confirm('Seguro que desea borrarlo?'))">CONFIRMAR</button>
    </form>
</div>
-->
@endsection