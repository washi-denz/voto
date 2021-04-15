@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')
<div class="py-0">

    <div class="absolute top-0 left-0 z-0 -mt-8 w-full bg-gray-100">
        <h4 class="py-4 px-14 sm:ml-64 text-lg font-normal uppercase">
            Crear nuevo candidato
        </h4>
    </div>

    <div class="bg-white my-2 grid justify-items-center">

        @include('panel.components.message')

        <div class="bg-white shadow-lg rounded w-full py-4 px-6 my-6">
            <div class="mb-4">
                <form action="{{ route('panel.candidate.create.data_census') }}" method="POST">
                    @csrf
                    <label class="font-medium block my-3"
                        for="document">
                        Ingrese su DNI
                    </label>
                    <input
                        class="appearance-none block w-auto bg-white-100 text-grey-darker border @error('document') border-red-500 @else border-gray-400 @enderror rounded inline-block py-3 px-4"
                        id="document" name="document" type="text" placeholder="DNI"
                        value="{{ old('document',$census->document) }}" required>
                        @error('document')
                        <small class="text-red-400">{{ $message }}</small><br>
                        @enderror
                    <button type="submit"
                        class="border border-blue-500 bg-blue-500 text-white rounded-md px-4 py-2 m-1 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                        <i class="fa fa-save"></i>
                        Seleccionar candidato
                    </button>
                </form>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div class="">
                    <div class="grid md:grid-cols-2">
                        <div>
                            <input type="hidden" name="census_id" value="{{ isset($census->id)? $census->id:0 }}">
                            <label class="font-medium block my-3"
                                for="logo">
                                Foto 
                            </label>
                            <div class="flex flex-col justify-center items-center">
                                <img src="{{ asset( $census->photo ) }}"
                                    class="h-40 w-40 object-contain bg-white rounded-full border-gray-500 border-4 mb-2"
                                    title="">
                            </div>
                        </div>
                        <div>
                            <div class="lg:col-span-2 col-span-4">
                                <label class="font-medium block my-3"
                                    for="name">
                                    Nombres
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border @error('name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                    id="name" name="name" type="text" placeholder="Nombres"
                                    value="{{ old('name',$census->name) }}" disabled>
                            </div>

                            <div class="lg:col-span-2 col-span-4">
                                <label class="font-medium block my-3"
                                    for="last_name">
                                    Apellidos
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-grey-darker border @error('last_name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                    id="last_name" name="last_name" type="text" placeholder="Apellidos"
                                    value="{{ old('last_name',$census->name) }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <form action="{{ route('panel.candidate.store',$census) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid md:grid-cols-2">
                            <input type="hidden" name="census_id" value="{{ isset($census->id)? $census->id:0 }}">
                            <div class="text-center" x-data="{image:'{{ asset('images/default/logo.png') }}'}">
                                <label class="font-medium block my-3 text-left"
                                    for="name">
                                    Imagen del partido
                                </label>                   
                                <div class="flex flex-col justify-center items-center">
                                    <img :src="image"
                                        class="h-40 w-40 object-contain bg-white rounded border-gray-500 border-4 mb-2"
                                        title="">
                                </div>
                                <label for="logo" type="button"
                                class="cursor-pointer focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium">
                                <i class="fa fa-camera fa-fw"></i>
                                Buscar foto
                                </label>

                                <input name="logo" id="logo" accept="image/*" class="hidden" type="file" @change="let file = document.getElementById('logo').files[0];
                                var reader = new FileReader();
                                reader.onload = (e) => image = e.target.result;
                                reader.readAsDataURL(file);">
                                @error('logo')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="font-medium block my-3"
                                    for="party_name">
                                    Nombre del partido
                                </label>
                                <input
                                    class="appearance-none block w-full bg-white text-grey-darker border @error('party_name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                    id="party_name" name="party_name" type="text" placeholder="Nombre del partido"
                                    value="{{ old('party_name',$census->party_name) }}" required>
                                    @error('party_name')
                                    <small class="text-red-400">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="mx-4 mt-6">    
                            <div class="w-full text-center md:text-right">
                                <a href="{{ route ('panel.candidate.index') }}" class="border border-gray-100 bg-gray-100 text-gray-600 rounded-md px-4 py-2 m-1 transition duration-500 ease select-none hover:bg-gray-600 hover:text-gray-50 focus:outline-none focus:shadow-outline uppercase">Cancelar</a>
                                <button type="submit"
                                    class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase">
                                    <i class="fa fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
                        
        </div>

    </div>
</div>




















{{--
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
--}}
@endsection
