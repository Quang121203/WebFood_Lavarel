<?php

namespace App\Http\Controllers;

use App\Business\CategoryBusiness;
use App\Business\ProductBusiness;

class MenuController extends Controller
{
    public function index()
    {
        $products = ProductBusiness::getList();
        foreach ($products as $product) {
            $product["category_name"] = (CategoryBusiness::getById($product["category_id"]))->name;
        }
        return view('pages.menu', ['products' => $products]);
    }
}
