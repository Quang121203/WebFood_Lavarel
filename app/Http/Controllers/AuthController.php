<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\AuthBusiness;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $aInput = $request->all();
        return AuthBusiness::register($aInput);
    }

    public function login(Request $request)
    {
        $aInput = $request->all();
        return AuthBusiness::login($aInput);
    }

    public function logout()
    {
        return AuthBusiness::logout();
    }
}
