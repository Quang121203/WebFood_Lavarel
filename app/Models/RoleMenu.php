<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use SoftDeletes;
    protected $table = 'role_menu';

	protected $fillable = [
		'role_id',
		'menu_id',
	];
}
