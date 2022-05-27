<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AD extends Model
{
    use HasFactory;
    
    public function ad(){
        return $this->belongsTo(AD::class);
    } 
    protected $fillable = [
        'section',
        'description',
        'target',
        'parent_section'
    ];

}
