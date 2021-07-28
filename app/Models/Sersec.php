<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Service;

class Sersec extends Model 
{
    use HasFactory;

    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

}
