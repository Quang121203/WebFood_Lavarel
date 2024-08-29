<?php

namespace App\Http\Controllers;

use App\Business\CartBusiness;
use App\Business\OrderBusiness;
use App\Business\OrderDetailBusiness;
use Illuminate\Http\Request;
use App\Business\ProductBusiness;
use App\Business\CategoryBusiness;

class ProductController extends Controller
{
    public function getProductByCategory($id)
    {
        $categories = CategoryBusiness::getList();
        $products = ProductBusiness::getByCategotyId($id);
        return view('pages.home.category', ['categories' => $categories, 'products' => $products, 'id' => $id]);
    }

    public function getList($id)
    {
        $products = $id > 0 ? ProductBusiness::getByCategotyId($id) : ProductBusiness::getList();
        foreach ($products as $product) {
            $product['category_name'] = (CategoryBusiness::getById($product['category_id']))['name'];
        }
        return $products;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.product.index');
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
        return ProductBusiness::save($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ProductBusiness::getById($id);
        $product['category_name'] = (CategoryBusiness::getById($product['category_id']))['name'];
        return view('pages.home.content', ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return ProductBusiness::getById($id);
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
        $check = OrderDetailBusiness::checkProductInOrder($id);
        if ($check) {
            return ["success" => false, "msg" => "The remaining products in the order cannot be deleted"];
        }
        
        $carts = CartBusiness::getByProductId($id);
        if (count($carts) > 0) {
            foreach ($carts as $cart) {
                CartBusiness::delete($cart['id']);
            }
        }
        return ProductBusiness::delete($id);
    }
}
