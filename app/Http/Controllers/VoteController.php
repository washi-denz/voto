<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Census;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\School;
use App\Models\User;


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
                'slug'     => 'required',
            ],
            [
                'document.required' => 'Este dato es requerido',
                'code.required'     => 'Este dato es requerido',
                'slug.required'     => 'No se ha elegido IE'
            ]
        );
    
        $census = Census::where('code','=',$data['code'])->where('document','=',$data['document'])->first();

        if ($census) {

            if ($census->condition == false) {

                $school = School::where('slug','=',$request->slug)->first();
                $users  = User::Where('id','=',$census->users_id)->where('school_id','=',$school->id)->first();

                if($users){

                    //creando sesión tmp      
                    $request->session()->put('census_id',$census->id);//para crear el hash
                    $request->session()->put('slug',$request->slug);//para la vista
        
                    return redirect()->route('portal.vote.show',$census);

                }
                return redirect()->back()->with("message","El DNI y Código no pertenece a esta IE. Elija su IE correcta o contacte con la Comisión Electoral.")
                    ->with("type","danger");
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

            $slug      = $request->session()->get('slug');
            $school_id = School::where('slug','=',$slug)->first();
            
            //SELECT candidates.id,candidates.logo,candidates.party_name,candidates.census_id ,censuses.photo,censuses.name,censuses.last_name FROM users users 
                //INNER JOIN candidates candidates ON users.id = candidates.users_id 
                //INNER JOIN censuses censuses ON censuses.id = candidates.census_id
           // WHERE users.school_id =2;
            

            $candidates = User::select('candidates.logo','candidates.id','candidates.party_name','censuses.photo','censuses.name','censuses.last_name')
                                    ->join('candidates','users.id','=','candidates.users_id')
                                    ->join('censuses','censuses.id','=','candidates.census_id')
                                ->where('users.school_id','=',$school_id->id)
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
        $slug         = $request->session()->get('slug');

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

        $slug = $request->session()->get('slug');

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
                $request->session()->forget('slug');

                return redirect()->route('portal.index.school',$slug)->with("message","¡¡ FELICIDADES !! SU VOTO SE REALIZÓ CON ÉXITO")
                    ->with("type","success");
            }
            return redirect()->route('portal.index.school',$slug)->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type","danger");

        }
        return redirect()->route('portal.home')->with("message","No está autorizado para realizar esta acción.")
            ->with("type", "danger");
                    
    }

}
