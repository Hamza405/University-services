<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Subject;

class Mark extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    } 

    protected $fillable = [
        'userId',
        'subjectId',
        'th',
        'pr',
        'result',
        'year',
        'semester',
    ];

}
