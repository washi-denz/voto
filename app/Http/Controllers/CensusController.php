<?php

namespace App\Http\Controllers;

use App\Models\Census;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

class CensusController extends Controller
{
    use UploadTrait;
    function list(Request $request)
    {
        $queries = array();
        $columns = [
            'name',
            'last_name',
            'document',
            'grade',
            'code',
        ];

        $censuses = Census::select('*');
        if ($request->has('filter') && in_array($request->filter, $columns)) {
            $filter = trim($request->filter);
            $order  = ($request->has('order') && $request->order == 'asc') ? 'asc' : 'desc';

            $censuses->orderBy($filter, $order);
            $queries['filter'] = $filter;
            $queries['order']  = $order;
        } else {
            $censuses->orderBy('name', 'asc');
        }
        return $censuses->paginate(15)->appends($queries);
    }
    public function index(Request $request)
    {
        $censuses = $this->list($request);
        return view('panel.census.index', ['censuses' => $censuses]);
    }

    public function create()
    {
        // formulario de creacion
        return view('panel.census.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required',
            'last_name' => 'required',
            'document'  => 'required|unique:censuses,document',
            'grade'     => '',
            'photo'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            //'doc_type'   => 'required',
            //'document'    => 'required|unique:censuses,document,null,null,doc_type,' . $request->get('doc_type'),
        ], [
            'name.required'      => 'Este dato es requerido',
            'last_name.required' => 'Este dato es requerido',
            'document.required'  => 'Este dato es requerido',
            'photo.image'        => 'Se requiere un archivo de imagen',
            'photo.mimes'        => 'Se requiere un archivo de imagen (jpg, png, gif)',
            'photo.max'          => 'El archivo tiene que ser menor a 2MB',
        ]);

        $data['code'] = strtoupper(substr(md5(rand()), 0, 4));
        $data['users_id'] = Auth::user()->id;

        if ($request->has('photo')) {
            $image = $request->file('photo');

            $name     = Str::slug($data['name'] . ' ' . $data['last_name']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $folder   = '/photos/';

            $this->uploadOne($image, $folder, 'public', $name);
            $data['photo'] = $name;
        } else {
            unset($data['photo']);
        }

        $census = Census::create($data);

        if ($census) {
            return redirect()->route('panel.census.create')->with("message", "Se ha añadido al padron corectamente.")
                ->with("type", "success");
        }
        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }

    public function show(Census $census)
    {
        return view('panel.census.show', ['census' => $census]);
    }

    public function edit(Census $census)
    {
        return view('panel.census.edit', ['census' => $census]);
    }

    public function update(Request $request, Census $census)
    {
        $data = $request->validate([
            'name'      => 'required',
            'last_name' => 'required',
            'document'  => 'required|unique:censuses,document,' . $census->id,
            'grade'     => '',
            'photo'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required'      => 'Este dato es requerido',
            'last_name.required' => 'Este dato es requerido',
            'document.required'  => 'Este dato es requerido',
            'photo.image'        => 'Se requiere un archivo de imagen',
            'photo.mimes'        => 'Se requiere un archivo de imagen (jpg, png, gif)',
            'photo.max'          => 'El archivo tiene que ser menor a 2MB',
        ]);
        //$data['code'] = strtoupper(substr(md5(rand()), 0, 4));
        $data['users_id'] = Auth::user()->id;

        $last_photo = $census->getRawOriginal('photo');
        if ($request->has('photo')) {
            $image = $request->file('photo');
            $name     = Str::slug($data['name'] . ' ' . $data['last_name']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $folder   = '/photos/';

            $this->uploadOne($image, $folder, 'public', $name, $last_photo);
            $data['photo'] = $name;
        } else {
            $data['photo'] = $last_photo;
        }

        $success = $census->update($data);
        if ($success) {
            return redirect()->route('panel.census.edit', $census)->with("message", "Se ha modificado el padron corectamente.")
                ->with("type", "success");
        }
        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }

    public function destroy(Census $census)
    {
        if ($census->delete()) {
            return redirect()->route('panel.census.index')->with("message", "Se ha eliminado del padron corectamente.")
                ->with("type", "success");
        }
        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }
}
