<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
