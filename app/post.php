<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
	protected $table = 'posts';
	// protected $appends = ['if_logged_in'];
	protected $fillable = [
	'name',
	'authors',
	'abstract',
	'school_year',
	'tab',
	'type',
	'image'
	];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function postRemarks()
	{
		return $this->hasMany('App\Remarks');
	}
	// public function getIfLoggedInAttribute()
	// {
	// 	return (Auth::check()) ? true : false;
	// }
}
