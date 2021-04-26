<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Census;
use App\Models\User;

class SelectionVote extends Component
{
    public $school_id = 1;//config

    protected $listeners = ['selection'];

    public $census;

    public function selection(Census $census){
        $this->census = $census;
    }

    public function render()
    {        
        $candidates = User::select('candidates.logo','candidates.id','candidates.party_name','censuses.photo','censuses.name','censuses.last_name')
                                ->join('candidates','users.id','=','candidates.users_id')
                                ->join('censuses','censuses.id','=','candidates.census_id')
                            ->where('users.school_id','=',$this->school_id)
                            ->get();

       // $census = Census::where('id',45)->get();
        //$census = $census[0];

        return view('livewire.selection-vote',['candidates'=>$candidates,'census'=>$this->census]);

    }
}
