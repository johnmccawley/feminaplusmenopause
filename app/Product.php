<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = array('id', 'name', 'sku', 'price', 'per_bottle', 'shipping', 'subscription');
}
