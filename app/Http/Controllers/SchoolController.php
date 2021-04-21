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

    public function index_school(Request $request,$slug){

        $school = School::where('slug','=',$slug)->first();

        if($school){

            //crear sessión permanente de aspecto voto electrónico
            $request->session()->put('logo',$school->logo);

            return view('portal.vote.index',['school'=>$school]);    
        }
        return redirect()->route('portal.home');

    }
}
