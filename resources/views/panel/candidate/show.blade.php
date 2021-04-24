@extends('layouts.app')

@section('title','Padron Electoral')

@section('content')
    @livewire('show-candidate',['title'=>'Lista de candidatos'])
@endsection
