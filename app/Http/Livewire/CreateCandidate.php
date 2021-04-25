<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class CreateCandidate extends Component
{
    public $open = false;
    public $logo,$party_name,$census_id;

    protected $rules =[
        'logo'       => 'required|Max:10',
        'party_name' => 'required|Min:5',
        'census_id'  => 'required|max:2'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function save(){

        $this->validate();

        Candidate::create([
            'logo'       => $this->logo,
            'party_name' => $this->party_name,
            'census_id'  => $this->census_id,
            'users_id'   => Auth::user()->id,
        ]);
        
        //resetear todo los valores,incluimos open para cerrar el modal
        $this->reset(['open','logo','party_name','census_id']);

        //emitir
        //$this->emit('render');//Aquí todos los compenetes escuchan este emit solo show-candidate lo escuche hacemos esto
        $this->emitTo('show-candidate','render');
        $this->emit('alert','El candidato se agregó satisfactoriamente.');
    }

    public function render()
    {
        return view('livewire.create-candidate');
    }
}
