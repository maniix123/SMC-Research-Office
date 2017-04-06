<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
	public function post()
	{
		return $this->belongsTo('App\post');
	}
}
