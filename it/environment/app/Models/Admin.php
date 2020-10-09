<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {
	use Notifiable;
	protected $table    = 'admins';
	protected $fillable = [
		'email',
		'name',
		'photo_profile',
		'password',
		'group_id',
		'remember_token',
	];

	protected $hidden = ['password'];
}
