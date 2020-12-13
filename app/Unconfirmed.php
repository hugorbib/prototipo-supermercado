<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unconfirmed extends Model
{
    protected $fillable = [
        'name', 'lastname', 'email', 'phone', 'latitude','length', 'img','ref', 'description','code'
    ];
}
