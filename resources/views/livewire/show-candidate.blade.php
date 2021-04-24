<div>
    {{-- $search --}}
    <div class="mb-3">
        <input type="text" wire:model="search">
    </div>
    <i class="fad home"></i>
    <table class="w-full">
        <thead>
            <tr class="bg-indigo-500 text-white">
                <th class="cursor-pointer" wire:click="order('id')">
                ID
                {{-- Sort --}}
                @if($sort == 'id')
                    @if($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                    @else
                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                    @endif
                @else
                    <i class="fas fa-sort float-right"></i>
                @endif

                </th>
                <th class="cursor-pointer">Logo</th>
                <th class="cursor-pointer" wire:click="order('party_name')">
                Nombre del partido
                {{-- Sort --}}
                @if($sort == 'party_name')
                    @if($direction == 'asc')
                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                    @else
                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                    @endif
                @else
                    <i class="fas fa-sort float-right"></i>
                @endif
                </th>
                <th class="cursor-pointer">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($candidates as $candidate)
        <tr>
            <td class="border p-2">{{ $candidate->id }}</td>
            <td class="border p-2">
                <img src="{{ asset($candidate->logo) }}" class="w-16"> 
            </td>
            <td class="border p-2">{{ $candidate->party_name }}</td>
            <td class="border p-2"></td>
        <tr>
        @endforeach
        </tbody>
    </table>

    <div class="py-5">
        {{-- $candidates->onEachSide(0)->links() --}}
    </div>

</div>
