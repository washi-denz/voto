<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CensusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;


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
    Route::resource('/census', CensusController::class)->middleware('auth');
    Route::resource('/candidate', CandidateController::class)->middleware('auth');
    
    Route::post('/candidate/create', [CandidateController::class,'data_census'])->name('candidate.create.data_census')->middleware('auth');
});


// PORTAL
Route::get('/home', function () {
    return view('index');
});

Route::get('/', [VoteController::class, 'index'])->name('portal.vote.index');
Route::resource('vote', VoteController::class);

Route::get('/dni', [VoteController::class, 'document'])->name('portal.vote.document');

Route::get('/seleccion', [VoteController::class, 'selection'])->name('portal.vote.selection');
Route::post('/seleccion', [VoteController::class, 'selection'])->name('portal.vote.selection');
Route::put('/seleccion', [VoteController::class, 'selection_show'])->name('portal.vote.selection.show');

Route::get('/confirmar', [VoteController::class, 'confirm'])->name('portal.vote.confirm');
Route::post('/confirmar', [VoteController::class, 'confirm'])->name('portal.vote.confirm');
Route::post('/confirmar/{id}', [VoteController::class, 'confirm_update'])->name('portal.vote.confirm.update');

require __DIR__ . '/auth.php';
