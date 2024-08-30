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

    public static function checkProductInOrder($product_id)
    {
        $orderDetails = OrderDetails::where("product_id", "=", $product_id)->get();
        foreach ($orderDetails as $orderDetail) {
            $order = OrderBusiness::getById($orderDetail['order_id']);
            if ($order['status'] != 0 && $order['status'] != 3) {
                return true;
            }
        }
        return false;
    }
}