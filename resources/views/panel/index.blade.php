@extends('layouts.app')

@section('title','Padron de Electores')

@section('content')

<section class="bg-gray-50 w-full h-1/2 relative">
    
    <div class="w-full h-80 bg-no-repeat bg-right bg-cover sm:bg-auto opacity-20 sm:opacity-100" style="background-image:url('images/vote/vote.svg');"></div>
    
    <div class="container mx-auto lg:px-20 md:px-8 sm:px-16"> 
    
       <div class="absolute top-1/3 transform -translate-y-1/3 pl-3">
            <h1 class="mb-4 font-thin text-green-500 font-mono text-4xl sm:text-6xl tracking-widest inline">Hola</h1><span class="text-lg text-green-500">,</span>
            <h2 class="mb-4 font-extrabold text-green-700 text-xl sm:text-3xl tracking-tight">Administrador</h2>
            <p class="mb-4">Bienvenido</p>
        </div>
        <div class="absolute w-full sm:w-auto bottom-0 sm:bottom-10  text-xs sm:text-sm">
            <div class="flex justify-between sm:justify-start p-2">
                <div class="">
                    <strong class="text-coolGray-600">Email</strong>
                    <p class="font-mono text-coolGray-500">cuenta@gmail.com</p>
                </div>
                <div class="sm:pl-8">
                    <strong class="text-coolGray-600">Teléfono</strong>
                    <p class="font-mono text-coolGray-500">(+51)123 123 123</p>
                </div>
                <div class="sm:pl-8">
                    <strong class="text-coolGray-600">Ubicaión</strong>
                    <p class="font-mono text-coolGray-500">Puno,Perú</p>
                </div>
            </div>
        </div>
        
    </div><!--/container-->

</section><!--/section-->

@endsection
