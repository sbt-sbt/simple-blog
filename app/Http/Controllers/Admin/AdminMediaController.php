<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos=Photo::with(['user'])->paginate(5);
        return view('Admin.Photo.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file=$request->file('file');
        $path = time() . $file->getClientOriginalName();
        $file->move('images', $path);
        $photo = new Photo();
        $photo->name = $file->getClientOriginalName();
        $photo->path = $path;
        $photo->user_id = Auth::id();
        $photo->save();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo=Photo::findOrFail($id);
        if (file_exists('images/'.$photo->path)){
            unlink('images/'.$photo->path);
        }
        $photo->delete();
        session()->flash('delete_photo','تصویر با موفقیت حذف شد.');
        return redirect('admin/media');
    }

    public function deletePhotos(Request $request)
    {
//        return $request->all();
        $photos=Photo::findOrFail($request->checkboxArray);
        foreach ($photos as $photo){
            unlink('images/'.$photo->path);
            $photo->delete();
        }
        session()->flash('delete_photos','تصاویر با موفقیت حذف شدند.');
        return redirect('admin/media');

    }

    public function download($id)
    {
//        dd(now()->timestamp,now()->timestamp + 2);
        $baseTimeStamp=1670013200;
        $photo=Photo::findOrFail($id);
        if (file_exists('images/'.$photo->path)) {
            if (now()->timestamp > $baseTimeStamp){
                return response()->download('images/' . $photo->path);
        }else{
                return 'the url expired';
            }
        }
    }
}
