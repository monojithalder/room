<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pump extends Model
{
    public $timestamps = FALSE;
    protected $table = "pump";
    protected $fillable = ['id','ip','status'];
}
