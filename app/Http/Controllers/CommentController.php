<?php

namespace App\Http\Controllers;

use App\Business\CommentBusiness;
use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{

    public function store(Request $request)
    {
        return CommentBusiness::save($request);
    }

  
}
