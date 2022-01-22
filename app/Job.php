<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function playRoles()
    {
        return $this->hasMany('App\PlayRole');
    }
}
