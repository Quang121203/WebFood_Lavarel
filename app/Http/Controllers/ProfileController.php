<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\ProfileBusiness;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return view('pages.profile');
    }

    public function postProfile(Request $request)
    {
        return ProfileBusiness::save($request);
    }
}
