<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Section;
use App\Models\User;
use App\Models\Subjects;
use App\Models\AD;
use Carbon\Carbon;

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
    $sections =DB::table('study_sections')->get();
    $students =DB::table('users')->get();
    $subjects =DB::table('subjects')->get();
    $rowsForDeleted = AD::select('id')->whereMonth('created_at',Carbon::now()->month)->get();
    AD::whereNotIn('id', $rowsForDeleted)->delete();
    $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
    return view('index')->with('sections',$sections)->with('students',$students)
    ->with('subjects',$subjects)->with('ads',$ads);
});


Auth::routes();
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::group(['middleware' => ['employeeRoutes']],function() {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   
        Route::get('myMarks',[App\Http\Controllers\HomeController::class,'viewMyMarks']);
        Route::get('viewStudentsSubjects', [App\Http\Controllers\HomeController::class,'viewStudentsSubjects']);
        Route::get('exportPdf',[App\Http\Controllers\HomeController::class,'exportPdf']);
        Route::get('exportOnlyPdf',[App\Http\Controllers\HomeController::class,'exportOnlyPdf']);
        Route::get('myMarksOnly',[App\Http\Controllers\HomeController::class,'viewMyMarksOnly']);    
        Route::get('viewStudyProgram', [App\Http\Controllers\HomeController::class,'viewStudyProgram']);
        Route::get('/viewStudyExam',[App\Http\Controllers\ImageController::class,'viewStudyExam']);
        Route::post('addOrderStd', [App\Http\Controllers\HomeController::class,'addOrderStd']);
        Route::post('reOrder', [App\Http\Controllers\HomeController::class,'reOrder']);
        Route::get('pullReOrder/{uId}/{sId}', [App\Http\Controllers\HomeController::class,'pullReOrder']);
        Route::post('saveComplaint',[App\Http\Controllers\ComplaintController::class,'saveComplaint']);
    }
);


Route::group(['middleware' => ['studentRoutes']],function() {
        Route::get('adminDash', [App\Http\Controllers\HomeController::class,'dashboard'])->name('adminDash');
        Route::get('subjects', [App\Http\Controllers\HomeController::class,'subjects']);
        Route::get('services', [App\Http\Controllers\HomeController::class,'services'])->name('services');
        Route::get('sections', [App\Http\Controllers\HomeController::class,'sections'])->name('sections');
        Route::get('studySections', [App\Http\Controllers\HomeController::class,'studySections'])->name('studySections');
        Route::get('students', [App\Http\Controllers\HomeController::class,'students']);
        Route::get('employees', [App\Http\Controllers\HomeController::class,'employees']);
        Route::get('orders', [App\Http\Controllers\HomeController::class,'orders']);
        Route::get('addmyMarks', [App\Http\Controllers\HomeController::class,'myMarks']);
        Route::post('addMark', [App\Http\Controllers\HomeController::class,'saveAddMark']);
        Route::get('ordersDone/{uId}/{sId}', [App\Http\Controllers\HomeController::class,'orderDone']);
        Route::delete('/deleteAds/{post}',[App\Http\Controllers\HomeController::class,'deleteAds'])->name('ads.delete');
        Route::get('addStudents', [App\Http\Controllers\HomeController::class,'addStudent']);
        Route::get('addStudySection', [App\Http\Controllers\HomeController::class,'addStudySection']);
        Route::Post('addStudySection', [App\Http\Controllers\HomeController::class,'storeStudySection']);
        Route::post('addStudents', [App\Http\Controllers\HomeController::class,'storeStudent']);
        Route::get('/addEmployee', [App\Http\Controllers\HomeController::class, 'addEmployee'])->name('addEmployee');
        Route::get('addEmployee', [App\Http\Controllers\HomeController::class,'addEmployee']);
        Route::post('addEmployee', [App\Http\Controllers\HomeController::class,'storeEmployee']);
        Route::get('addSection', [App\Http\Controllers\HomeController::class,'addSection']);
        Route::post('addSection', [App\Http\Controllers\HomeController::class,'storeSection']);
        Route::get('addSubject', [App\Http\Controllers\HomeController::class,'addSubject']);
        Route::post('addSubject', [App\Http\Controllers\HomeController::class,'storeSubject']);
        Route::get('addAds', [App\Http\Controllers\HomeController::class,'addAds'])->name('ads');
        Route::post('addAds', [App\Http\Controllers\HomeController::class,'storeAds']);
        Route::get('addService', [App\Http\Controllers\HomeController::class,'addService']);
        Route::post('addService', [App\Http\Controllers\HomeController::class,'storeService']);
        Route::get('addPro', [App\Http\Controllers\HomeController::class,'addPro']);
        Route::put('addPro', [App\Http\Controllers\HomeController::class,'storePro']);

        Route::delete('/deleteService/{post}',[App\Http\Controllers\HomeController::class,'deteteService']);
        Route::delete('/deleteSection/{post}',[App\Http\Controllers\HomeController::class,'deteteSection']);
        Route::delete('/deleteStudySection/{post}',[App\Http\Controllers\HomeController::class,'deleteStudySection']);
        
       
        Route::get('getreOrderRequest', [App\Http\Controllers\HomeController::class,'getreOrderRequest']);
        Route::get('exportExcel',[App\Http\Controllers\HomeController::class,'exportExcel']);
        Route::get('exportExcelOrder',[App\Http\Controllers\HomeController::class,'exportExcelOrder']);
        Route::get('exportExcelComplaints',[App\Http\Controllers\HomeController::class,'exportExcelComplaints']);
        Route::get('exportExcelEmployees',[App\Http\Controllers\HomeController::class,'exportExcelEmployees']);
        Route::get('/complaints',[App\Http\Controllers\ComplaintController::class,'complaints']);
        Route::get('/addStudyExam',[App\Http\Controllers\ImageController::class,'addStudyExam'])->name('addStudyExam');
        Route::post('/storeStudyExam',[App\Http\Controllers\ImageController::class,'storeStudyExam'])->name('images.store');
    }
);


















