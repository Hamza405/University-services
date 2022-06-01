<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudySection extends Model
{
    use HasFactory;
    public function getSectionByName($name){
        return StudySection::where('name',$name)->first();
    }
    public function getSectionById($id){
        return StudySection::where('id',$id)->first();
    }
    protected $fillable = [
        'name',
    ];
}
