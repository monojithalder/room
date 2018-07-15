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
class ComponentList extends Model
{
    public $timestamps = TRUE;
    protected $fillable = ['id','name','status'];

		public function ComponentList() {
			return $this->belongsTo('App\ComponentList');
    }
}
