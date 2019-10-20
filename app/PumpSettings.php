<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PumpSettings extends Model
{
    public $timestamps = FALSE;
    protected $table = "pump_settings";
    protected $fillable = ['id','tank_high_value','tank_low_value'];
}
