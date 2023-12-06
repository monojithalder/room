<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreePumpSettings extends Model
{
    protected $table = 'tree_pump_settings';
    public $timestamps = TRUE;
    protected $fillable = ['id','time1','time2','interval','ip_address'];
}
