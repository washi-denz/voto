<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Candidate;

class ShowCandidate extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    public function render()
    {
        $candidates = Candidate::where('party_name','LIKE','%'.$this->search.'%')
                                    ->orderBy($this->sort,$this->direction)
                                    ->get();

        return view('livewire.show-candidate',['candidates'=>$candidates])
                ->layout('layouts.base');
    }

    public function order($column_name=''){
        $this->sort = $column_name;
    }
}
