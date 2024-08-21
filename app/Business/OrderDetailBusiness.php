<?php

namespace App\Business;
use App\Models\OrderDetails;

class OrderDetailBusiness
{
    public static function getByOrderId($order_id)
    {
        $orderDetails = OrderDetails::where('order_id', '=', $order_id)->get();
        return $orderDetails;
    }
    public static function create($data)
    {
        $orderDetail = new OrderDetails();
        $orderDetail->fill($data);
        $orderDetail->save();
    }
}