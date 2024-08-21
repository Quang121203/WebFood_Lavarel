<?php

namespace App\Business;

use App\Models\Product;

class ProductBusiness
{
    public static function getById($id)
    {
        return Product::find($id);
    }

    public static function getByCategotyId($category_id)
    {
        return Product::where("category_id","=",$category_id)->get();
    }

    public static function getList()
    {
        $returnVal = Product::orderBy("name", 'asc')->get();
        return $returnVal;
    }

    public static function getTopNumberBuy($number)
    {
        $returnVal = Product::orderBy("number_buy", 'desc')->take($number)->get();
        return $returnVal;
    }

    public static function buyProduct($id,$number)
    {
        $product = Product::find($id);
        $product['number_buy'] += $number;
        $product->save();
    }
}
