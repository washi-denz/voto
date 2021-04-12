@extends('layouts.app')

@section('title','Padron Electoral');

@section('content')
<div class="py-0">
    <div class="bg-white border-b border-gray-300">
        <h4 class="text-2xl text-gray-600">FORM CREATE CANDIDATE</h4>
    </div>
    <div class="bg-white my-6">
        <a href="{{ route ('panel.candidate.index') }}" class="text-blue-400 cursor-pointer">Cancelar</a>
    </div>
</div>
@endsection
