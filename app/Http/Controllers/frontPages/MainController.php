<?php

namespace App\Http\Controllers\frontPages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $posts=Post::with('user','category','photo')
            ->where('status',1)
            ->orderBy('created_at','desc')
            ->limit(3)->get();
        $categories=Category::all();
//        $post=Post::find(3);
//        dd($post);
        return view('frontPages.main.index' , compact('posts','categories'));

    }
}
