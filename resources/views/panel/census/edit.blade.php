@extends('layouts.app')

@section('title','Padron Electoral');

@section('content')
<div class="py-0">
    <div>
        <h3 class="text-xl tracking-wide uppercase font-semibold">Edicion de Elector | {{ $census->name}}
            {{$census->last_name}}</h3>
        <hr class="bg-gradient-to-r from-red-300 to-white h-1">
    </div>
    <div class="bg-white my-6 grid justify-items-center">
        @include('panel.components.message')
        <form action="{{route('panel.census.update',$census)}}" method="post" class="w-full lg:w-5/6 h-full"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="bg-white shadow-md rounded pt-6 pb-8 mb-4 my-3">
                <div class="grid sm:grid-cols-3 gap-4 mx-4 pb-4">
                    <div class="col-span-3 sm:col-span-1 text-center" x-data="{image:'{{asset($census->photo)}}'}">
                        <div class=" flex flex-col justify-center items-center">
                            <img :src="image"
                                class="h-40 w-40 object-contain bg-white rounded-full border-gray-500 border-4 mb-2"
                                title="Miguel Ángel Rodarte Valdés">
                        </div>
                        <label for="photo" type="button"
                            class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium">
                            <i class="fa fa-camera fa-fw"></i>
                            Buscar foto
                        </label>

                        <input name="photo" id="photo" accept="image/*" class="hidden" type="file" @change="let file = document.getElementById('photo').files[0];
                        var reader = new FileReader();
                        reader.onload = (e) => image = e.target.result;
                        reader.readAsDataURL(file);">
                        @error('photo')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-2 grid grid-cols-4 gap-4">
                        <div class="lg:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="name">
                                Nombres
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="name" name="name" type="text" placeholder="Nombres"
                                value="{{old('name',$census->name)}}" required>
                            @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="lg:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="last_name">
                                Apellidos
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('last_name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="last_name" name="last_name" type="text" placeholder="Apellidos"
                                value="{{old('last_name',$census->last_name)}}" required>
                            @error('last_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="grade">
                                Grado
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('grade') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
                                id="grade" name="grade" required>
                                <option value="1ro" @if (old('grade',$census->grade)=='1ro' ) selected @endif>1ro
                                </option>
                                <option value="2do" @if (old('grade',$census->grade)=='2do' ) selected @endif>2do
                                </option>
                                <option value="3ro" @if (old('grade',$census->grade)=='3ro' ) selected @endif>3ro
                                </option>
                                <option value="4to" @if (old('grade',$census->grade)=='4to' ) selected @endif>4to
                                </option>
                                <option value="5to" @if (old('grade',$census->grade)=='5to' ) selected @endif>5to
                                </option>
                                <option value="6to" @if (old('grade',$census->grade)=='6to' ) selected @endif>6to
                                </option>
                            </select>
                            @error('grade')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="document">
                                Numero Documento
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('document') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="document" name="document" type="text" placeholder="Numero de Documento"
                                value="{{old('document',$census->document)}}" required>
                            @error('document')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        {{--<div class="sm:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="group">
                                Grupo
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('birthday') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
                                id="group" name="group" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </select>
                        </div>--}}
                    </div>
                </div>

                <div class="mx-4 pb-4">
                    <div class="w-full text-right">
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
