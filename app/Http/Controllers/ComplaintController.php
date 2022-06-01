<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Http\Controllers\HomeController;
use Auth;

class ComplaintController extends Controller
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


    public function saveComplaint(Request $request){
        
        if($request->isShown){
            Complaint::create([
                'student_id' => Auth::user()->id,
                'content' => $request->content,
                'isShown' => 1,
                'section' => Auth::user()->section
            ]);
        }else{
            Complaint::create([
                'student_id' => Auth::user()->id,
                'content' => $request->content,
                'section' => Auth::user()->section
            ]);
        }

       return redirect()->back();
    }

    public function complaints(){
        $complaints = Complaint::where('section',Auth::user()->section)->paginate(5);
        if(Auth::user()->role == 'Admin' || Auth::user()->role == 'موظف' ){
            return view('complaintsView')->with('complaints',$complaints);
        }else{
           return (new HomeController)->dashboard();
        }
    }
}
