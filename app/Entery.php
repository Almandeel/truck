<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entery extends Model
{        
    public const TYPE_PAYMENT  = 1;
    public const TYPE_INCOME   = 2;
    
    protected $fillable = ['id', 'amount', 'from_id', 'type', 'to_id', 'details', 'user_id'];
    
    public function from(){
        return $this->belongsTo('App\Account', 'from_id');
    }
    
    public function to(){
        return $this->belongsTo('App\Account', 'to_id');
    }
    
    public function payment(){
        return $this->hasOne('App\Payment', 'entry_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    // public static function newPayment($data){
    //     return self::newEntry($data, ENTRY::TYPE_PAYMENT);
    // }

    // public static function newEntry($data, $type = ENTRY::TYPE_PAYMENT){
    //     $data['type'] = ENTRY::TYPE_PAYMENT;
    //     return self::create($data);
    // }

    // public static function create(array $attributes = [])
    // {
    //     $attributes['user_id'] = auth()->user()->id;
    //     if(!array_key_exists('type', $attributes)){
    //         $attributes['type'] = self::TYPE_JOURNAL;
    //     }
    //     $model = static::query()->create($attributes);
    //     return $model;
    // }
}
