<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentInhabitant extends Model
{
    use HasFactory;
    protected $table = 'apartment_inhabitants';
    public $timestamps = false;
    
    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }  
    
    public function inhabitants() {
        return $this->belongsTo(Inhabitant::class);
    }
}
