<div>
    <input type="button" id="candidate_id{{ $candidate->id }}" wire:click="$set('open',true)" class="hidden">

    <x-modal wire:model="open">

    <div class="flex justify-center">
        <div class="bg-{{ Session::get('color') }}-400 bg-opacity-30 rounded mx-3 shadow-lg p-4 md:w-1/2">
            <div class="flex gap-2">
                <img src="{{ asset($candidate->photo) }}" class="flex-none w-32 h-32 border-2 border-{{ Session::get('color') }}-900 rounded">
                <img src="{{ asset($candidate->logo) }}" class="flex-grow w-32 h-32 border-2 border-{{ Session::get('color') }}-900 rounded">
            </div>
            <div class="flex-grow text-center">
                <h3 class="text-{{ Session::get('color') }}-200 text-xl font-medium mt-3">{{ $candidate->party_name}}</h3>
                <p class="text-{{ Session::get('color') }}-200 text-sm">{{ $candidate->name }} {{ $candidate->last_name }}</p>
            </div>
        </div>
    </div>
    {{--
        Logo:<input type="text" wire:model="logo"/><br>
        @error('logo')
            <span class="text-red-400 text-xs block">{{ $message }}</span>
        @enderror
        Nombre del partido:<input type="text" wire:model="party_name"><br>
        @error('party_name')
            <span class="text-red-400 text-xs block">{{ $message }}</span>
        @enderror
        Padron_id:<input type="text" wire:model="census_id" /><br>
        @error('census_id')
            <span class="text-red-400 text-xs block">{{ $message }}</span>
        @enderror
    --}}
        <div class="float-right m-2">
            <input type="button" class=" bg-gray-200 p-2 rounded cursor-pointer" value="CANCELAR" wire:click="$set('open',false)">
            <input type="button" class=" bg-green-400 p-2 rounded cursor-pointer" value="GUARDAR" wire:click="save" wire.loading.attr="disabled" wire:target="save" class="disabled:bg-opacity-25">
            {{-- span de carga--}}
            {{--<span wire:loading wire:target="save" >Cargando...</span>--}}
        </div>
    </x-modal>

</div>
