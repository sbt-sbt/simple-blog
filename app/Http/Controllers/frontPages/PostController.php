<?php

namespace App\Http\Controllers\frontPages;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    public function show($slug)
    {
        $post=Post::with(['photo','user','category',
            'comments'=>function($q){
            $q->where('status',1);
            $q->where('parent_id',null);
            }])
            ->where('slug',$slug)
            ->where('status',1)->first();
        $categories=Category::all();
        return view('frontPages.main.singlePost',compact(['post','categories']));
    }

    public function searchTitle(){
        $query=\request('title');
        $posts=Post::with('photo','user','category')
            ->where('title','like',"%".$query."%")
            ->where('status',1)
            ->orderBy('created_at','desc')->paginate(5);
        $categories=Category::all();

        return view('frontPages.main.search',compact(['posts','query','categories']));
    }

    public function category($slug){
        $category=Category::where('slug',$slug)->first();
        $posts=Post::with('photo','user','category')
            ->where('category_id',$category->id)
            ->where('status',1)
            ->orderBy('created_at','desc')->paginate(5);
        $categories=Category::all();

        return view('frontPages.main.category',compact(['posts','categories','slug']));
    }
}
