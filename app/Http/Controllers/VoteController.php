<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Census;
use App\Models\Candidate;
use App\Models\Vote;


class VoteController extends Controller
{    
    public function index(){
        return view('portal.vote.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'document' => 'required',
                'code'     => 'required',
            ],
            [
                'document.required' => 'Este dato es requerido',
                'code.required'     => 'Este dato es requerido',
            ]
        );
    
        $census = Census::where('code','=',$data['code'])->where('document','=',$data['document'])->first();

        if ($census) {
            //$request->session()->remove('census_id');
            if ($census->condition == false) {

                $request->session()->put('census_id', $census->id);
    
                return redirect()->route('portal.vote.show',$census);
            }
            return redirect()
                ->back()
                ->withInput() //para retornar los valores del formulario
                ->with("message", "Atención!!! Ud ya sufragó, si hay error contacte con la Comisión Electoral.")
                ->with("type", "warning");
        }
        return redirect()
            ->back()
            ->withInput() //para retornar los valores del formulario
            ->with("message", "Su clave es INVÁLIDA, si persiste el problema contacte con la Comisión Electoral.")
            ->with("type", "danger");
    }

    public function show(Request $request,$census_id){

        if($request->session()->get('census_id') == $census_id ){

            $candidates = Candidate::select('candidates.logo','candidates.id','candidates.party_name','censuses.photo','censuses.name','censuses.last_name')
                                    ->join('censuses','candidates.census_id','=','censuses.id')
                                    ->get();

            $census = Census::where('id',$census_id)->get();
            $census = $census[0];

            return view('portal.vote.selection',['candidates'=>$candidates,'census'=>$census]);

        }
        return redirect()->route('portal.home')->with("message","No está autorizado para realizar esta acción.")
            ->with("type", "danger");

    }

    public function show_confirm(Request $request,Census $census){  

        $census_id    = $request->census_id;
        $candidate_id = $request->candidate_id;

        if($request->session()->get('census_id') == $census_id ){

            $candidate = Candidate::select('candidates.logo','candidates.id','candidates.party_name','censuses.photo','censuses.name','censuses.last_name')
                                    ->join('censuses','candidates.census_id','=','censuses.id')
                                    ->where('candidates.id','=',$candidate_id)
                                    ->get();

            $census = Census::where('id',$census_id)->get();
            $census = $census[0];

            //return ['candidate'=>$candidate,'census'=>$census];
            return view('portal.vote.confirm',['candidate'=>$candidate[0],'census'=>$census]);

        }
        return redirect()->route('portal.home')->with("message","No está autorizado para realizar esta acción.")
            ->with("type", "danger");

    }

    public function update_confirm(Request $request,$candidate_id){

        if($request->session()->has('census_id')){

            $census_id = $request->session()->get('census_id');
            
            $hash = Hash::make($census_id);//hash

            $data = [
                'candidate_id' => $candidate_id,
                'hash'         => $hash
            ];
            
            $success = Vote::create($data);

            if($success){

                // Actualizar
                Census::where('id','=',$census_id)->update(['condition'=>1]);

                // Eliminar session tmp
                $request->session()->forget('census_id');

                return redirect()->route('portal.home')->with("message","¡¡ FELICIDADES !! SU VOTO SE REALIZÓ CON ÉXITO")
                    ->with("type","success");
            }
            return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type","danger");

        }
        return redirect()->route('portal.home')->with("message","No está autorizado para realizar esta acción.")
            ->with("type", "danger");
                    
    }

}
