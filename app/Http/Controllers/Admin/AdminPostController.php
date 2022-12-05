<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('photo', 'category', 'user')->paginate(5);
//        dd($posts);
        return view('Admin.Posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id');
        return view('Admin.Posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $post = new Post();
        if ($file = $request->file('photo')) {
            $path = time() . $file->getClientOriginalName();
            $file->move('images', $path);

            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $path;
            $photo->user_id = Auth::id();
            $photo->save();

            $post->photo_id = $photo->id;
        }
        $post->title = $request->input('title');
        if ($request->input('slug')) {
            $post->slug = make_slug($request->input('slug'), '-');
        }else{
            $post->slug = make_slug($request->input('title'), '-');
        }
        $post->description = $request->input('description');
        $post->status = $request->input('status');
        $post->user_id = Auth::id();
        $post->category_id = $request->input('category');
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->save();
        session()->flash('create_post', 'نوشته جدید با موفقیت ایجاد شد.');
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $categories = Category::pluck('title', 'id');
        return view('Admin.Posts.edit',compact(['post','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($file = $request->file('photo')) {
            $path = time() . $file->getClientOriginalName();
            $file->move('images', $path);

            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $path;
            $photo->user_id = Auth::id();
            $photo->save();

            $post->photo_id = $photo->id;
        }
        $post->title = $request->input('title');
        if ($request->input('slug')) {
            $post->slug = make_slug($request->input('slug'), '-');
        }else{
            $post->slug = make_slug($request->input('title'), '-');
        }
        $post->description = $request->input('description');
        $post->status = $request->input('status');
        $post->user_id = Auth::id();
        $post->category_id = $request->input('category');
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->save();
        session()->flash('update_post', 'نوشته با موفقیت ویرایش شد.');
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        $photo=Photo::findOrFail($post->photo_id);
        if (file_exists('images/'.$post->photo->path)){
            unlink('images/'.$post->photo->path);
        }
        $photo->delete();
        $post->delete();
        session()->flash('delete_post','نوشته با موفقیت حذف شد.');
        return redirect('admin/posts');
    }
}
