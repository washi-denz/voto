<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\School;
use App\Models\Census;
use App\Models\User;

class IndexVote extends Component
{
    public $school;
    public $view = 0;//config
    public $document='48996878',$code='EC83';

    protected $rules = [
        'document' => 'required|max:8',
        'code'     => 'required|Max:4'
    ];

    public $school_id = 1;//config

    //protected $listeners = ['selection'=>'showSelection'];

    //selection
    public $data;
 
    public function setData(){

        //validadmos
        $this->validate();

        //comprueba
        $census = Census::where('code','=',$this->code)->where('document','=',$this->document)->first();

        if ($census) {

            $candidates = User::select('*')->join('candidates','users.id','=','candidates.users_id')->where('users.school_id','=',$this->school_id)->count();

            if($candidates > 1){

                if ($census->condition == false) {

                    $users  = User::Where('id','=',$census->users_id)->where('school_id','=',$this->school_id)->first();

                    if($users){

                        //creando sesión tmp      
                        //$request->session()->put('census_id',$census->id);//para crear el hash
                        //$request->session()->put('school_id',$request->school_id);//
                        //Cambio de vista
                        $this->view=1;
                        //$this->emitTo('selection-vote','render');

                        $this->emit('selection',$census->id);
                        $this->emit('alert','¿ Elige su candidato ?');
            
                        //return redirect()->route('portal.vote.show',$census);

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
    
    public function render()
    {   
        $school = School::all();
        return view('livewire.index-vote',['school'=>$school])->layout('layouts.main');
    }
}
