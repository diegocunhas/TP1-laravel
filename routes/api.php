<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestauranteApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/restaurante',[RestauranteApiController::class,'apiAll']);

Route::get('/restaurante/{restaraunte}',[RestauranteApiController::class,'apiFind']);

Route::post('/restaurante',[RestauranteApiController::class,'apiStore']);

Route::put('/restaurante/{restaraunte}',[RestauranteApiController::class,'apiUpdate']);

Route::delete('/restaurante/{restaraunte}',[RestauranteApiController::class,'apiDelete']);