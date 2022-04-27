<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Section;
use App\Models\User;
use App\Models\Subjects;

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
    $sections =DB::table('sections')->get();
    $students =DB::table('users')->get();
    $subjects =DB::table('subjects')->get();
    $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
    return view('welcome')->with('sections',$sections)->with('students',$students)
    ->with('subjects',$subjects)->with('ads',$ads);
});
Route::get('/employeeRegister', [App\Http\Controllers\Auth\LoginController::class, 'employeeRegister'])->name('employeeRegister');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::get('adminDash', [App\Http\Controllers\HomeController::class,'dashboard']);
Route::get('subjects', [App\Http\Controllers\HomeController::class,'subjects']);
Route::get('services', [App\Http\Controllers\HomeController::class,'services']);
Route::get('sections', [App\Http\Controllers\HomeController::class,'sections']);
Route::get('students', [App\Http\Controllers\HomeController::class,'students']);
Route::get('orders', [App\Http\Controllers\HomeController::class,'orders']);

Route::get('addmyMarks', [App\Http\Controllers\HomeController::class,'myMarks']);
Route::post('addMark', [App\Http\Controllers\HomeController::class,'saveAddMark']);

Route::get('ordersDone/{uId}/{sId}', [App\Http\Controllers\HomeController::class,'orderDone']);

Route::delete('/deleteAds/{post}',[App\Http\Controllers\HomeController::class,'deleteAds'])->name('ads.delete');

Route::get('addStudents', [App\Http\Controllers\HomeController::class,'addStudent']);
Route::post('addStudents', [App\Http\Controllers\HomeController::class,'storeStudent']);

Route::get('addSection', [App\Http\Controllers\HomeController::class,'addSection']);
Route::post('addSection', [App\Http\Controllers\HomeController::class,'storeSection']);

Route::get('addSubject', [App\Http\Controllers\HomeController::class,'addSubject']);
Route::post('addSubject', [App\Http\Controllers\HomeController::class,'storeSubject']);

Route::get('addAds', [App\Http\Controllers\HomeController::class,'addAds'])->name('ads');
Route::post('addAds', [App\Http\Controllers\HomeController::class,'storeAds']);

Route::get('addService', [App\Http\Controllers\HomeController::class,'addService']);
Route::post('addService', [App\Http\Controllers\HomeController::class,'storeService']);

Route::post('addOrderStd', [App\Http\Controllers\HomeController::class,'addOrderStd']);


Route::get('addPro', [App\Http\Controllers\HomeController::class,'addPro']);
Route::put('addPro', [App\Http\Controllers\HomeController::class,'storePro']);

Route::get('viewProImg', [App\Http\Controllers\HomeController::class,'viewProImg']);


Route::get('viewStudentsSubjects', [App\Http\Controllers\HomeController::class,'viewStudentsSubjects']);

Route::post('reOrder', [App\Http\Controllers\HomeController::class,'reOrder']);

Route::get('pullReOrder/{uId}/{sId}', [App\Http\Controllers\HomeController::class,'pullReOrder']);

Route::get('getreOrderRequest', [App\Http\Controllers\HomeController::class,'getreOrderRequest']);

Route::get('myMarks',[App\Http\Controllers\HomeController::class,'viewMyMarks']);
Route::get('myMarksOnly',[App\Http\Controllers\HomeController::class,'viewMyMarksOnly']);

Route::get('exportPdf',[App\Http\Controllers\HomeController::class,'exportPdf']);
Route::get('exportOnlyPdf',[App\Http\Controllers\HomeController::class,'exportOnlyPdf']);
Route::get('exportExcel',[App\Http\Controllers\HomeController::class,'exportExcel']);
Route::get('exportExcelOrder',[App\Http\Controllers\HomeController::class,'exportExcelOrder']);

