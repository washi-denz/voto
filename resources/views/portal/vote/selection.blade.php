@extends('layouts.guest')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

<!--<strong>Hola</strong> Washi con DNI:44667405-->
<h1 class="text-xl font-bold">Seleccione su candidato:</h1>

<form action="{{ route('portal.vote.confirm') }}" action="POST">
    @csrf
    @foreach($candidates as $key => $candidate)
    {{ $key+1 }} <input type="radio" name="candidate_id" value="{{ $candidate->id }}" id="candidate_id{{ $key+1 }}"><label for="candidate_id{{ $key+1 }}">{{ $candidate->party_name }}</label><br>
    @endforeach
    <input type="submit" value="ENVIAR">
</form>

@endsection
