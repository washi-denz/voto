@extends('layouts.app')

@section('title','Padron Electoral');

@section('content')
<div class="py-0 mb-3">
    <div class="bg-white border-b border-gray-300">
        <h4 class="text-2xl text-gray-600">FORM CREATE CANDIDATE</h4>
    </div>
</div>

<form action="" method="POST">
    Nombre:   <input type="text" name="name"><br>
    Apellidos:<input type="text" name="last_name"><br>
    DNI:      <input type="text" name="dni"><br>
    Foto:     <input type="file" name="photo"><br>

    Logo del partido:   <input type="file" name="logo"><br>
    Nombre del partido: <input type="text" name="party_name"><br>

    <a href="{{ route ('panel.candidate.index') }}" class="text-blue-400 cursor-pointer">Cancelar</a>
    <button type class="bg-green-400 p-2">GUARDAR</button>
</form>
@endsection
