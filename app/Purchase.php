<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = array('user_id', 'items', 'amount', 'stripe_transaction_id');
}
