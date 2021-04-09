<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Census;
use App\Models\Candidate;

class VoteController extends Controller
{
   
    function __construct(){
        //   
    }

    public function index(){
        return view('portal.vote.index');
    }

    public function store(Request $request){

        $code = $request->get('code');

        $census    = Census::where('code','=',$code)->get();
        $condition = Census::where('code','=',$code)->where('condition','<>',true)->get();
        
        if(count($census) > 0){
            if(count($condition)>0){
                //Creamos una session temporal de code y users_id
                $request->session()->put('code',$code);//code
                $users_id = 2;
                $request->session()->put('users_id',$users_id);//usuario creador del voto electrónico

                return view('portal.vote.dni'); 
            }
            return redirect()->back()->with(['message'=>'Atención!!! Ud ya sufragó, si hay error contacte con la Comisión Electoral.','code'=>$code,]);
        }
        return redirect()->back()->with(['message'=>'Su clave es INVÁLIDA, si persiste el problema contacte con la Comisión Electoral.','code'=>$code]);
    
    }
    public function document(){
        return view('portal.vote.dni');
    }
    public function selection(Request $request){

        $dni        = $request->get('dni');
        $census_dni = Census::where('document','=',$dni)->get();
        
        if(count($census_dni) > 0){
            
            $users_id = $request->session()->get('users_id');

            $datos['candidates'] = Candidate::select('candidates.logo','candidates.party_name','censuses.photo','censuses.name')
                                                ->join('censuses','candidates.census_id','=','censuses.id')
                                                ->where('candidates.users_id','=',$users_id)
                                                ->get();
            return view('portal.vote.selection',$datos);
        }
        
       return redirect()->route('portal.vote.document')->with(['message'=>'Su DNI es incorrecto,intentalo de nuevo.','dni'=>$dni]);
        
        //return $census_dni;
        //$users_id = $request->session()->get('users_id');

        /*
        //$datos['candidates'] = Candidate::where('users_id','=',$users_id)->get();
        $datos['candidates'] = Candidate::select('candidates.logo','candidates.party_name','censuses.photo','censuses.name')
                                            ->join('censuses','candidates.census_id','=','censuses.id')
                                            ->where('candidates.users_id','=',$users_id)
                                            ->get();
        $datos['census'] = Census::select('')->where->get();
        return $datos;
        */
        //return view('portal.vote.selection',$datos);
    }
}
