<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inhabitant extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function phone(){
        return $this->hasMany(Phone::class);
    }
    
    public function fine(){
        return $this->hasMany(Fine::class);
    }
    
    public function appinh()
    {
        return $this->hasMany(ApartmentInhabitant::class);
    }
}
