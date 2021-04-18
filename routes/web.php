<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CensusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VotingResultController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ADMIN
Route::prefix('panel')->name('panel.')->group(function () {
    Route::resource('/', AdminController::class)->middleware('auth')->only(['index']);
    Route::resource('/census', CensusController::class)->parameters(['census' => 'census'])->middleware('auth');
    Route::resource('/vote', VotingResultController::class)->middleware('auth')->only('index');

    Route::get('/vote/report', [VotingResultController::class, 'report'])->middleware('auth')->name('vote.report');

    Route::post('/census/import', [CensusController::class, 'import_csv'])->middleware('auth')->name('census.import');
    Route::resource('/candidate', CandidateController::class)->middleware('auth');

    Route::post('/candidate/create', [CandidateController::class, 'data_census'])->name('candidate.create.data_census')->middleware('auth');
});


// PORTAL
Route::get('/', [VoteController::class, 'index'])->name('portal.home');

Route::prefix('portal')->name('portal.')->group(function () {
    Route::resource('/vote', VoteController::class);
    Route::get('/voto/confirm', [VoteController::class, 'show_confirm'])->name('show.confirm');
    Route::post('/voto/confirm/{id}', [VoteController::class, 'update_confirm'])->name('update.confirm');
});

require __DIR__ . '/auth.php';
