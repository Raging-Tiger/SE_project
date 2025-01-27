<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    public function language(){
        return $this->belongsTo(Language::class);
    }
    
    public function notificationType(){
        return $this->belongsTo(NotificationType::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
