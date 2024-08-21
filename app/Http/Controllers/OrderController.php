<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\OrderBusiness;
use App\Business\OrderDetailBusiness;
use App\Business\ProductBusiness;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = [];
        if (session('orders')) {
            foreach (session('orders') as $id) {
                $order = OrderBusiness::getById($id);
                $orderDetails = OrderDetailBusiness::getByOrderId($id);
                $product = [];
                foreach ($orderDetails as $orderDetail) {
                    $productName = (ProductBusiness::getById($orderDetail->product_id))->name;
                    $product[] = ["name" => $productName, "quantity" => $orderDetail->quantity];
                }
                $order->product = $product;
                $orders[] = $order;
            }
            usort($orders, function ($a, $b) {
                return $b['created_at'] <=> $a['created_at'];
            });
        }
        return view('pages.order', ["orders" => $orders]);
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
            $cart = session('cart', []);
            foreach ($cart as $item) {
                $data = [
                    "order_id" => $order["id"],
                    "product_id" => $item["id"],
                    "quantity" => $item["number"],
                    "created_at" => $item["price"]
                ];
                OrderDetailBusiness::create($data);
                ProductBusiness::buyProduct($item["id"], $item["number"]);
                unset($cart[$item["id"]]);
                session()->put('cart', $cart);
            }

            $orders = session()->get('orders', []);
            $orders[] = $order["id"];
            session()->put('orders', $orders);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
