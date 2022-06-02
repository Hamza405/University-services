<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyExam;
use App\Models\StudySection;
use Auth;

class ImageController extends Controller
{
    //Add image
    public function addStudyExam(){
        $section = (new StudySection)->getSectionByName(Auth::user()->section);
        $studyExam = StudyExam::where('section_id', $section->id)->first();
        return view('addStudyExam', compact('studyExam'));
    }
    //Store image
    public function storeStudyExam(Request $request){
        $section = (new StudySection)->getSectionByName(Auth::user()->section);

        $item = StudyExam::where('section_id', $section->id)->first();
        if($item!=null){
            $item->delete();    
        }
        $data = new StudyExam();
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image/StudyExam'), $filename);
            $data['image']= $filename;
        }   
        $data['section_id']= $section->id;
        $data->save();

        $studyExam = StudyExam::where('section_id', $section->id)->first();
        return view('addStudyExam', compact('studyExam'));
    }
		//View image
    public function viewStudyExam(){
        $section = (new StudySection)->getSectionByName(Auth::user()->section);
        $studyExam = StudyExam::where('section_id', $section->id)->first();
        return view('viewStudyExam', compact('studyExam'));
    }
}
