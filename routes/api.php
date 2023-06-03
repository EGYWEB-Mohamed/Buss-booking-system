<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\StationController;
use App\Http\Controllers\API\TripController;
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
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::group(['prefix' => 'account','middleware' => ['auth:sanctum']],function () {
    Route::apiResource('reservation',ReservationController::class)
         ->only(['index','store','show']);
    Route::get('trip',[TripController::class,'search']);
    Route::apiResource('station',StationController::class)
         ->only(['index']);
});
