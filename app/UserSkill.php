<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSkill extends Model
{
    use SoftDeletes;

    protected $table = 'user_skill';

    protected $guarded = [];
}
