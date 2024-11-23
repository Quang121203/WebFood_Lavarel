<?php

namespace App\Business;

use App\Models\Comment;
use Auth;

class CommentBusiness
{
    public static function getList()
    {
        $returnVal = Comment::orderBy("created_at", 'desc')->get();
        return $returnVal;   
    }
    
    public static function getListByProduct($product_id)
    {
        return Comment::where("product_id", "=", $product_id)->orderBy("created_at", 'desc')->get();
    }

    public static function save($request)
    {
        $aInput = $request->all();

        $comment = new Comment();
        $comment['user_id'] = Auth::user()->id;

        $comment->fill($aInput);
        $comment->save();
        return ["success" => true, "msg" => "Comment successfully"];
    }

}
