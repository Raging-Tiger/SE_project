<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    
    public function meter(){
        return $this->hasMany(Meter::class);
    }
    
    public function bill(){
        return $this->hasMany(Bill::class);
    }
    
    public function appinh()
    {
        return $this->hasMany(ApartmentInhabitant::class);
    }
}
