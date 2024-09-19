<?php

namespace App\Http\Controllers;

use App\Business\RoleBusiness;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRoleUser($id)
    {
        return RoleBusiness::getRoleUser($id);
    }
    public function getList()
    {
        return RoleBusiness::getList();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.admin.role.index");
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
        $aInput= $request->all();
        return RoleBusiness::save($aInput);
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
        return RoleBusiness::getById($id);
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
        return RoleBusiness::delete($id);
    }
}
