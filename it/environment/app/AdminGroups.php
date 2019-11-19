<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGroups extends Model
{
    protected $table    = 'admin_groups';
    protected $fillable = [
        'id',
        'name',
    ];
}
