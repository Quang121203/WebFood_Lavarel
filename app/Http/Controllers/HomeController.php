<?php

namespace App\Http\Controllers;

use App\Business\CommentBusiness;
use App\Business\UserBusiness;
use Illuminate\Http\Request;
use App\Business\CategoryBusiness;
use App\Business\ProductBusiness;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CategoryBusiness::getList();
        $products =ProductBusiness::getTopNumberBuy(6);
        foreach($products as $product) {
            $product["category_name"] = (CategoryBusiness::getById( $product["category_id"]))->name;
        }
        return view('pages.home.home',['categories'=>$categories,'products'=>$products]);
    }

    public function indexAbout()
    {
        $comments = CommentBusiness::getList();
        foreach($comments as $comment){
            $comment['user']= UserBusiness::getById($comment['user_id']);
        }
        return view('pages.home.about',['comments'=>$comments]);
    }
}
