<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Candidate;

class SelectionCandidate extends Component
{
    public $candidate;
    public $open = false;

    public function mount(Candidate $candidate){
        $this->candidate = $candidate;
    }

    public function render()
    {
        return view('livewire.selection-candidate');
    }
}
