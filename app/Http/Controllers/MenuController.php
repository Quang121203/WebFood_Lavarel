<?php

namespace App\Http\Controllers;

use App\Business\CategoryBusiness;
use App\Business\ProductBusiness;
use App\Business\MenuBusiness;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getList($id)
    {
        $menus = MenuBusiness::getRoleMenu($id);
        return $menus;
    }

    //menu in page guest
    public function index()
    {
        $products = ProductBusiness::getList();
        foreach ($products as $product) {
            $product["category_name"] = (CategoryBusiness::getById($product["category_id"]))->name;
        }
        return view('pages.home.menu', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $aInput = $request->all();
        return MenuBusiness::saveBulkMenuRole($aInput);
    }
}
