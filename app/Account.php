<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public const ACCOUNT_SAFE  = 1;
    protected $fillable = ['name'];
}