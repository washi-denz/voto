<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Census;
use App\Models\Vote;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class VotingResultController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        $emitido = Vote::count();
        $total = Census::count();
        return view('panel.vote.index', ['candidates' => $candidates, 'total' => $total, 'emitido' => $emitido]);
    }

    public function report()
    {
        $candidates = Candidate::all();
        $emitido = Vote::count();
        $total = Census::count();
        $pdf = PDF::loadView('panel.vote.report', ['candidates' => $candidates, 'total' => $total, 'emitido' => $emitido]);
        return $pdf->stream('archivo.pdf');
    }
}
