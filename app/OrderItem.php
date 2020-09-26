<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'unit_id', 'weight', 'quantity','type', 'company_id'
    ];
}
