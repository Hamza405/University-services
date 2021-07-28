<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Sersec;

class Section extends Model
{
    use HasFactory;

    public function sersecs(){
        return $this->belongsTo(Sersec::class);
    } 
    protected $fillable = [
        'sectionName',
    ];
}
