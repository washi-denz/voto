@extends('portal.layouts.app')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

<div class="container mx-auto lg:px-40 md:px-8 sm:px-16 pt-0 md:pt-32">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-6">
        <div class="px-3">
            <!--tilte big-->
                <div class="flex border-b border-{{ Session::get('color') }}-200 border-opacity-20 md:border-none py-6 mx-3">
                    <img src="{{ asset($school->logo) }}" alt="" class="w-14 h-14 md:w-20 md:h-20">
                    <div class="px-3">
                        <h1 class="text-gray-50 text-xl md:text-4xl font-medium uppercase">Voto virtual</h1>
                        <p class="text-{{ Session::get('color') }}-200 text-opacity-70 text-xs sm:text-md md:text-lg font-medium">Elecciones de la Directiva del Municipio Escolar - I.E.S. CHACANEQUE 2021 </p>
                    </div>
                </div>
            <!--/title big-->
        </div>
        <div class="px-3 text-center md:text-left">
            <form action="{{ route('portal.vote.store') }}" method="POST">
                @csrf
                <input type="hidden" name="school_id" value="{{ $school->id }}">
                <label for="document" class="text-gray-100 text-xs font-light mb-4 block">Para emitir su <strong class="border-b-2 border-yellow-300">voto</strong> : Ingrese su <strong class="border-b-2 border-yellow-300">DNI</strong> y <strong class="border-b-2 border-yellow-300">Código</strong> de votación</label>
                <input type="text" name="document" id="document" value="{{ old('document') }}" class="focus:outline-none bg-{{ Session::get('color') }}-400 bg-opacity-20 py-4 px-4 mb-6 mx-auto md:mx-0 text-xl text-center md:text-left text-{{ Session::get('color') }}-50 text-opacity-70 placeholder-{{ Session::get('color') }}-200  font-mono block" placeholder="Ingrese su DNI" autocomplete="off" required>        
                @error('document')
                <small class="text-red-400 block">{{ $message }}</small>
                @enderror
            
                <input type="password" name="code" id="code" value="{{ old('code') }}" class="focus:outline-none bg-{{ Session::get('color') }}-400 bg-opacity-20 py-4 px-4 mb-6 mx-auto md:mx-0 text-xl text-center md:text-left text-{{ Session::get('color') }}-50 text-opacity-70 placeholder-{{ Session::get('color') }}-200  font-mono block" placeholder="Ingrese su código" autocomplete="off" required>
                @error('code')
                <small class="text-red-400 block">{{ $message }}</small>
                @enderror

                @error('slug')
                <small class="text-red-400 block">{{ $message }}</small>
                @enderror

                @if(Session::has('message'))

                    @if(Session::get('type') == 'success')
                        @include('portal.components.alert.success',['message'=>Session::get('message')])
                    @endif

                    @if(Session::get('type') == 'danger')
                        @include('portal.components.alert.danger',['message'=>Session::get('message')])
                    @endif

                    @if(Session::get('type') == 'warning')
                        @include('portal.components.alert.warning',['message'=>Session::get('message')])
                    @endif
                    
                @endif

                <button type="submit" class="focus:outline-none transition duration-500 w-32 py-2 px-2 font-semibold text-gray-200 {{ Session::get('bg') }} hover:bg-{{ Session::get('color') }}-800 ring-2 ring-gray-200 m-2">Ingresar</button>
            </form>
        </div>
    </div>
 
@endsection
