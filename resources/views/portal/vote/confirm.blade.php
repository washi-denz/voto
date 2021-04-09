@extends('layouts.guest')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

Confirmar:::{{ $candidate_id}}

<h1 class="text-xl font-bold">Confirme su selección</h1>

<form action="{{ route('portal.vote.selection') }}" method="GET">
    @csrf
    <input type="submit" value="Eligir de nuevo">
</form>

<form action="{{ route('portal.vote.confirm.update',$candidate_id) }}" method="POST">
    @csrf
    <button type="submit" value="CONFIRMAR" x-on:click.prevent="if (confirm('Seguro que desea borrarlo?'))">CONFIRMAR</button>
</form>

@endsection
