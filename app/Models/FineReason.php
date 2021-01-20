<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FineReason extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'fine_reasons';
    
    public function fine(){
        return $this->hasMany(Fine::class);
    }
}
