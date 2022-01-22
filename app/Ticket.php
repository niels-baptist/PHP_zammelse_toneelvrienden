<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function reservation()
    {
        return $this->belongsTo('App\Reservation')->withDefault();
    }

    public function chair()
    {
        return $this->belongsTo('App\Chair')->withDefault();
    }

    public function performance()
    {
        return $this->belongsTo('App\Performance')->withDefault();
    }
}
