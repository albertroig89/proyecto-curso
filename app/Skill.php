<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];
    public function skills()
    {
        return $this->hasMany(UserSkill::class);
    }
}
