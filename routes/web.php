<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CandidateController;

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

// Route::get('/test', function () {
//     dd('abc');
// });
// Route::get('/test', [App\Http\Controllers\CandidateController::class, 'test']);

Route::resource('/candidate', CandidateController::class);
Route::post('candidateUpdate/{id}', 'App\Http\Controllers\CandidateController@update');


Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
