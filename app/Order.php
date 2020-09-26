<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const ORDER_DEFAULT      = 0;
    public const ORDER_ACCEPTED     = 1;
    public const ORDER_In_SHIPPING  = 2;
    public const ORDER_In_ROAD      = 3;
    public const ORDER_DONE         = 4;
    public const ORDER_CANCEL       = 5;

    public const status = [
        self::ORDER_DEFAULT     => 'order default',
        self::ORDER_ACCEPTED    => 'order accepted',
        self::ORDER_In_SHIPPING => 'order in shipping',
        self::ORDER_In_ROAD     => 'order in road',
        self::ORDER_DONE        => 'order done',
        self::ORDER_CANCEL      => 'order cancel',
    ];

    protected $fillable = [
        'name', 'phone', 'type', 'status','accepted_at', 'received_at', 'from', 'to', 'company_id',
        'user_add_id', 'user_accepted_id'
    ];


    public function items() {
        return $this->hasMany('App\OrderItem');
    }

}
