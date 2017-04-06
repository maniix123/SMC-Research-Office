<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notify extends Model
{
	protected $table = 'notifications';
	protected $fillable = ['action', 'URL'];
}
