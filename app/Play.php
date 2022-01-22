<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    public function playRoles()
    {
        return $this->hasMany('App\PlayRole');
    }

    public function performances()
    {
        return $this->hasMany('App\Performance');
    }
}
