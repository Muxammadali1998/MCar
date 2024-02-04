<?php

use App\Http\Controllers\Api\V1\Auth\ClientLoginController;
use App\Http\Controllers\Api\V1\Auth\ClientRegisterController;
use App\Http\Controllers\Api\V1\Car\CarController;
use App\Http\Controllers\Api\V1\Client\ClientAccountController;
use App\Http\Controllers\Api\V1\Client\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',ClientRegisterController::class);
Route::post('/login',ClientLoginController::class);

Route::middleware('auth:client')->group(function(){

    Route::get('/client',[ClientController::class, 'index']);
    Route::get('/client',[ClientController::class, 'getClientInfos']);
    Route::get('/client/{id}', [ClientController::class, 'show']);
    Route::put('/client/{id}', [ClientAccountController::class, 'update']);
    Route::delete('/client/{id}',[ClientAccountController::class, 'destroy']);
    Route::post('/logout', [ClientAccountController::class, 'logout']);

//    Route::apiResource('people', PeopleController::class);
    Route::apiResource('/car', CarController::class);
//    Route::apiResource('path',PathController::class);
});

