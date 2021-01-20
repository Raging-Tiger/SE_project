<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    use HasFactory;
    
    public function meterType(){
        return $this->belongsTo(MeterType::class);
    }
    
    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
