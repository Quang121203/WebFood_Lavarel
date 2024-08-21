<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\ProductBusiness;
use App\Business\CategoryBusiness;

class ProductController extends Controller
{
    public function getProductByCategory($id)
    {
        $categories = CategoryBusiness::getList();
        $products = ProductBusiness::getByCategotyId($id);
        return view('pages.category', ['categories' => $categories, 'products' => $products, 'id' => $id]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
