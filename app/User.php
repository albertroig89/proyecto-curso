<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        //
    ];

    public static function findByEmail($email)
    {
        return static::where(compact('email'))->first();
    }
    
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class)->withDefault();
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
