<?php

namespace App\Http\Controllers;

use App\Business\ProductBusiness;
use Illuminate\Http\Request;
use App\Business\CartBusiness;
use Auth;

class CartController extends Controller
{
    public function getCount()
    {
        if (!Auth::check()) {
            return 0;
        }
        $carts = CartBusiness::getByUserId(Auth::user()->id);
        $totalNumber = 0;
        $totalPrice = 0;
        foreach ($carts as $item) {
            $totalNumber += $item['quanlity'];
            $product = ProductBusiness::getById($item['product_id']);
            $totalPrice += ($product['price'] * $item['quanlity']);
        }
        return ["totalNumber" => $totalNumber, "totalPrice" => $totalPrice];
    }
    public function index()
    {
        $cart = CartBusiness::getByUserId(Auth::user()->id);
        foreach ($cart as $item) {
            $product = ProductBusiness::getById($item->product_id);
            $item['product'] = $product;
            $item['price'] = $product['price'] * $item['quanlity'];
        }
        return view('pages.home.cart', ["cart" => $cart]);
    }

    public function checkout()
    {
        $cart = CartBusiness::getByUserId(Auth::user()->id);
        foreach ($cart as $item) {
            $product = ProductBusiness::getById($item->product_id);
            $item['product'] = $product;
            $item['price'] = $product['price'] * $item['quanlity'];
        }
        return view('pages.home.check-out', ["cart" => $cart]);
    }

    public function store(Request $request)
    {
        $aInput = $request->all();
        return CartBusiness::create($aInput);
    }

    public function update(Request $request, $product_id)
    {
        $data = $request->all();
        $quanlity = $data["quanlity"];

        $cart = CartBusiness::getById(Auth::user()->id, $product_id);        

        $total = self::getCount();
        $product = ProductBusiness::getById($product_id);

        if($quanlity> $product->store){
            return ['success' => false, 'message' => 'The quantity entered exceeds available stock. Please adjust your order'];
        }

        $cart->quanlity = $quanlity;
        $cart->save();
        $price = $product['price'] * $quanlity;

        return ['success' => true,'total' => $total, 'price' => $price];
    }

    public function destroy($id)
    {
        $delete = CartBusiness::delete($id);
        $total = self::getCount();
        $delete['total'] = $total;
        return $delete;
    }
}
