<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Census;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotingResultController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        $emitido = Vote::count();
        $total = Census::count();
        return view('panel.vote.index', ['candidates' => $candidates, 'total' => $total, 'emitido' => $emitido]);
    }
}
