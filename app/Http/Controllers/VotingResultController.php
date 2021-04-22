<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Census;
use App\Models\Vote;
use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class VotingResultController extends Controller
{
    public function index()
    {
        //$candidates = Candidate::all();
        //$emitido = Vote::count();
        //$total = Census::count();

        $school_id = Auth::user()->school_id;

        $candidates = User::select('candidates.id','candidates.logo','candidates.party_name','candidates.census_id','censuses.document','censuses.name','censuses.last_name','censuses.photo')
                        ->join('candidates','users.id','=','candidates.users_id')
                        ->join('censuses','censuses.id','=','candidates.census_id')
                    ->where('users.school_id','=',$school_id)->get();

        //$emitido = (Vote::count() > 0)? 0:1;
        $emitido = 0;

        foreach ($candidates as $candidate){
            $count = Vote::where('candidate_id','=',$candidate->id)->count();
            $candidate->votes = $count;
            $emitido = $emitido + $count;
        }

        $total = Census::select('*')
                    ->join('users','censuses.users_id','=','users.id')
                 ->where('users.school_id','=',$school_id)->count();
        
        return view('panel.vote.index', ['candidates' => $candidates, 'total' => $total, 'emitido' => $emitido]);
        
    }

    public function report()
    {
        //$candidates = Candidate::all();
        //$emitido = Vote::count();
        //$total = Census::count();

        $user = Auth::user();

        $candidates = User::select('candidates.id','candidates.logo','candidates.party_name','candidates.census_id','censuses.document','censuses.name','censuses.last_name','censuses.photo')
                        ->join('candidates','users.id','=','candidates.users_id')
                        ->join('censuses','censuses.id','=','candidates.census_id')
                    ->where('users.school_id','=',$user->school_id)->get();

        $emitido = 0;

        foreach ($candidates as $candidate){
            $count = Vote::where('candidate_id','=',$candidate->id)->count();
            $candidate->votes = $count;
            $emitido = $emitido + $count;
        }

        $total = Census::select('*')
                    ->join('users','censuses.users_id','=','users.id')
                 ->where('users.school_id','=',$user->school_id)->count();

        $school = School::where('id','=',$user->school_id)->first();

        $pdf = PDF::loadView('panel.vote.report', ['candidates' => $candidates, 'total' => $total, 'emitido' => $emitido,'school'=> $school]);

        return $pdf->stream('archivo.pdf');
    }
}
