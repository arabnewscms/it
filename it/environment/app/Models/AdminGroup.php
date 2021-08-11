<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.5.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.5.0 | https://it.phpanonymous.com]
class AdminGroup extends Model {

	protected $table = 'admin_groups';
	protected $fillable = [
		'id',
		'admin_id',
		'group_name',
		'created_at',
		'updated_at',
	];

	public function admin_id() {
		return $this->hasOne(\App\Models\Admin::class, 'id', 'admin_id');
	}

	public function role() {
		return $this->hasMany(\App\Models\AdminGroupRole::class, 'admin_groups_id', 'id');
	}

}
