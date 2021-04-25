<div>
    <button class="bg-green-400 p-2 mb-3 inline" wire:click="$set('open',true)">Crear candidato<button>

    <x-modal wire:model="open">
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

        <div class="float-right m-2">
            <input type="button" class=" bg-gray-200 p-2 rounded cursor-pointer" value="CANCELAR" wire:click="$set('open',false)">
            <input type="button" class=" bg-green-400 p-2 rounded cursor-pointer" value="GUARDAR" wire:click="save" wire.loading.attr="disabled" wire:target="save" class="disabled:bg-opacity-25">
            {{-- span de carga--}}
            {{--<span wire:loading wire:target="save" >Cargando...</span>--}}
        </div>
    </x-modal>
</div>
