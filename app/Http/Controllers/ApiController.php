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
use Illuminate\Support\Facades\Hash;

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
            'status' => Response::HTTP_NOT_FOUND,
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
            'status' => Response::HTTP_NOT_FOUND,
        ]);
    }
}
