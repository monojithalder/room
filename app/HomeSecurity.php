<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSecurity extends Model
{
    protected $table = 'home_security';
    public $timestamps = TRUE;
    protected $fillable = ['id','code','log'];
}
