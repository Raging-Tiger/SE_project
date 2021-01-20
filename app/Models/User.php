<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function role(){
        return $this->belongsTo(Role::class);
    }
    
    public function notification(){
        return $this->hasMany(Notification::class);
    }
    
    public function inhabitant(){
        return $this->hasOne(Inhabitant::class);
    }
    
    
    public function isAdmin() 
    {
        return ($this->role_id == 1);
    } 
    
    public function isUser() 
    {
        return ($this->role_id == 2);
    }
    
    public function isInhabitant() 
    {
        return ($this->role_id == 3);
    }
    
    
    public function isPrivileged() 
    {
        return ($this->role_id == 4);
    }
    
    
    public function isBlocked() 
    {
        return ($this->role_id == 5);
    }

    
   public function isTenant() 
   {
      return ($this->role_id == 3 || $this->role_id == 4);
   } 
   
   public function areNotifAllowed()
   {
       return ($this->role_id == 1 || $this->role_id == 4);
   }

}
