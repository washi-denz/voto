<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index(Request $request){

        $schools = School::select('*')->get();

        return view('portal.index',['schools'=>$schools]);
    }

    public function index_school(Request $request,$slug){
        return $slug;
    }
}
