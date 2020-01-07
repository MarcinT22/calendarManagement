<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=[
        'title',
        'description',
        'start',
        'end',
        'backgroundColor',
        'calendar_id'

    ];
}
