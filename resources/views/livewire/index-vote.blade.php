<div>

@if($view == 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-6">

        <div class="px-3 bg-gray-300_">
            <div class="hidden md:block mt-6">
                <img src="{{ asset('images/vote/vote_group.svg') }}" class="w-75 mx-auto">
            </div>
        </div>
        <div class="px-3 text-center md:text-left">

            <input type="hidden" name="school_id" value="">
            <label for="document" class="text-gray-100 text-xs font-light mb-4 block">Para emitir su <strong class="border-b-2 border-yellow-300">voto</strong> : Ingrese su <strong class="border-b-2 border-yellow-300">DNI</strong> y <strong class="border-b-2 border-yellow-300">Código</strong> de votación</label>
            <input type="text" name="document" id="document" wire:model="document" class="focus:outline-none bg-indigo-400 bg-opacity-20 py-4 px-4 mb-6 mx-auto md:mx-0 text-xl text-center md:text-left text-indigo-50 text-opacity-70 placeholder-indigo-200  font-mono block" placeholder="Ingrese su DNI" autocomplete="off" required>        
            @error('document')
            <small class="text-red-400 block">{{ $message }}</small>
            @enderror
        
            <input type="password" name="code" id="code" wire:model="code" class="focus:outline-none bg-indigo-400 bg-opacity-20 py-4 px-4 mb-6 mx-auto md:mx-0 text-xl text-center md:text-left text-indigo-50 text-opacity-70 placeholder-indigo-200  font-mono block" placeholder="Ingrese su código" autocomplete="off" required>
            @error('code')
            <small class="text-red-400 block">{{ $message }}</small>
            @enderror

            @error('slug')
            <small class="text-red-400 block">{{ $message }}</small>
            @enderror

            <button type="button" wire:click="setData" class="focus:outline-none transition duration-500 w-32 py-2 px-2 font-semibold text-gray-200 bg-indigo-900 hover:bg-indigo-800 ring-2 ring-gray-200 m-2">Ingresar</button>

        </div>

    </div>

@else

    <p class="text-center text-gray-50 text-sm pt-3">{{ $census['name'] }} {{ $census['last_name'] }} con DNI : {{ $census['document'] }}</p>

    <h1 class="text-center text-gray-50 text-2xl font-medium mb-3">Seleccione su candidato</h1>
    
    <div class="bg-indigo-400 bg-opacity-30 rounded mx-2 md:mx-3 shadow-lg">
        <div class="flex flex-wrap md:justify-center gap-3 text-center mx-5 py-5 selection">
            
            @foreach($candidates as $obj)
                
                <input type="button" id="candidate_id{{ $obj->id }}" wire:click="selection({{ $obj->id }})" class="hidden">

                <label for="candidate_id{{ $obj->id }}" class="flex items-center md:flex-col gap-2 bg-gray-50 rounded p-2 w-full md:w-40 cursor-pointer transition duration-300 hover:bg-yellow-300 border-4 border-indigo-900 border-opacity-90">
                    <img src="{{ asset($obj->photo) }}" alt="" class="flex-none w-20 h-20 md:w-full md:h-40 rounded">
                    <img src="{{ asset($obj->logo) }}" alt="" class="flex-none w-20 h-20 md:w-full md:h-24 rounded-full md:rounded">
                    <div class="flex-grow text-center">
                        <h3 class="text-indigo-900 font-bold text-sm text-normal sm:text-lg md:text-lg mt-0 md:mt-3 px-2">{{ $obj->party_name }}</h3>
                        <p class="mb-3 text-xs sm:text-sm md:text-sm">{{ $obj->name }} {{ $obj->last_name }}</p>
                    </div>
                </label>

            @endforeach
            
        </div>
    </div>

    <div class="flex justify-center">
        <a  href="{{ url('portal/'.$school) }}" class="focus:outline-none transition duration-500 w-auto py-2 px-4 font-semibold text-gray-200 bg-indigo-900 hover:bg-indigo-800 ring-2 ring-gray-200 m-4 inline-block">Atrás</a>
    </div>


    <x-modal wire:model="open_modal">

        <h3 class="text-gray-50 text-center text-lg font-medium py-3">Confirme su selección</h3>

        <div class="flex justify-center">
            <div class="bg-indigo-400 bg-opacity-30 rounded mx-3 shadow-lg p-4 md:w-1/2">
                <div class="flex gap-2">
                    <img src="{{ asset($candidate['photo']) }}" class="flex-none w-32 h-32 border-2 border-indigo-900 rounded">
                    <img src="{{ asset($candidate['logo']) }}" class="flex-grow w-32 h-32 border-2 border-indigo-900 rounded">
                </div>
                <div class="flex-grow text-center">
                    <h3 class="text-indigo-200 text-xl font-medium mt-3">{{ $candidate['party_name'] }}</h3>
                    <p class="text-indigo-200 text-sm">{{ $candidate['name'] }} {{ $candidate['last_name'] }}</p>
                </div>
            </div>
        </div>

        <div class="flex justify-center my-3">
            <button wire:click="$set('open_modal',false)" class="focus:outline-none transition duration-500 w-auto py-2 px-4 font-semibold text-gray-200 bg-indigo-900 hover:bg-indigo-800 ring-2 ring-gray-200 m-2 cursor-pointer">Cancelar</button>
            <button wire:click="confirm({{ $candidate['id'] }})" class="focus:outline-none transition duration-500 w-32 py-2 px-2 font-semibold text-white bg-green-400 hover:bg-green-600 ring-2 ring-green-500 m-2">Confirmar</button>
        </div>
    
    </x-modal>
@endif

</div>
