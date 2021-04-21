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

            $school->class = json_decode($school->class);

            //crear sessión permanente de aspecto voto electrónico
            $request->session()->put('logo',$school->logo);
            $request->session()->put('bg',$school->class->bg);
            $request->session()->put('color',$school->class->color);

            return view('portal.vote.index',['school'=>$school]);    
        }
        return redirect()->route('portal.home');

    }
}
