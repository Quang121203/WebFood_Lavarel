<?php

namespace App\Business;

use App\Models\Category;

class CategoryBusiness
{
    public static function getById($id)
    {
        return Category::find($id);
    }

    public static function getList()
    {    
        $returnVal = Category::orderBy("name",'asc')->get();         
        return $returnVal;
    }
}
