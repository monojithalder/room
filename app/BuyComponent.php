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
class BuyComponent extends Model
{
    public $timestamps = TRUE;
		protected $fillable = ['id','name','quantity','list_id','image'];

		public function components() {
			return $this->hasMany('App\BuyComponent','list_id','id');
    }
}
