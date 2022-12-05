<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function testRating()
    {
        $post = Post::findOrFail(3);

// Add a rating of 5, from the currently authenticated user
        $post->rate(5);
//        dd($post->ratings);
//        dd($post->averageRating);
//        dd($post->ratingPercent(10)); // Ten star rating system
        dd($post->userSumRating);

    }
}
