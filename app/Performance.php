<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    public function hall()
    {
        return $this->belongsTo('App\Hall')->withDefault();
    }

    public function play()
    {
        return $this->belongsTo('App\Play')->withDefault();
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function reservations() {
        return $this->hasMany('App\Reservation');
    }
}
