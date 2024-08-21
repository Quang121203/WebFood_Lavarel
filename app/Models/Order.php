<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';

	protected $fillable = [
		'name',
		'phone',
        'email',
        'address',
        'total',
        'status'
	];
}
