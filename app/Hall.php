<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    public function plays()
    {
        return $this->hasMany('App\Play');
    }

    public function chairs()
    {
        return $this->hasMany('App\Chair');
    }
}
