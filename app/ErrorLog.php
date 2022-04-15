<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    public $timestamps = TRUE;
    protected $table = "error_logs";
    protected $fillable = ['id','log'];
}
