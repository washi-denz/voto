<?php

namespace App\Http\Controllers;

use App\Models\Census;
use Illuminate\Http\Request;

class CensusController extends Controller
{
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
