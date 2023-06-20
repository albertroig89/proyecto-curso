<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];
    public function skills()
    {
        return $this->hasMany(UserSkill::class);
    }
}
