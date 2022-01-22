<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayRole extends Model
{
    public function play()
    {
        return $this->belongsTo('App\Play')->withDefault();
    }

    public function job()
    {
        return $this->belongsTo('App\Job')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}
