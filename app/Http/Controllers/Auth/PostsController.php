<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }
}
