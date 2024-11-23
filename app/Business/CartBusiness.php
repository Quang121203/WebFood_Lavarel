<?php

namespace App\Business;

use Auth;
use App\Models\Cart;

class CartBusiness
{
    public static function getByUserId($userId)
    {
        return Cart::where("user_id", "=", $userId)->get();
    }
    public static function getByProductId($productId)
    {
        return Cart::where("product_id", "=", $productId)->get();
    }
    public static function getById($userId, $productId)
    {
        return Cart::where('user_id', '=', $userId)
            ->where('product_id', '=', $productId)
            ->first();
    }
    public static function create($aInput)
    {
        $product_id = $aInput["product_id"];
        $quanlity = $aInput["quanlity"];
        $user_id = Auth::user()->id;
        $aInput['user_id'] = $user_id;
        $product = ProductBusiness::getById($product_id);

        if (!$quanlity) {
            return ['success' => false, 'message' => 'Quanlity is 0'];
        }

        if($quanlity> $product->store){
            return ['success' => false, 'message' => 'The quantity entered exceeds available stock. Please adjust your order'];
        }

        if (!$product) {
            return ['success' => false, 'message' => 'Product not found!'];
        }

        $cart = self::getById($user_id, $product_id);

        if (!$cart) {
            $cart = new Cart();
            $cart->fill($aInput);
        } else {
            if($cart->quanlity>= $product->store){
                return ['success' => false, 'message' => 'The quantity entered exceeds available stock. Please adjust your order'];
            }
            $cart->quanlity += $quanlity;
        }
        $cart->save();

        $carts = self::getByUserId($user_id);
        $totalNumber = 0;
        foreach ($carts as $item) {
            $totalNumber += $item['quanlity'];
        }
        return ['success' => true, 'message' => 'Cart updated', 'cartCount' => $totalNumber];
    }

    public static function delete($id)
    {
        $cart = Cart::where("id", "=", $id)->first();
        if (!isset($cart)) {
            return ["success" => false, "msg" => "Cart does not exist!"];
        }
        $cart->delete();
        return ["success" => true, "msg" => "Deleted successfully"];
    }
}