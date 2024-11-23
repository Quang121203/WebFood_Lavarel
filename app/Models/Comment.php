<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comments';

	protected $fillable = [
		'user_id',
		'rate',
        'content',
		'product_id'
	];
}
