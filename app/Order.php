<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const ORDER_DEFAULT      = 0;
    public const ORDER_ACCEPTED     = 1;
    public const ORDER_IN_SHIPPING  = 2;
    public const ORDER_IN_ROAD      = 3;
    public const ORDER_DONE         = 4;
    public const ORDER_CANCEL       = 5;

    public const status = [
        self::ORDER_DEFAULT     => 'order default',
        self::ORDER_ACCEPTED    => 'order accepted',
        self::ORDER_IN_SHIPPING => 'order in shipping',
        self::ORDER_IN_ROAD     => 'order in road',
        self::ORDER_DONE        => 'order done',
        self::ORDER_CANCEL      => 'order cancel',
    ];

    protected $fillable = [
        'name', 'phone', 'type', 'status','accepted_at', 'received_at', 'from', 'to', 'company_id',
        'user_add_id', 'user_accepted_id', 'delivered_at', 'shipping_date', 'savior_name', 'savior_phone'
    ];


    public function items() {
        return $this->hasMany('App\OrderItem');
    }

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function tenders() {
        return $this->hasMany('App\OrderTender');
    }



}
