<!--header-->
<div class="w-full">
    <div class="container mx-auto lg:px-40 md:px-8 sm:px-16" >
        
        <div class="grid grid-cols-1 gap-4 border-b border-{{ Session::get('color') }}-200 border-opacity-20 py-6 mx-3">
            <div class="flex">
                <img src="{{ asset( Session::get('logo') ) }}" alt="" class="w-14 h-14 md:w-20 md:h-20">
                <div class="px-3">
                    <h1 class="text-gray-50 text-xl md:text-4xl font-medium uppercase">Voto electrónico</h1>
                    <p class="text-{{ Session::get('color') }}-200 text-opacity-70 text-sm md:text-lg font-medium">Elección Municipio Escolar 2021</p>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--/header-->