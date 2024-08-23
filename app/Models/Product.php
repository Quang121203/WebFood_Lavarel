<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

	protected $fillable = [
		'category_id',
		'number_buy',
        'name',
        'price',
        'img',
        'content'
	];
}
