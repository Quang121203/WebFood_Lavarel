<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\CategoryBusiness;

class CategoryController extends Controller
{
    public function getList()
    {
        return CategoryBusiness::getList();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.category.index');
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
        return CategoryBusiness::save($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CategoryBusiness::getById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return CategoryBusiness::getById($id);
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
        return CategoryBusiness::delete($id);
    }
}
