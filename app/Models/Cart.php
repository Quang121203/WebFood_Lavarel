<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use SoftDeletes;
    protected $table = 'cart';

	protected $fillable = [
		'user_id',
		'product_id',
        'quanlity'
	];
}
