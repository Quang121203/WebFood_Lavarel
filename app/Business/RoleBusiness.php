<?php

namespace App\Business;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;

class RoleBusiness
{
    public static function getById($id){
        return Role::find($id);
    }

    public static function getList()
    {
        $returnVal = Role::orderBy("created_at", 'desc')->get();
        return $returnVal;
    }
}