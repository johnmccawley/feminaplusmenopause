<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = array('user_id', 'token', 'customer_info', 'purchase_status', 'items', 'amount', 'payment_processor', 'transaction_id');
}
