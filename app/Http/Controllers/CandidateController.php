<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $censuses = Candidate::select('*'); // use join
        if ($request->has('filter') && in_array($request->filter, $columns)) {
            $filter = trim($request->filter);
            $order  = ($request->has('order') && $request->order == 'asc') ? 'asc' : 'desc';

            $censuses->orderBy($filter, $order);
            $queries['filter'] = $filter;
            $queries['order']  = $order;
        } else {
            $censuses->orderBy('party_name', 'asc');
        }
        return $censuses->paginate(15)->appends($queries);
    }
    public function index(Request $request)
    {
        $candidates = $this->list($request);
        return view('panel.candidate.index', ['candidates' => $candidates]);
    }

    public function create()
    {
        // formulario de creacion
        return view('panel.candidate.create');
    }

    public function store(Request $request)
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

        if ($request->has('logo')) {
            $image = $request->file('logo');

            $name     = Str::slug($data['party_name']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $folder   = '/logos/';

            $this->uploadOne($image, $folder, 'public', $name);
            $data['logo'] = $name;
        } else {
            unset($data['logo']);
        }

        $candidate = Candidate::create($data);

        if ($candidate) {
            return redirect()->route('panel.candidate.create')->with("message", "Se ha añadido el candidato corectamente.")
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
            return redirect()->route('panel.candidate.edit')->with("message", "Se ha modificado el candidato corectamente.")
                ->with("type", "success");
        }
        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }

    public function destroy(Candidate $candidate)
    {
        if ($candidate->delete()) {
            return redirect()->route('panel.candidate.index')->with("message", "Se ha eliminado el candidato corectamente.")
                ->with("type", "success");
        }
        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }
}
