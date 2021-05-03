<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CensusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VotingResultController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SchoolController;

use App\Http\Livewire\ShowCandidate;
use App\Http\Livewire\IndexVote;

// ADMIN
Route::prefix('panel')->name('panel.')->group(function () {
    Route::resource('/', AdminController::class)->middleware('auth')->only(['index']);
    Route::resource('/census', CensusController::class)->parameters(['census' => 'census'])->middleware('auth');
    Route::resource('/vote', VotingResultController::class)->middleware('auth')->only('index');

    Route::get('/vote/report', [VotingResultController::class, 'report'])->middleware('auth')->name('vote.report');

    Route::post('/census/import', [CensusController::class, 'import_csv'])->middleware('auth')->name('census.import');
    Route::resource('/candidate', CandidateController::class)->middleware('auth');

    Route::post('/candidate/create', [CandidateController::class, 'data_census'])->name('candidate.create.data_census')->middleware('auth');

    Route::get('/showcandidate',ShowCandidate::class)->name('panel.showcandidate')->middleware('auth');
});


// PORTAL
//Route::get('/',IndexVote::class)->name('index.school');

Route::get('/', [SchoolController::class, 'index'])->name('portal.home');

Route::prefix('portal')->name('portal.')->group(function (){
    Route::get('/{school}',IndexVote::class)->name('index.school');
});

require __DIR__ . '/auth.php';
