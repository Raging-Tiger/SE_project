<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterType extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'meter_types';
    
    
    public function meter(){
        return $this->hasMany(Meter::class);
    }
}
