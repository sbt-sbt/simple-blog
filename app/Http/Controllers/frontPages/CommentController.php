<?php

namespace App\Http\Controllers\frontPages;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create()
    {
        //
    }

    public function store(Request $request,$postId)
    {
//        dd($request->all());
        $post=Post::findOrFail($postId);
        if ($post){
            $comment=new Comment();
            $comment->description=$request->input('description');
            $comment->post_id=$post->id;
            $comment->status=0;
            $comment->save();
        }


        session()->flash('add_comment', 'دیدگاه شما با موفقیت درج شد و در انتظار تایید قرار گرفت.');
//        return redirect('front.show.post',compact('post'));
        return back();
    }


    public function replies(Request $request)
    {
        $postId=$request->input('post_id');
        $parentId=$request->input('parent_id');

        $post=Post::findOrFail($postId);
        if ($post){
            $comment=new Comment();
            $comment->description=$request->input('description');
            $comment->post_id=$postId;
            $comment->parent_id=$parentId;
            $comment->status=0;
            $comment->save();
        }
        session()->flash('add_comment', 'دیدگاه شما با موفقیت درج شد و در انتظار تایید قرار گرفت.');
        return back();
    }
}
