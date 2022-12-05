<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $users=User::all();
        $users=User::with('roles')->paginate(5);
//        dd($users);
        return view('Admin.Users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $roles=Role::all();
        $roles=Role::pluck('name','id');
//        dd($roles);
        return view('Admin.Users.create',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
//        return $request->all();

        $user=new User();
        if($file=$request->file('avatar')){
            $path=time().$file->getClientOriginalName();
            $file->move('images',$path);

            $photo=new Photo();
            $photo->name=$file->getClientOriginalName();
            $photo->path=$path;
            $photo->user_id=Auth::id();
            $photo->save();

            $user->photo_id=$photo->id;
        }
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=bcrypt($request->input('password'));
        $user->status=$request->input('status');
        $user->save();
        $user->roles()->attach($request->input('roles'));
        session()->flash('create_user','کاربر با موفقیت ایجاد شد.');
        return redirect('admin/users');
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
        $user=User::findOrFail($id);
//        dd($user->photo);
        $roles=Role::pluck('name','id');
        return view('Admin.Users.edit',compact(['user','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
//        dd($user);
//        dd($request->all());
//        return $request->all();
        $savedUser=User::findOrFail($user->id);
        if($file=$request->file('avatar')){
            $path=time().$file->getClientOriginalName();
            $file->move('images',$path);

            $photo=new Photo();
            $photo->name=$file->getClientOriginalName();
            $photo->path=$path;
            $photo->user_id=Auth::id();
            $photo->save();

            $savedUser->photo_id=$photo->id;
        }
        $savedUser->name=$request->input('name');
        $savedUser->email=$request->input('email');
        if (trim($request->input('password') != '')){
        $savedUser->password=bcrypt($request->input('password'));
        }
        $savedUser->status=$request->input('status');
        $savedUser->save();
        $savedUser->roles()->sync($request->input('roles'));

        session()->flash('update_user','کاربر با موفقیت ویرایش شد.');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $photo=Photo::findOrFail($user->photo_id);
        unlink('images/'.$user->photo->path);
        $photo->delete();
        $user->delete();
        session()->flash('delete_user','کاربر با موفقیت حذف شد.');
        return redirect('admin/users');
    }
}
