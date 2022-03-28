<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Mark;
use App\Models\Service;
use App\Models\Subject;
use App\Models\Order;
use Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public function marks(){
        return $this->belongsTo(Mark::class);
    }

    public function getServiceName($id){
        return Service::where('id',$id)->first();
    }

    public function getSubjecteName($id){ 
        return Subject::where('id',$id)->first();
    }

    

    public function getStdName($id){
        return User::where('id',$id)->first();
    }

    public function checkSubject($uid,$sId){
        return Reorder::where(
           [
            ['userID',$uid],['subjectID',$sId]
           ]
        )->first();
    }

    public function check($uid,$sId){
        return Order::where([
            ['userID',$uid],['serviceID',$sId]
        ])->first();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'num',
        'section',
        'year',
        'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
