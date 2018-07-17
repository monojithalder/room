<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property array|string name
 * @property array|string status
 */
class Resistor extends Model
{
		protected $table = 'resistor';
    public $timestamps = TRUE;
    protected $fillable = ['id','value','color_code','stock'];
}
