<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    //public $timestamps = false; NO GUARDARIA EL DIA I HORA QUE S'HA CREAT LA PROFESSIO

    use SoftDeletes;

    protected $fillable = ['title'];
    
    public function profiles()
    {
        return $this->hasMany(UserProfile::class);
    }
}
