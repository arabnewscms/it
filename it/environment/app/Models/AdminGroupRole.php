<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminGroupRole extends Model {
	protected $table = 'admin_group_roles';
	protected $fillable = [
		'id',
		'name',
		'show',
		'add',
		'edit',
		'delete',
		'admin_groups_id',
	];

	public function admin_groups_id() {
		return $this->hasMany(\App\Models\AdminGroup::class, 'id', 'admin_groups_id');
	}
}
