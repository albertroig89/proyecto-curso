<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //protected $table = 'my_professions';
    
    //public $timestamps = false; NO GUARDARIA EL DIA I HORA QUE S'HA CREAT LA PROFESSIO
    
    protected $fillable = ['title'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
