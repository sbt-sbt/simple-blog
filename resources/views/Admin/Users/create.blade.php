@extends('Admin.Layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="m-b-2">ایجاد کاربر جدید</h3>
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">نام</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ایمیل</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           name="email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="roles">نقش</label>
                    <select multiple class="form-control" id="roles" name="roles[]">
                        @foreach($roles as $id=>$name)
                            <option value="{{$id}}" @if($name=='کاربر')selected @endif>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">وضعیت</label>
                    <select class="form-control" id="status" aria-describedby="emailHelp" name="status">
                        <option value="0">غیر فعال</option>
                        <option value="1">فعال</option>
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
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>


@endsection

