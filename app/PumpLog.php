<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PumpLog extends Model
{
    public $timestamps = FALSE;
    protected $table = "pump_log";
    protected $fillable = ['id','status','log_time'];
}
