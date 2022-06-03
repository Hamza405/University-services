<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mark;

class Subject extends Model
{
    use HasFactory;
    public function marks(){
        return $this->belongsTo(Mark::class);
    }


    protected $fillable = [
        'name',
        'year',
        'semester',
        'section'
    ];

}
