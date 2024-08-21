<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use SoftDeletes;
    protected $table = 'order_details';

	protected $fillable = [
		'order_id',
		'product_id',
        'quantity',
        'price'
	];
}
