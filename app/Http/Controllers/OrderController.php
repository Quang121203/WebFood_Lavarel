<?php

namespace App\Http\Controllers;

use Auth;
use App\Business\CartBusiness;
use Illuminate\Http\Request;
use App\Business\OrderBusiness;
use App\Business\OrderDetailBusiness;
use App\Business\ProductBusiness;

class OrderController extends Controller
{
    public function getList($status)
    {
        return OrderBusiness::getList($status);
    }
    /**
     * Display a listing of the resource.
     */
    public function indexHome()
    {
        $orders = OrderBusiness::getByUserId(Auth::user()->id);
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $orderDetails = OrderDetailBusiness::getByOrderId($order['id']);
                $product = [];
                foreach ($orderDetails as $orderDetail) {
                    $productName = (ProductBusiness::getById($orderDetail->product_id))->name;
                    $product[] = ["name" => $productName, "quanlity" => $orderDetail->quanlity];
                }
                $order->product = $product;
            }
        }
        return view('pages.home.order', ["orders" => $orders]);
    }

    public function index()
    {
        return view('pages.admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $aInput = $request->all();
        $order = OrderBusiness::create($aInput);

        if ($order['success']) {
            $cart = CartBusiness::getByUserId(Auth::user()->id);
            foreach ($cart as $item) {
                $data = [
                    "order_id" => $order["id"],
                    "product_id" => $item["product_id"],
                    "quanlity" => $item["quanlity"],
                ];
                OrderDetailBusiness::create($data);
                ProductBusiness::buyProduct($item["product_id"], $item["quanlity"]);
                CartBusiness::delete($item['id']);
            }
            return ['success' => true];
        }
        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = OrderBusiness::getByID($id);
        $order_detail = OrderDetailBusiness::getByOrderId($id);
        foreach ($order_detail as $data) {
            $product = ProductBusiness::getById($data['product_id']);
            $data->product_name = $product['name'];
            $data->price = $product['price'];
            $data->total = $product['price'] * $data['quanlity'];
        }
        return ["detail" => $order_detail, "order" => $order];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return OrderBusiness::update($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return OrderBusiness::cancel($id);
    }
}
