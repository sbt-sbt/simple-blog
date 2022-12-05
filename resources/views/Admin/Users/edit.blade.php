@extends('Admin.Layouts.master')

@section('content')

    <div class="row m-b-1 p-x-3">
        <h3 class="col-md-11">ویرایش پروفایل کاربر {{$user->name}}</h3>
        <div class="col-md-1">
            <form method="POST" action="{{route('users.destroy',$user)}}" enctype="multipart/form-data" class="">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">حذف کاربر</button>
            </form>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4 p-l-3">
            <img src="{{$user->photo ? asset('images/'.$user->photo->path) : 'https://via.placeholder.com/300C/O https://placeholder.com/'}}" alt="" class="img-fluid p-t-2">
        </div>

        <div class="col-md-6">
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('users.update',$user)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">نام</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ایمیل</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           name="email" value="{{$user->email}}">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="roles">نقش</label>
                    <select multiple class="form-control" id="roles" name="roles[]">
                        @foreach($roles as $id=>$name)
                            <option value="{{$id}}"
                                    @foreach($user->roles as $role)
                                        @if($role->id==$id)
                                    selected
                                @endif
                                @endforeach>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">وضعیت</label>
                    <select class="form-control" id="status" aria-describedby="emailHelp" name="status">
                        <option value="0" @if($user->status==0)selected @endif>غیر فعال</option>
                        <option value="1" @if($user->status==1)selected @endif>فعال</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">تصویر</label>
                    <input type="file" class="form-control" id="photo" name="avatar" accept="image/png, image/gif, image/jpeg" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">رمز عبور</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="col-md-6">
                <button type="submit" class="btn btn-primary">به روز رسانی</button>
                </div>


            </form>
        </div>

    </div>


@endsection


