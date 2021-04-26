<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\School;
use App\Models\Census;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Hash;

class IndexVote extends Component
{
    public $school;
    public $view = 0;//vista
    public $open_modal = false;//modal
    public $document ='71978836',$code='5B67';

    public $listeners = ['confirm'];

    protected $rules = [
        'document' => 'required|max:8',
        'code'     => 'required|Max:4'
    ];

    public $school_id;

    public $census;
    public $candidates;
    public $candidate;

    //protected $listeners = ['selection'=>'showSelection'];
    
    public $data;

    public function mount($school){

        $school = School::where('slug','=',$school)->first();

        if($school){

            $this->school_id = $school->id;

        }else{
            redirect()->to('/');
        }
    }
 
    public function setData(){

        //validamos
        $this->validate();

        //comprueba existencia de code y document
        $census = Census::where('code','=',$this->code)->where('document','=',$this->document)->first();

        if ($census) {

           $candidates = Candidate::select('*')->join('users','candidates.users_id','=','users.id')->where('users.school_id','=',$this->school_id)->get();

            if(count($candidates) > 1){

                if ($census->condition == false) {

                    $users  = User::Where('id','=',$census->users_id)->where('school_id','=',$this->school_id)->first();

                    if($users){

                        //Cambio de vista
                        $this->view=1;
                        $this->census = $census;

                        $this->emit('alert','¿ Elige su candidato ?');

                    }else{
                        $this->emit('alert','El DNI o Código no pertenece a esta IE. Elija su IE correcta o contacte con la Comisión Electoral.');  
                    }
                }else{
                    $this->emit('alert','Atención!!! Ud ya sufragó, si hay error contacte con la Comisión Electoral.');
                }
            }else{
                $this->emit('alert','Aún no existe mínimo de candidatos.Consulte con la Comisión Electoral.');
            }           
        }else{
            $this->emit('alert','El DNI o Código es INVÁLIDA, si persiste el problema contacte con la Comisión Electoral.');
        }

    }

    function selection(Candidate $candidate){
        $this->candidate  = $candidate;
        $this->open_modal = true;
    }

    public function confirm(Candidate $candidate,$document){

        $census = Census::where('document','=',$document)->first();
            
        $hash = Hash::make($document);//hash dni

        $data = [
            'candidate_id' => $candidate['id'],
            'hash'         => $hash
        ];
        
        $success = Vote::create($data);

        if($success){

            // Actualizar
            Census::where('id','=',$census->id)->update(['condition'=>1]);

            // reset
            $this->reset(['document','code']);

            //modal
            $this->open_modal=false;

            //Cambio de vista
            $this->view = 0;

            $this->emit('alert','TERMINÓ.....');
        }else{
            redirect()->to('/portal/'.$this->school);
        }
    }
    
    public function render()
    {   
        //candidates
        $candidates = Candidate::select('candidates.logo','candidates.id','candidates.census_id','candidates.party_name','censuses.photo','censuses.name','censuses.last_name')
        ->join('users','candidates.users_id','=','users.id')
        ->join('censuses','censuses.id','=','candidates.census_id')
        ->where('users.school_id','=',$this->school_id)
        ->get();

        $this->candidates= $candidates;

        return view('livewire.index-vote',['candidates'=>$this->candidates])->layout('layouts.main');        
    }
}