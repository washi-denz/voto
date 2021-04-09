<?php

use App\Http\Controllers\AdminController;
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
});


// PORTAL
Route::get('/home', function () {
    return view('index');
});

Route::get('/', [VoteController::class, 'index']);
Route::resource('voto', VoteController::class);

Route::get('/dni', [VoteController::class, 'document'])->name('portal.vote.document');

Route::post('/seleccion', [VoteController::class, 'selection'])->name('portal.vote.selection');

require __DIR__ . '/auth.php';
