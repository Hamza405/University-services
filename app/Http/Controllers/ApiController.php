<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Response;
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
use App\Models\Reorder;
use App\Models\ProImage;
use App\Models\Complaint;
use App\Models\StudyExam;
use App\Models\StudyProgram;
use App\Models\StudySection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;
use PDF;

class ApiController extends Controller
{
   public function a(){
       $section = Section::all();
        return response()->json([
            $section]);
    }

    public function signup(Request $request){
        $valid = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:7',
            'num' => 'required|string|max:5|unique:users',
        ]);
        
        
        if($valid->fails()){
            return  response()->json([
                'error' => $valid->errors()->first(),
                'status' => Response::HTTP_BAD_REQUEST,
            ]);
        }       
            
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'num' => $request['num'],
            'year' => $request['year'],
            'section' => $request['section'],
            'gender' => $request['gender'],
            'role' => 'طالب',
            ]);
            
        if($user){
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
                'status'=> Response::HTTP_OK
            ]);
        }
        
        return response()->json([
            'error' => 'Some thing went wrong!',
            'status' => 500,
        ]);
       
      
    }

    public function login(Request $request){
        $valid = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:7',
        ]);

        if($valid->fails()){
            return  response()->json([
                'error' => $valid->errors()->first(),
                'status' => Response::HTTP_BAD_REQUEST,
            ]);
        }
        

        $user = User::where('email', $request['email'])->first();
       
        
        if(!$user){
            return response()->json([
                'error' => 'User not found',
                'status' => Response::HTTP_NOT_FOUND,
            ]);
        }

        if($user->role=='موظف'){
            return response()->json([
                'error' => 'You are not allowed to login',
                'status' => Response::HTTP_NOT_FOUND,
            ]);
        }
        
        $password = Hash::check($request['password'], $user->password);

        if(!$password){
            return response()->json([
                'error' => 'Password is incorrect',
                'status' => Response::HTTP_NOT_FOUND,
            ]);
        }

        if($user && $password){
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
                'status'=> Response::HTTP_OK
            ]);
        }

        return response()->json([
            'error' => 'Some thing went wrong!',
            'status' => 500,
        ]);
    }

    public function getUser(){
        $user = Auth::user();
        if($user){
            return response()->json([
                'user' => $user,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

   public function getAds(){
       $userYear = Auth::user()->year;
       $ads = DB::table('a_d_s')
       ->where('parent_section',Auth::user()->section)
       ->where('target', 0)
       ->orWhere('target', $userYear)
       ->orderBy('id', 'DESC')->get();
       if($ads){
        return response()->json([
            'ads' => $ads,
            'status' => 200
        ]);
       }
       return response()->json([
        'error' => 'Some thing wrong!',
        'status' => 404
    ]);
   }

   public function getServices(){
         $services = Service::all();
         if($services){
          return response()->json([
                'services' => $services,
                'status' => 200
          ]);
         }
         return response()->json([
          'error' => 'Some thing wrong!',
          'status' => 404
     ]);
   }

   public function addOrder(Request $request){
    $currentDateTime = Carbon::now();
    $newDateTime = Carbon::now()->addDay(30);
    $o = Order::where('userID',Auth::user()->id)->where('serviceID',$request['serviceId'])->first();
    if($o){
        return response()->json([
            'error' => 'You have already ordered this service',
            'status' => 404
        ]);
    }
   $order =Order::create([
        'userID' => Auth::user()->id,
        'serviceID' => $request['serviceId'],
        'state' => 0,
        'section'=> Auth::user()->section,
        'deadline'=> $newDateTime
    ]);

    if($order){
        return response()->json([
            'order' => $order,
            'status' => 200
        ]);
    }
    return response()->json([
        'error' => 'Some thing wrong!',
        'status' => 500
   ]);
   }

   public function getOrders(){
    $orders = Order::where('userID', Auth::user()->id)->get();
    if($orders){
        return response()->json([
            'myOrder' => $orders,
            'status' => 200
        ]);
    }
    return response()->json([
        'error' => 'Some thing wrong!',
        'status' => 404
   ]);
   }

   public function getMarks(){
    $data = Mark::where('userId',Auth::user()->id)->get();
        if($data){
            return response()->json([
                'marks' => $data,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

    public function getSubjects(){
        
        $data = Subject::where('section',Auth::user()->section)->orderBy('year', 'ASC')->orderBy('semester', 'ASC')->get();
        if($data){
            return response()->json([
                'subjects' => $data,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

    public function getMarksOnly(){
    $data = Mark::where('userID',Auth::user()->id)->where('result','ناجح')->orderBy('subjectId','ASC')->get();
        if($data){
            return response()->json([
                'marks' => $data,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

    public function getStudyProgram(){
        $section = (new StudySection)->getSectionByName(Auth::user()->section);
        $studyProgram = DB::table('study_program')->where('section_id','=',$section->id)->get();
        if($studyProgram){
            return response()->json([
                'studyProgram' => $studyProgram,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

    public function reOrder(Request $request){
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addDay(30);

        $validate = Reorder::where('userID', Auth::user()->id)->where('subjectID', $request->subject)->first();

        $validateSuccessInSubject = Mark::where('userId', Auth::user()->id)->where('subjectId', $request->subject)->where('result','ناجح')->first();

        if( $validateSuccessInSubject){
            return response()->json([
                'error' => 'You already success in this subject',
                'status' => 404
            ]);
        }

        if($validate){
            return response()->json([
                'error' => 'The order already exists',
                'status' => 404
            ]);
        }

        $order =Reorder::create([
            'userID' => Auth::user()->id,
            'section'=> Auth::user()->section,
            'subjectID' => $request->subject,
            'deadline' => $newDateTime
        ]);

        if($order){
            return response()->json([
                // 'order' => $order,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

    public function pullReOrder(Request $request){
        Reorder::where([
            'userID' => Auth::user()->id,
            'subjectID' => $request->subject,
        ])->delete();
        return response()->json([
            'status' => 200
        ]);
    }

    public function getReOrder (){
        $reorders = Reorder::where('userID', Auth::user()->id)->get();
        if($reorders){
            return response()->json([
                'reorders' => $reorders,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

    public function saveComplaint(Request $request){
        $res = Complaint::create([
            'student_id' => Auth::user()->id,
            'content' => $request->content,
            'section'=> Auth::user()->section,
            'isShown' => $request->isShow?1:0,
        ]);
        if($res){
            return response()->json([
                'status' => 200
            ]);
        }
        return response()->json([
            'status' => 404,
            'error' => 'Some thing wrong!, Try again'
        ]);
    }

    public function getExam(){
        $section = (new StudySection)->getSectionByName(Auth::user()->section);
        $exam = StudyExam::where('section_id',$section->id)->first();
        if($exam){
            return response()->json([
                'exam' => $exam,
                'status' => 200
            ]);
        }
        return response()->json([
            'error' => 'Some thing wrong!',
            'status' => 404
        ]);
    }

// public function getMarks(){
//     $data = Mark::where('userID',Auth::user()->id)->where('result','ناجح')->orderBy('subjectId','ASC')->get();
//     view()->share('marks',$data);
//     $pdf = PDF::loadView('pdfMyMarkOnlyTable', $data);
//     return response()->$pdf->download('marks.pdf');
//     // return $pdf->download('marks.pdf');
   
  
  
//     // return Excel::download(new IExport(), 'ad.pdf');

//     // return Excel::download(Mark::get(), 'invoices.xlsx');
// }

   
}
