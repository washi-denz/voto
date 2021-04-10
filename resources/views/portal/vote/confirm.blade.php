@extends('portal.layouts.app')

@section('title')
Voto Electrónico Elección Municipio Escolar 2021
@endsection

@section('content')

@include('portal.parts.header')

<div class="container mx-auto lg:px-40 md:px-8 sm:px-16">
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
</div>

@endsection