<div>

    <p class="text-center text-gray-50 text-sm pt-3">{{ $census['name'] }} {{ $census['last_name'] }} con DNI : {{ $census['document'] }}</p>

    <h1 class="text-center text-gray-50 text-2xl font-medium mb-3">Seleccione su candidato</h1>
      
    <div class="bg-indigo-400 bg-opacity-30 rounded mx-2 md:mx-3 shadow-lg">
        <div class="flex flex-wrap md:justify-center gap-3 text-center mx-5 py-5 selection">

            @foreach($candidates as $candidate)

                @livewire('selection-candidate',['candidate'=>$candidate->id],key($candidate->id))

                <label for="candidate_id{{ $candidate->id }}" wire:click="" class="flex items-center md:flex-col gap-2 bg-gray-50 rounded p-2 w-full md:w-40 cursor-pointer transition duration-300 hover:bg-yellow-300 border-4 border-indigo-900 border-opacity-90">
                    <img src="{{ asset($candidate->photo) }}" alt="" class="flex-none w-20 h-20 md:w-full md:h-40 rounded">
                    <img src="{{ asset($candidate->logo) }}" alt="" class="flex-none w-20 h-20 md:w-full md:h-24 rounded-full md:rounded">
                    <div class="flex-grow text-center">
                        <h3 class="text-indigo-900 font-bold text-sm text-normal sm:text-lg md:text-lg mt-0 md:mt-3 px-2">{{ $candidate->party_name }}</h3>
                        <p class="mb-3 text-xs sm:text-sm md:text-sm">{{ $candidate->name }} {{ $candidate->last_name }}</p>
                    </div>
                </label>

            @endforeach
            
        </div>
    </div>

    <div class="flex justify-center">
        <a  href="" class="focus:outline-none transition duration-500 w-auto py-2 px-4 font-semibold text-gray-200 bg-indigo-800 hover:bg-indigo-800 ring-2 ring-gray-200 m-4 inline-block">Atrás</a>
    </div>

</div>
