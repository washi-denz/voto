@extends('layouts.app')

@section('title','Padron Electoral');

@section('content')
<div class="py-0">
    <div>
        <h3 class="text-xl tracking-wide uppercase font-semibold">Editar candidato | {{ $candidate->census->name}}
            {{$candidate->census->last_name}}</h3>
        <hr class="bg-gradient-to-r from-red-300 to-white h-1">
    </div>
    
    <div class="bg-white my-6 grid justify-items-center">

        @include('panel.components.message')

        <div class="bg-white shadow-md rounded w-full lg:w-5/6 h-full pt-6 pb-8 mb-4 my-3">
            <div class="grid sm:grid-cols-3 gap-4 mx-4 pb-4">
                <div class="col-span-3 sm:col-span-1 text-center">
                    <div class=" flex flex-col justify-center items-center">
                        <img src="{{ asset($candidate->census->photo) }}"
                            class="h-40 w-40 object-contain bg-white rounded-full border-gray-500 border-4 mb-2"
                            title="">
                    </div>
                </div>
                <div class="col-span-3 sm:col-span-2 grid grid-cols-4 gap-4">
                    <div class="lg:col-span-2 col-span-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="name">
                            Nombres
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-grey-darker border @error('name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                            id="name" name="name" type="text" placeholder="Nombres"
                            value="{{old('name',$candidate->census->name)}}" disabled>
                    </div>

                    <div class="lg:col-span-2 col-span-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="last_name">
                            Apellidos
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-grey-darker border @error('last_name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                            id="last_name" name="last_name" type="text" placeholder="Apellidos"
                            value="{{old('last_name',$candidate->census->last_name)}}" disabled>
                    </div>

                    <div class="sm:col-span-2 col-span-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="document">
                            Numero Documento
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-grey-darker border @error('document') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                            id="document" name="document" type="text" placeholder="Numero de Documento"
                            value="{{old('document',$candidate->census->document)}}" disabled>
                    </div>                    
                </div>
            </div>

        </div>

        <form action="{{route('panel.candidate.update',$candidate)}}" method="post" class="w-full lg:w-5/6 h-full"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="bg-white shadow-md rounded pt-6 pb-8 mb-4 my-3">
                <div class="grid sm:grid-cols-3 gap-4 mx-4 pb-4">
                    <input type="hidden" name="census_id" value="{{ $candidate->census_id }}">
                    <div class="col-span-3 sm:col-span-1 text-center" x-data="{image:'{{ asset($candidate->logo) }}'}">
                        <div class=" flex flex-col justify-center items-center">
                            <img :src="image"
                                class="h-40 w-40 object-contain bg-white rounded-full border-gray-500 border-4 mb-2"
                                title="Miguel Ángel Rodarte Valdés">
                        </div>
                        <label for="logo" type="button"
                            class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium">
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
                    <div class="col-span-3 sm:col-span-2 grid grid-cols-4 gap-4">
                        <div class="lg:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="party_name">
                                Nombre del partido
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="party_name" name="party_name" type="text" placeholder="Nombres"
                                value="{{ old('party_name',$candidate->party_name) }}" required>
                            @error('party_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mx-4 pb-4">
                    <div class="w-full text-right"> 
                        <a href="{{ route ('panel.candidate.index') }}" class="text-blue-400 cursor-pointer">Cancelar</a>          
                        <button type="submit"
                            class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase">
                            <i class="fa fa-save"></i>
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
