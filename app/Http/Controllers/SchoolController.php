<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index(){

        $schools = School::select('*')->get();

        return view('portal.index',['schools'=>$schools]);
    }

    public function index_school($slug){

        $school = School::where('slug','=',$slug)->get();

        if(count($school) > 0){
            return view('portal.vote.index',['slug'=>$slug]);    
        }
        return redirect()->route('portal.home');

    }
}
