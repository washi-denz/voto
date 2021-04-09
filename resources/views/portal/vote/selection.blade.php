@extends('layouts.guest')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

<strong>Hola</strong> Washi con DNI:44667405
<h1>Seleccione su candidato:</h1>

<form action="POST">

    @foreach($candidates as $key => $candidate)
    {{$key+1}} {{ $candidate->party_name }}<br>
    @endforeach

</form>

@endsection
