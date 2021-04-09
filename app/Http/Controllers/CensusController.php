<?php

namespace App\Http\Controllers;

use App\Models\Census;
use Illuminate\Http\Request;

class CensusController extends Controller
{
    public function index()
    {
        $censuses = Census::all();
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
