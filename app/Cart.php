<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = array('token', 'items', 'total', 'charge_total', 'codes_applied');
}
