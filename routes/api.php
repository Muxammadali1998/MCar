<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PathController;
use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth:client')->group(function(){

    Route::post('client',[ClientController::class, 'client']);
    Route::put('client/{id}', [ClientController::class, 'update']);
    Route::delete('client/{id}',[ClientController::class, 'destroy']);
    Route::post('logout', [ClientController::class, 'logout']);
    
    Route::apiResource('people', PeopleController::class);
    Route::apiResource('car', CarController::class);
    Route::apiResource('path',PathController::class);
});

Route::get('client/{id}', [ClientController::class, 'show']);


Route::post('login', [ClientController::class, 'login']);
Route::post('register',[ClientController::class, 'register']);

Route::post('filter',[PathController::class, 'filter']);
