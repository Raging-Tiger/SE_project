<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'notification_types';
    
    
    public function notification(){
        return $this->hasMany(Notification::class);
    }
}
