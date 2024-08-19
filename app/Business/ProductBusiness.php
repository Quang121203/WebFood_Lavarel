<?php

namespace App\Business;

use App\Models\Product;

class ProductBusiness
{
    public static function getById($id)
    {
        return Product::find($id);
    }
    public static function getList()
    {    
        $returnVal = Product::orderBy("name",'asc')->get();         
        return $returnVal;
    }

    public static function getTopNumberBuy($number)
    {    
        $returnVal = Product::orderBy("number_buy",'desc')->take($number)->get();         
        return $returnVal;
    }
}
