<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreePumpStatus extends Model
{
    protected $table = 'tree_pump_status';
    public $timestamps = TRUE;
    protected $fillable = ['id','status','last_status_time'];
}
