<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    public function hall()
    {
        return $this->belongsTo('App\Hall')->withDefault();
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
