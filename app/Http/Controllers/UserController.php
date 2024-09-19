<?php

namespace App\Http\Controllers;

use App\Business\RoleBusiness;
use Illuminate\Http\Request;
use App\Business\UserBusiness;

class UserController extends Controller
{
    public function getList($id, $isActive)
    {
        $users = $id > 0 ? UserBusiness::getByRoleId($id,$isActive) : UserBusiness::getList($isActive);
        foreach ($users as $user) {
            $user['role_name'] = (RoleBusiness::getById($user['role_id']))['name'];
        }
        return $users;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.user.index');
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();
        return UserBusiness::changePassword($input);
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
        $aInput = $request->all();
        return UserBusiness::save($aInput);
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
        return UserBusiness::getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aInput = $request->all();
        return UserBusiness::saveBulkRole($aInput);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        return UserBusiness::delete($id,$request->isActive);
    }
}
