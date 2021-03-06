<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\TipoRestauranteController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('global');
});

Route::resource('/pratos',PratoController::class);
Route::resource('/restaurantes',RestauranteController::class);
Route::resource('/tiporestaurantes',TipoRestauranteController::class);

// Route::get('/getprato/{id}', [RestauranteController::class, 'getPrato']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
