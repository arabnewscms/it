<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Files extends Model {
	use SoftDeletes;
	protected $table = 'files';
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'admin_id',
		'user_id',
		'file',
		'full_path',
		'type_file',
		'type_id',
		'path',
		'ext',
		'name',
		'size',
		'size_bytes',
		'mimtype',
	];
}
