<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;
    
    
    public function fineReason(){
        return $this->belongsTo(FineReason::class);
    }
    
    public function fineStatus(){
        return $this->belongsTo(FineStatus::class);
    }
    
    public function inhabitant(){
        return $this->belongsTo(Inhabitant::class);
    }
}
