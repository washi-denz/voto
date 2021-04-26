<div>
    @if($view == 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-6">

        <div class="px-3">
            <!--tilte big-->
            IMG
            <!--/title big-->
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

            <button type="button" wire:click="setData" class="focus:outline-none transition duration-500 w-32 py-2 px-2 font-semibold text-gray-200 {{ Session::get('bg') }} hover:bg-indigo-800 ring-2 ring-gray-200 m-2">Ingresar</button>

        </div>

    </div>
    @else
        @livewire('selection-vote')
    @endif
        

</div>
