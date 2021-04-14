<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Census;
use App\Models\Candidate;
use App\Models\Vote;


class VoteController extends Controller
{    
    function __construct(){
        //   
    }

    public function index(){
        return view('portal.vote.index');
    }

    public function store(Request $request){

        $code     = $request->get('code');
        $users_id = 5; // Usuario creador del voto electrónico (config)

        $census    = Census::where('code','=',$code)->where('users_id','=',$users_id)->get();
        $condition = Census::where('code','=',$code)->where('condition','<>',true)->get();
        
        if(count($census) > 0){
            if(count($condition)>0){
                // Creamos sesión tmp de code y users_id
                $request->session()->put('code',$code); 
                $request->session()->put('users_id',$users_id);

                return redirect()->route('portal.vote.document'); 
            }
            return redirect()->back()->with(["message"=>"Atención!!! Ud ya sufragó, si hay error contacte con la Comisión Electoral.","code"=>$code,])
                                     ->with("type","warning");
        }
        return redirect()->back()->with(["message"=>"Su clave es INVÁLIDA, si persiste el problema contacte con la Comisión Electoral.","code"=>$code])
                                 ->with("type","danger");
    
    }

    public function document(Request $request){
        // Verificamos sesión tmp de code y users_id 
        if($request->session()->has('code') && $request->session()->has('users_id')){
            return view('portal.vote.dni');
        }
        return redirect()->route('portal.vote.index');
    }
    
    public function selection(Request $request){

        // Verificamos sesión tmp de code y users_id 
        if($request->session()->has('code') && $request->session()->has('users_id')){

            $dni        = $request->get('dni');
            $census_dni = Census::where('document','=',$dni)->where('code','=',$request->session()->get('code'))->get();
            
            if(count($census_dni) > 0){
                
                $users_id = $request->session()->get('users_id');

                $datos['candidates'] = Candidate::select('candidates.logo','candidates.id','candidates.party_name','censuses.photo','censuses.name')
                                                    ->join('censuses','candidates.census_id','=','censuses.id')
                                                    ->where('candidates.users_id','=',$users_id)
                                                    ->get();
                return view('portal.vote.selection',$datos);
            }
            return redirect()->route('portal.vote.document')->with(["message"=>"Su DNI es incorrecto,intentalo de nuevo.","dni"=>$dni])
                                                            ->with("type","danger");
        }
        return redirect()->route('portal.vote.index');
    
    }

    public function confirm(Request $request){
        
        // Verificamos sesión tmp de code y users_id 
        if($request->session()->has('code') && $request->session()->has('users_id')){

            $candidate_id = $request->get('candidate_id');
            // Verificar valor candidate_id
            if(!empty($candidate_id)){
                return view('portal.vote.confirm',['candidate_id'=>$candidate_id]);
            }
            return redirect()->route('portal.vote.document')->with("message","Elija un candidato...,vuelva a insertar su DNI.")
                                                            ->with("type","info");
        }
        return redirect()->route('portal.vote.index');
        
    }

    public function confirm_update(Request $request,$candidate_id){

        // Verificar sesión tmp
        // Verificar valor enviado
        // Eliminar sesión tmp
        // Generar Hash
        // Redireccionar al inicio y enviar un mensaje
        

        if($request->session()->has('code') && $request->session()->has('users_id')){

            $hash = $request->session()->get('code').$request->session()->get('users_id');
            $hash = Hash::make($hash);

            $data = [
                'candidate_id' => $candidate_id,
                'hash'         => $hash
            ];
            
            $success = Vote::create($data);

            if($success){

                // Actualizar
                Census::where('code','=',$request->session()->get('code'))->update(['condition'=>1]);

                // Eliminar session tmp
                $request->session()->forget('code');
                $request->session()->forget('users_id');

                return redirect()->route('portal.vote.index')->with("message","¡¡ FELICIDADES !! SU VOTO SE REALIZÓ CON ÉXITO")
                                                             ->with("type","success");
            }
            return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                                                  ->with("type","danger");

        }
        return redirect()->route('portal.vote.index');

    }

}
