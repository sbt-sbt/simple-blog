<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=Comment::with('post')->orderBy('created_at','desc')->paginate(30);
        return view('Admin.Comments.index',compact('comments'));
    }

    public function active(Request $request,$id)
    {
//        dd($request->input('action'));
        $comment=Comment::findOrFail($id);
        if ($request->has('action')){
        if ($request->input('action')=='approved'){
            $comment->status=1;
            $comment->save();
            session()->flash('comment_approved', 'نظر کاربر با موفقیت تایید شد.');

        }elseif ($request->input('action')=='rejected'){
            $comment->status=0;
            $comment->save();
            session()->flash('comment_rejected', 'نظر کاربر با موفقیت رد شد.');
        }
        }
        return redirect('admin/comment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment=Comment::findOrFail($id);
        return view('Admin.Comments.edit',compact(['comment']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment=Comment::findOrFail($id);
        $comment->description=$request->input('description');
        $comment->save();
        session()->flash('update_comment', 'نظر کاربر با موفقیت ویرایش شد.');
        return redirect('admin/comment');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::findOrFail($id);
        $comment->delete();
        session()->flash('delete_comment', 'نظر کاربر با موفقیت حذف شد.');
        return redirect('admin/comment');
    }
}
