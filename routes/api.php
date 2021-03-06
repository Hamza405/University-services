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
    Route::get('/getUser',[App\Http\Controllers\ApiController::class, 'getUser']);
    Route::get('/ads',[App\Http\Controllers\ApiController::class, 'getAds']);
    Route::get('/services',[App\Http\Controllers\ApiController::class, 'getServices']);
    Route::post('/addOrder',[App\Http\Controllers\ApiController::class, 'addOrder']);
    Route::get('/getOrders',[App\Http\Controllers\ApiController::class, 'getOrders']);
    Route::get('/getMarks',[App\Http\Controllers\ApiController::class, 'getMarks']);
    Route::get('/getMarksOnly',[App\Http\Controllers\ApiController::class, 'getMarksOnly']);
    Route::get('/getSubjects',[App\Http\Controllers\ApiController::class, 'getSubjects']);
    Route::get('/getStudyProgram',[App\Http\Controllers\ApiController::class, 'getStudyProgram']);
    Route::post('/reOrder', [App\Http\Controllers\ApiController::class,'reOrder']);
    Route::post('/pullReOrder', [App\Http\Controllers\ApiController::class,'pullReOrder']);
    Route::get('/getReOrder', [App\Http\Controllers\ApiController::class,'getReOrder']);
    Route::post('/saveComplaint', [App\Http\Controllers\ApiController::class,'saveComplaint']);
    Route::get('/getExam', [App\Http\Controllers\ApiController::class,'getExam']);
});


