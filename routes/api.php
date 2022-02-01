<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/packages',[\App\Http\Controllers\PackagesController::class, 'index']);
Route::get('/gallery',[\App\Http\Controllers\GalleryController::class, 'index']);

Route::group(['prefix' => 'appointment', 'as'=>'appointment.' ], function () {
    Route::get('/', [\App\Http\Controllers\AppointmentController::class, 'index'] );
    Route::post('/', [\App\Http\Controllers\AppointmentController::class, 'store'] );
    Route::post('/{id}', [\App\Http\Controllers\AppointmentController::class, 'update'] );
    Route::get('/{id}', [\App\Http\Controllers\AppointmentController::class, 'show'] );
});
