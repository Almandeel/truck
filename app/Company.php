<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'phone', 'address', 'account_id',
    ];

    public function user() {
        return $this->hasOne('App\User');
    }
}
