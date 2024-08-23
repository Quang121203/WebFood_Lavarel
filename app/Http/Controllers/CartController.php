<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\ProductBusiness;
use App\Business\CategoryBusiness;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.home.cart');
    }

    public function store(Request $request)
    {
        $aInput = $request->all();
        $product_id = $aInput["product_id"];
        $number = $aInput["number"];
        $product = ProductBusiness::getById($product_id);

        if (!$product) {
            return ['success' => false, 'message' => 'Product not found!'];
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])) {
            $cart[$product_id]['number'] += $number;
            $cart[$product_id]['total'] = $cart[$product_id]['price'] * $cart[$product_id]['number'];
        } else {
            $category_name = (CategoryBusiness::getById($product->category_id))->name;
            $cart[$product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img,
                'category_name' => $category_name,
                'number' => $number,
                'total' => $product->price * $number
            ];
        }
        session()->put('cart', $cart);

        $totalNumber = 0;
        foreach ($cart as $item) {
            $totalNumber += $item['number'];
        }
        return ['success' => true, 'message' => 'Cart updated', 'cartCount' => $totalNumber];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $number = $data["number"];
        $price = $data["price"];

        $cart = session()->get('cart', []);
        $cart[$id]['number'] = $number;
        $cart[$id]['total'] = $price * $number;
        session()->put('cart', $cart);

        $totalNumber = 0;
        $total = 0;
        foreach ($cart as $item) {
            $totalNumber += $item['number'];
            $total += $item['total'];
        }
        return ['cartCount' => $totalNumber, 'total' => $total];
    }

    public function destroy(Request $request, $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        $totalNumber = 0;
        $total = 0;
        foreach ($cart as $item) {
            $totalNumber += $item['number'];
            $total += $item['total'];
        }
        return ['messenger' => 'Product successfully deleted.', 'cartCount' => $totalNumber, 'total' => $total];
    }
}
