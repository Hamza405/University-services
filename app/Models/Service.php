<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Sersec;

class Service extends Model
{
    use HasFactory;

    public function sersecs(){
        return $this->belongsTo(Sersec::class);
    }

    protected $fillable = [
        'serviceName',
    ];

}
