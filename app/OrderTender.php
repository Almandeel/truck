<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTender extends Model
{
    protected $fillable = [
        'order_id', 'status','price', 'duration', 'description','company_id'
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
