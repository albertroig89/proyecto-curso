<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profession_id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public static function findByEmail($email)
    {
        return static::where(compact('email'))->first();
    }
    
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    
    public function isAdmin()
    {
        return $this->is_admin;
    }
}
