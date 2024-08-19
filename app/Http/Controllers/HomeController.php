<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\CategoryBusiness;
use App\Business\ProductBusiness;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CategoryBusiness::getList();
        $products =ProductBusiness::getTopNumberBuy(6);
        foreach($products as $product) {
            $product["category_name"] = (CategoryBusiness::getById( $product["category_id"]))->name;
        }
        return view('pages.home',['categories'=>$categories,'products'=>$products]);
    }
}
