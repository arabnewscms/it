<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;
// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [Mahmoud Ibrahim php.anonymous@gmail.com]
// Copyright Reserved  [Mahmoud Ibrahim php.anonymous@gmail.com]

class Department extends Model {
	//use SoftDeletes;
	protected $table = 'departments';
	// protected $dates = ['deleted_at'];
	protected $fillable = [
		'id',
		'admin_id',
		'name_ar',
		'name_en',
		'name_fr',
		'icon',
		'parent',
		'color',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function user_id() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}

}
