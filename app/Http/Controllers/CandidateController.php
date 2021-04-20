<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Census;
use App\Models\User;
use App\Models\Vote;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    use UploadTrait;
    function list(Request $request)
    {
        $queries = array();
        $columns = [
            'party_name',
            'logo',
            'census_id',
        ];

        $user = Auth::user();

        $candidates = User::select('candidates.id','candidates.logo','candidates.party_name','candidates.census_id','censuses.document','censuses.name','censuses.last_name','censuses.photo')
            ->join('candidates','users.id','=','candidates.users_id')
            ->join('censuses','censuses.id','=','candidates.census_id')
        ->where('users.school_id','=',$user->school_id);

        if ($request->has('filter') && in_array($request->filter, $columns)) {
            $filter = trim($request->filter);
            $order  = ($request->has('order') && $request->order == 'asc') ? 'asc' : 'desc';

            $candidates->orderBy($filter, $order);
            $queries['filter'] = $filter;
            $queries['order']  = $order;
        } else {
            $candidates->orderBy('party_name', 'asc');
        }
        return $candidates->paginate(15)->appends($queries);
    }
    public function index(Request $request)
    {
        $candidates = $this->list($request);
        return view('panel.candidate.index', ['candidates' => $candidates]);
    }

    public function create(Census $census)
    {
        // formulario de creacion
        return view('panel.candidate.create',['census' => $census]);
    }

    public function store(Request $request,Census $census)
    {
        $data = $request->validate([
            'party_name' => 'required',
            'census_id'  => 'required|exists:censuses,id',
            'logo'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'party_name.required' => 'Se requiere un nombre de partido',
            'census_id.required'  => 'Se requiere que seleccione un candidato',
            'census_id.exists'    => 'Este candidato no existe en el padron',
            'logo.image'          => 'Se requiere un archivo de imagen',
            'logo.mimes'          => 'Se requiere un archivo de imagen (jpg, png, gif)',
            'logo.max'            => 'El archivo tiene que ser menor a 2MB',
        ]);

        $user = Auth::user();

        if ($request->has('logo')) {
            $image = $request->file('logo');

            $name     = Str::slug($data['party_name']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $folder   = '/logos/';

            $this->uploadOne($image, $folder, 'public', $name);

            $data['logo']     = $name;
            $data['users_id'] = $user->id; 

        } else {
            unset($data['logo']);
            //$data['logo'] = 'default.png';
        }

        $candidate = Candidate::create($data);

        if ($candidate) {
            return redirect()->route('panel.candidate.index')->with("message", "Se ha añadido el candidato correctamente.")
                ->with("type", "success");
        }
        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }

    public function show(Candidate $candidate)
    {
        return view('panel.candidate.show', ['candidate' => $candidate]);
    }

    public function edit(Candidate $candidate)
    {
        $census = Census::where('id',$candidate['census_id'])->get();
        $candidate->census = $census[0];

        return view('panel.candidate.edit', ['candidate' => $candidate]);
    }

    public function update(Request $request, Candidate $candidate)
    {
        $data = $request->validate([
            'party_name' => 'required',
            'census_id'  => 'required|exists:censuses,id',
            'logo'       => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'party_name.required' => 'Se requiere un nombre de partido',
            'census_id.required'  => 'Se requiere que seleccione un candidato',
            'census_id.exists'    => 'Este candidato no existe en el padron',
            'logo.image'          => 'Se requiere un archivo de imagen',
            'logo.mimes'          => 'Se requiere un archivo de imagen (jpg, png, gif)',
            'logo.max'            => 'El archivo tiene que ser menor a 2MB',
        ]);

        $last_logo = $candidate->getRawOriginal('logo');
        if ($request->has('logo')) {
            $image = $request->file('logo');

            $name     = Str::slug($data['party_name']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $folder   = '/logos/';

            $this->uploadOne($image, $folder, 'public', $name, $last_logo);
            $data['logo'] = $name;
        } else {
            $data['logo'] = $last_logo;
        }

        $success = $candidate->update($data);

        if ($success) {
            return redirect()->route('panel.candidate.edit',$candidate)->with("message", "Se ha modificado el candidato corectamente.")
                ->with("type", "success");
        }
        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }

    public function destroy(Candidate $candidate)
    {
        $success = Vote::where('candidate_id','=',$candidate->id)->first();

        if(!$success){

            if ($candidate->delete()) {
                return redirect()->route('panel.candidate.index')->with("message", "Se ha eliminado el candidato corectamente.")
                    ->with("type", "success");
            }
            return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type", "error");
        }
        return redirect()->route('panel.candidate.index')->with("message", "No se puede eliminar pq ya tiene votos el candidato.")
        ->with("type", "info");
        
    }

    public function data_census(Request $request)
    {   
        $data = $request->validate(
            [
                'document' => 'required'
            ],
            [
                'document.required' => 'Este dato es requerido.'
            ]
        );

        $user   = Auth::user();

        $census = Census::where('document','=',$data['document'])->where('users_id','=',$user->id)->first();

        if($census){

            $candidate = Candidate::where('census_id','=',$census['id'])->get();

            if(!(count($candidate) == 1)){            
                return view('panel.candidate.create',compact('census'));    
            }
            return redirect()->route('panel.candidate.create')->with("message","El candidato ya existe.")
                ->with("type", "success");     

        }
        return redirect()->route('panel.candidate.create')->with("message","El DNI no existe en el padrón electoral")
            ->with("type", "error"); 
        
    }
}
