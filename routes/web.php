<?php

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

Route::get('/',[VoteController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('voto',VoteController::class);

Route::get('/dni',[VoteController::class,'document'])->name('portal.vote.document');

Route::post('/seleccion',[VoteController::class,'selection'])->name('portal.vote.selection');

require __DIR__.'/auth.php';
