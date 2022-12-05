<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $postCount=Post::count();
        $recentPosts=Post::orderBy('created_at','desc')->limit(3)->get();
        $recentUsers=User::orderBy('created_at','desc')->limit(3)->get();
        $categoryCount=Category::count();
        $photoCount=Photo::count();
        $userCount=User::count();
        return view('Admin.dashboard',compact(['postCount','categoryCount','photoCount','userCount','recentPosts','recentUsers']));
    }
}
