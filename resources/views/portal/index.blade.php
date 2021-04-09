@extends('layouts.guest')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

<h1>Voto Electrónico Elección Municipio Escolar 2021</h1>

<form action="{{ route('vote.store') }}" method="POST">
    @csrf
    <label for="code">Para emitir su voto ingrese su clave:</label><br>
    <input type="text" name="code" id="code" value="@if(Session::has('code')) {{ Session::get('code') }} @endif"><br>
    @if(Session::has('message'))
    <p style="background:yellow;color:green; border:1px dotted green;">{{ Session::get('message') }}</p>
    @endif
    <input type="submit" value="ENVIAR">
</form>

@endsection
