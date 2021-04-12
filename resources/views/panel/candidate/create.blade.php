@extends('layouts.app')

@section('title','Padron Electoral');

@section('content')

<div class="py-0 mb-3">
    <div class="bg-white border-b border-gray-300">
        <h4 class="text-2xl text-gray-600">FORM CREATE CANDIDATE</h4>
    </div>
</div>

<h3 class="text-lg font-medium">1. Para crear un candidato : Ingrese el DNI del candidato</h3>
@if(Session::has('message'))
    <div class="text-blue-400">{{ Session::get('message') }}</div>
@endif
<form action="{{ route('panel.candidate.create.data_census') }}" method="POST">
    @csrf
    DNI:   <input type="text" name="document" value="{{ isset($census->document)? $census->document:'' }}"><br>
            @error('document')
            <small class="text-red-400">{{ $message }}</small><br>
            @enderror
    <button type="submit" class="bg-blue-400 text-white p-2 m-2">Seleccionar candidato</button>
</form>
    
<h3 class="text-lg font-medium">2.Crea candidato </h3>
    @csrf
    Nombre:   <input type="text" name="name" value="{{ isset($census->name)? $census->name:'' }}" class="bg-gray-100" disabled><br>
    Apellidos:<input type="text" name="last_name" value="{{ isset($census->name)? $census->last_name:'' }}" class="bg-gray-100" disabled><br>
    Foto:     mostrar...
    @if(isset($census->photo))
    <img src="{{ asset( $census->photo ) }}" alt="" class="w-36 h-36">
    @endif
    <br>
<form action="{{ route('panel.candidate.store',$census) }}" method="POST" enctype="multipart/form-data">
    @csrf
                        <input type="hidden" name="census_id" value="{{ isset($census->id)? $census->id:0 }}">
                        @error('census_id')
                        <small class="text-red-400">{{ $message }}</small><br>
                        @enderror
    Nombre del partido: <input type="text" name="party_name" value="{{ old('party_name') }}"><br>
                        @error('party_name')
                        <small class="text-red-400">{{ $message }}</small><br>
                        @enderror
    Logo:               <input type="file" name="logo"><br>
                        @error('logo')
                        <small class="text-red-400">{{ $message }}</small><br>
                        @enderror

    <a href="{{ route ('panel.candidate.index') }}" class="text-blue-400 cursor-pointer">Cancelar</a>
    <button type="submit" class="bg-green-400 text-white p-2 m-2">Crear candidato</button>

</form>

@endsection
