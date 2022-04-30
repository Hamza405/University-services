<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
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
            ]);
        }else{
            Complaint::create([
                'student_id' => Auth::user()->id,
                'content' => $request->content
            ]);
        }

       return redirect()->back();
    }

    public function complaints(){
        $complaints = Complaint::get();
        return view('complaintsView')->with('complaints',$complaints);
    }
}
