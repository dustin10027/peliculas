<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;

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

Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/pelicula', function () {
    return view('pelicula.index');
});

Route::get('/pelicula/create', [PeliculasController::class,'create']);
*/
Route::resource('pelicula',PeliculasController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [PeliculasController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/home', [PeliculasController::class, 'index'])->name('home');
});
