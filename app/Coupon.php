<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = array('code', 'discount_amount', 'discount_type');
}
