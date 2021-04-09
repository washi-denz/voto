@extends('layouts.guest')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

<h1>Voto Electrónico Elección Municipio Escolar 2021</h1>

<form action="{{ route('portal.vote.selection') }}" method="POST">
    @csrf
    <label for="dni">Ingrese su DNI:</label><br>
    <input type="text" name="dni" id="dni" value="@if(Session::has('dni')) {{ Session::get('dni') }} @endif"><br>
    @if(Session::has('message'))
    <p style="background:yellow;color:green; border:1px dotted green;">{{ Session::get('message') }}</p>
    @endif
    <input type="submit" value="ENVIAR">
</form>

@endsection
