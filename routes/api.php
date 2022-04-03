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

Route::post('/signup',[App\Http\Controllers\ApiController::class, 'signup']);
Route::post('/login',[App\Http\Controllers\ApiController::class, 'login']);

Route::get('/ads',[App\Http\Controllers\ApiController::class, 'getAds']);

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return response()->json([
        'message' => 'Logout successfully',
        'status' => 200
    ]);
});

Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('/ads',[App\Http\Controllers\ApiController::class, 'getAds']);
    Route::get('/services',[App\Http\Controllers\ApiController::class, 'getServices']);
    Route::post('/addOrder',[App\Http\Controllers\ApiController::class, 'addOrder']);
    Route::get('/getOrders',[App\Http\Controllers\ApiController::class, 'getOrders']);

});


