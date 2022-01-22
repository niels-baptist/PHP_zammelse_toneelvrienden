<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function performance()
    {
        return $this->belongsTo('App\Performance');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
