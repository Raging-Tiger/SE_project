<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'bill_statuses';
    
     public function bill(){
        return $this->hasMany(Bill::class);
    }
}
