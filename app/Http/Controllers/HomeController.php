<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Section;
use App\Models\User;
use App\Models\Mark;
use App\Models\Subject;
use App\Models\Service;
use App\Models\Student;
use App\Models\Order;
use App\Models\AD;
use App\Models\StudySection;
use App\Models\Reorder;
use App\Models\ProImage;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Hash;
use Mpdf\Mpdf;
use Illuminate\Contracts\Support\Responsable;
use Auth;
use Carbon\Carbon;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

use App\Exports\IExport;
use App\Exports\OExport;
use App\Exports\CExport;
use App\Exports\EExport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{       $sections =DB::table('study_sections')->get();
        $user =DB::table('users')->get();
        $subjects =DB::table('subjects')->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        $services =DB::table('services')->get();
        $orders =DB::table('orders')->where('userID',Auth::user()->id)->get();
        $reorders =DB::table('reorders')->where('userID',Auth::user()->id)->get();
        $rowsForDeleted = AD::select('id')->whereMonth('created_at',Carbon::now()->month)->get();
        AD::whereNotIn('id', $rowsForDeleted)->delete();     
        $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
        return view('home')->with('sections',$sections)->with('user',$user)
        ->with('subjects',$subjects)->with('orders',$orders)
        ->with('services',$services)->with('ads',$ads)->with('reorders',$reorders);
    }
   
    public function exportPdf(){
        $user = Auth::user();
        $data = Mark::where('userID',Auth::user()->id)->get();
        view()->share(['marks'=> $data,'user'=>$user]);
        $pdf = PDF::loadView('pdfMarkTable', $data);
        return $pdf->download('marks.pdf');
       
      
      
        // return Excel::download(new IExport(), 'ad.pdf');

        // return Excel::download(Mark::get(), 'invoices.xlsx');
    }
    public function exportOnlyPdf(){
        $user = Auth::user();
        $data = Mark::where('userID',Auth::user()->id)->where('result','ناجح')->orderBy('subjectId','ASC')->get();
        view()->share(['marks'=> $data,'user'=>$user]);
        $pdf = PDF::loadView('pdfMyMarkOnlyTable', $data);
        return $pdf->download('marks.pdf');
       
      
      
        // return Excel::download(new IExport(), 'ad.pdf');

        // return Excel::download(Mark::get(), 'invoices.xlsx');
    }

    public function exportExcel(){
        return  Excel::download(new IExport, 'students.xlsx');

    }
    public function exportExcelOrder(){
        return  Excel::download(new OExport, 'subjects.xlsx');

    }
    public function exportExcelComplaints(){
        return  Excel::download(new CExport, 'complaints.xlsx');

    }
    public function exportExcelEmployees(){
        return  Excel::download(new EExport, 'employees.xlsx');

    }

    public function orders(){
        $orders =DB::table('orders')->where('section',Auth::user()->section)->paginate(10);

        return view('viewOrders')->with('orders',$orders);
    }

    public function pullReOrder($uId,$sId){
        Reorder::where([
            'userID' => $uId,
            'subjectID' => $sId,
        ])->delete();

        $sections =DB::table('sections')->get();
        $students =DB::table('users')->get();
        $subjects =DB::table('subjects')->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        $services =DB::table('services')->get();
        $orders =DB::table('orders')->where('userID',Auth::user()->id)->get();
        $reorders =DB::table('reorders')->where('userID',Auth::user()->id)->get();
        
        $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
        return redirect('/home')->with('sections',$sections)->with('students',$students)
        ->with('subjects',$subjects)->with('orders',$orders)
        ->with('services',$services)->with('ads',$ads)->with('reorders',$reorders);
    }

    public function reOrder(Request $request){
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addDay(30);
        
        // $date =date('Y-m-d H:i:s');
        // $daysToAdd = 5;
        // $date = $date->addDays("30");
        $order = ReOrder::where([
            'userID' => $request->userID,
            'subjectID' => $request->subjectID,
        ])->first();
        if($order!=null){
            return redirect()->back()->withError('msg');
        }

        Reorder::create([
            'userID' => Auth::user()->id,
            'subjectID' => $request->subject,
            'deadline' => $newDateTime,
            'section' => Auth::user()->section
        ]);

        $sections =DB::table('sections')->get();
        $students =DB::table('users')->get();
        $subjects =DB::table('subjects')->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        $services =DB::table('services')->get();
        $orders =DB::table('orders')->where('userID',Auth::user()->id)->get();
        $reorders =DB::table('reorders')->where('userID',Auth::user()->id)->get();
        

        

        $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
        return redirect('/home')->with('sections',$sections)->with('students',$students)
        ->with('subjects',$subjects)->with('orders',$orders)
        ->with('services',$services)->with('ads',$ads)->with('reorders',$reorders);
    }

    public function addPro(){
        $section = (new StudySection)->getSectionByName(Auth::user()->section);
        $studypro = DB::table('study_program')->where('section_id','=',$section->id)->get();
        return view('addPro')->with('studypro',$studypro);
    }
     
    public function viewProImg(){
        $studypro = DB::table('study_program')->get();
        $sections =DB::table('sections')->get();
        $students =DB::table('users')->get();
        $subjects =DB::table('subjects')->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        $services =DB::table('services')->get();
        $orders =DB::table('orders')->where('userID',Auth::user()->id)->get();
        $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
        
        return view('viewProImage')->with('studypro',$studypro)->with('sections',$sections)->with('students',$students)
        ->with('subjects',$subjects)->with('orders',$orders)
        ->with('services',$services)->with('ads',$ads);
    }

    public function viewStudentsSubjects(){
       
        $sections =DB::table('sections')->get();
        $students =DB::table('users')->get();
        $subjects =DB::table('subjects')->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        $services =DB::table('services')->get();
        $orders =DB::table('orders')->where('userID',Auth::user()->id)->get();
        $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
        $img = ProImage::orderby('id','desc')->first();
        return view('viewStudentsSubjects')->with('img',$img)->with('sections',$sections)->with('students',$students)
        ->with('subjects',$subjects)->with('orders',$orders)
        ->with('services',$services)->with('ads',$ads);
    }

    public function storePro(Request $request){
        $section = (new StudySection)->getSectionByName(Auth::user()->section);
        DB::table('study_program')->where('id','=',$request->day)->where('section_id','=',$section->id)->update([
            'year1'=>$request->y1,
            'year2'=>$request->y2,
            'year3'=>$request->y3,
            'year4'=>$request->y4,
            'year5'=>$request->y5,
        ]);
        $studypro = DB::table('study_program')->where('section_id','=',$section->id)->get();
        return view('addPro')->with('studypro',$studypro);
    }

    public function viewStudyProgram(){
        
        return view('viewProImage')->with('studypro',$studypro);
    }

    public function orderDone($uId,$sId){

        DB::table('orders')
        ->where([
            ['userID',$uId],['serviceID',$sId]
        ])
        ->update(['state' =>'1']);
        $orders =DB::table('orders')->get();
        return redirect('/orders')->with('orders',$orders);
    }


    

    public function addOrderStd(Request $request)
    {  
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addDay(30);

        $order = Order::where('userID',Auth::user()->id)->where('serviceID',$request->service)->first();
        if($order!=null){
            return redirect()->back()->withErrors(['msg', 'The Message']);
        }
        

        Order::create([
            'userID' => Auth::user()->id,
            'serviceID' => $request->service,
            'state' => 0,
            'deadline'=> $newDateTime,
            'section' => Auth::user()->section
        ]);
        
            $sections =DB::table('sections')->get();
            $students =DB::table('users')->get();
            $subjects =DB::table('subjects')->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
            $services =DB::table('services')->get();
            $orders =DB::table('orders')->get();
            $reorders =DB::table('reorders')->where('userID',Auth::user()->id)->get();
            $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
            return redirect('/home')->with('sections',$sections)->with('students',$students)
            ->with('subjects',$subjects)->with('services',$services)->with('ads',$ads)
            ->with('orders',$orders)->with('reorders',$reorders);
    }

    public function dashboard()
    {
        $subjects = Subject::orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        $sections = Section::all();
        $studySection = StudySection::all();
        $students = User::where('role','طالب')->get();
        $employees = User::where('role','موظف')->get();
        $services = Service::all();
        return view('dashboard')
        ->with('subjects',$subjects)
        ->with('sections',$sections)
        ->with('students',$students)
        ->with('services',$services)
        ->with('studySection',$studySection)
        ->with('employees',$employees);
    }

    public function subjects()
    {
        $subjects = Subject::where('section',Auth::user()->section)->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        return view('viewSubjects')->with('subjects',$subjects);
    }

    public function getreOrderRequest()
    {
        $orders = Reorder::all();
        return view('ordersRequest')->with('orders',$orders);
    }

    public function services ()
    {   $services = Service::all();
        return view('viewServices')->with('services',$services);
    }

    public function sections ()
    {   $sections = Section::all();
        return view('viewSections')->with('sections',$sections);
    }

    public function students ()
    {   $students = User::where('role','طالب')->paginate(5);
        return view('viewStudents')->with('students',$students);
    }

    public function employees ()
    {   $employees = User::where('role','موظف')->paginate(5);
        return view('viewEmployees')->with('employees',$employees);
    }

    public function addStudent ()
    {   
        return view('addStudent');
    }

    public function addEmployee(){
        $sections = StudySection::all();
        return view('addEmployee')->with('sections',$sections);
    }

    public function addSubject ()
    {   
        return view('addSubject');
    }

    public function addService ()
    {   
        return view('addService');
    }

    public function addSection ()
    {   
        return view('addSection');
    }

    public function addStudySection(){
        return view('addStudySection');
    }

    public function addAds ()
    {   
        $sections =DB::table('sections')->get();
        $ads=AD::where('parent_section',Auth::user()->section)->get();
        return view('addAds')->with('sections',$sections)->with('ads',$ads);
    }

    public function deleteAds($id){
        
        $item = AD::findOrFail($id);
        $item->delete();
        
        
        $sections = Section::get();
        $ads=AD::get();
        return redirect()->route('ads')->with('sections',$sections)->with('ads',$ads);
        
    }

    public function storeStudent (Request $request)
    {   
        $number = User::where('num','=',$request->num)->first();
        if($number == null){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'num' => $request->num,
                'year' => $request->year,
                'section' => $request->section,
                'gender' => $request->gender,
                'role' => 'طالب',
            ]);
    
            $students = User::where('role','طالب')->get();
            return view('viewStudents')->with('students',$students);
        }
        return redirect()->back()->withErrors('');

        
    }

    public function storeEmployee (Request $request)
    {   
        $email = User::where('email','=',$request->email)->first();
        if($email == null){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'section' => $request->section,
                'gender' => $request->gender,
                'role' => 'موظف',
            ]);
    
            $employees = User::where('role','موظف')->get();
            return view('addEmployee');
        }
        return redirect()->back()->withErrors(['email'=>'البريد مستخدم في حساب أخر']);

        
    }

    public function storeAds(Request $request)
    {   
        $user=Auth::user();
        AD::create([
            'section' => $request->section,
            'description' => $request->description,
            'target'=>$request->target,
            'parent_section'=>$user->section!=null?$user->section:'حاسبات'
        ]);
        $sections =DB::table('sections')->get();
        $ads=AD::get();
        return view('addAds')->with('sections',$sections)->with('ads',$ads);
    }

    public function storeSubject (Request $request)
    {   
        $subject = Subject::where('name','=',$request->name)->where('section',Auth::user()->section)->first();
        
        if($subject == null){
            Subject::create([
                'name' => $request->name,
                'year' => $request->year,
                'semester' => $request->semester,
                'section' => Auth::user()->section
            ]);
    
            $subjects = Subject::orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
            return view('addSubject');
        }
        
       
       
        return redirect()->back()->withErrors('');
    }

    public function storeService (Request $request)
    {   

        $serv = Service::where('serviceName','=',$request->name)->first();
        if($serv==null){
            Service::create([
                'serviceName' => $request->name,
            ]);
    
            $services = Service::all();
            return view('viewServices')->with('services',$services);
        }
        return redirect()->back()->withErrors('هذه الخدمة موجوده مسبقا');
    }

    public function storeSection (Request $request)
    {   
        $sec = Section::where('SectionName','=',$request->name)->first();
        if($sec==null){
            Section::create([
                'sectionName' => $request->name,
            ]);
    
            $sections = Section::all();
            return view('viewSections')->with('sections',$sections);
        }

       
        return redirect()->back()->withErrors('القسم موجود مسبقا');
    }

    public function storeStudySection(Request $request){
        $sec = StudySection::where('name','=',$request->name)->first();
        if($sec==null){
            StudySection::create([
                'name' => $request->name,
            ]);
    
            $studySection = StudySection::all();
            return view('addStudySection');
        }
        return redirect()->back()->withErrors('القسم موجود مسبقا');
    }


    
    public function myMarks ()
    {   
        $subjects =Subject::get();
        return view('addMyMarks')->with('subjects',$subjects);
    }

    public function viewMyMarksOnly(){
        $marks = Mark::where('userId',Auth::user()->id)->where('result','ناجح')->orderBy('subjectId','ASC')->get();
        return view('viewMyMarkOnly')->with('marks',$marks);

    }

    public function viewMyMarks(){
        $marks = Mark::where('userId',Auth::user()->id)->orderBy('subjectId','ASC')->get();
        // $sections =DB::table('sections')->get();
        // $students =DB::table('users')->get();
        // $subjects =DB::table('subjects')->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        // $services =DB::table('services')->get();
        // $orders =DB::table('orders')->where('userID',Auth::user()->id)->get();
        // $ads =DB::table('a_d_s')->limit(10)->orderBy('id', 'DESC')->get();
        return view('viewMyMarks')->with('marks',$marks);
        
        
    }

    public function saveAddMark (Request $request)
    {   
        $getUserId = User::Select('id')->where('num',$request->num)->where('role','طالب')->first();
        $fullMark = $request->th + $request->pr;
        
        if($getUserId!=null){
            if($fullMark<=100){
                $subjectState = Mark::where('userId','=',$getUserId->id)->where('subjectId','=',$request->subject)->where('result','=','ناجح')->first(); 
                if($subjectState != null){
                    return  redirect()->back()->withErrors('الطالب بالفعل نجح في المقرر');
                }
                else{
                    if($fullMark >= 60){
                        Mark::create([
                            'userId'=>$getUserId->id,
                            'subjectId'=>$request->subject,
                            'th'=>$request->th,
                            'pr'=>$request->pr,
                            'year'=>$request->year,
                            'semester'=>$request->semester,
                            'result'=>'ناجح'
                        ]);
                        $subjects =DB::table('subjects')->get();
                        return view('addMyMarks')->with('subjects',$subjects);
                    }
                    Mark::create([
                        'userId'=>$getUserId->id,
                        'subjectId'=>$request->subject,
                        'th'=>$request->th,
                        'pr'=>$request->pr,
                        'year'=>$request->year,
                        'semester'=>$request->semester,
                        'result'=>'راسب'
                    ]);
                    $subjects =DB::table('subjects')->get();
                    return view('addMyMarks')->with('subjects',$subjects);
                }  
                return view('addMyMarks')->with('subjects',$subjects);
            }else{
                return  redirect()->back()->withErrors('هناك خطا في ادخال العلامات');
            }   
        }else{
            return  redirect()->back()->withErrors('الرقم الجامعي غير صالح');
        }
        
            
    } 
        // $ss = Mark::where('userId','=',$getUserId->id)->where('')->where('subjectId','=',$request->subject)->first();
        // if($ss==null){
        //     if($fullMark >= 60){
        //         Mark::create([
        //             'userId'=>$getUserId->id,
        //             'subjectId'=>$request->subject,
        //             'th'=>$request->th,
        //             'pr'=>$request->pr,
        //             'year'=>$request->year,
        //             'semester'=>$request->semester,
        //             'result'=>'ناجح'
        //         ]);
        //         $subjects =DB::table('subjects')->get();
        //         return view('addMyMarks')->with('subjects',$subjects);
        //     }
        //     Mark::create([
        //         'userId'=>$getUserId->id,
        //         'subjectId'=>$request->subject,
        //         'th'=>$request->th,
        //         'pr'=>$request->pr,
        //         'year'=>$request->year,
        //         'semester'=>$request->semester,
        //         'result'=>'راسب'
        //     ]);
        //     $subjects =DB::table('subjects')->get();
        //     return view('addMyMarks')->with('subjects',$subjects);
           
        // }
        // return redirect()->back()->withErrors('');
    
        
}
