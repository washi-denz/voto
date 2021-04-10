@extends('portal.layouts.app')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

@include('portal.parts.header')

<div class="container mx-auto lg:px-40 md:px-8 sm:px-16">
    
    <div class="flex justify-center items-center text-center pt-16">
        <form action="{{ route('portal.vote.selection') }}" method="POST">        
            @csrf
            <label for="dni" class="text-gray-100 text-xs font-light mb-4 block">Ingrese su número de <strong class="border-b-2 border-yellow-300">DNI</strong></label>
            <input type="text" name="dni" id="dni" value="@if(Session::has('dni')) {{ Session::get('dni') }} @endif" class="focus:outline-none bg-indigo-400 bg-opacity-20 py-4 px-4 mb-6 text-xl text-center text-indigo-50 text-opacity-70 placeholder-indigo-200 font-mono" placeholder="Número de DNI" autocomplete="off"><br>
            @if(Session::has('message'))
            <p style="background:yellow;color:green; border:1px dotted green;">{{ Session::get('message') }}</p>
            @endif
            <button  class="focus:outline-none transition duration-500 w-32 py-2 px-2 font-semibold text-gray-200 bg-indigo-900 hover:bg-indigo-800 ring-2 ring-gray-200 m-2">Ingresar</button>
        </form>
    </div>
    
</div>

@endsection
