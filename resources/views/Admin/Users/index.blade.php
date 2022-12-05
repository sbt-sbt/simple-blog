@extends('Admin.Layouts.master')

@section('content')
    @if(session()->has('delete_user'))
        <div class="alert alert-danger">
            <p>{{session()->get('delete_user')}}</p>
        </div>
    @endif

    @if(session()->has('update_user'))
        <div class="alert alert-info">
            <p>{{session()->get('update_user')}}</p>
        </div>
    @endif

    @if(session()->has('create_user'))
        <div class="alert alert-success">
            <p>{{session()->get('create_user')}}</p>
        </div>
    @endif
<h3 class="m-b-2">لیست کاربران</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th scope="col">تصویر</th>
            <th scope="col">نام</th>
            <th scope="col">ایمیل</th>
            <th scope="col">تاریخ ایجاد</th>
            <th scope="col">نقش</th>
            <th scope="col">وضعیت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td><img src="{{$user->photo ? asset('images/'.$user->photo->path) : 'https://via.placeholder.com/150/008000C/O https://placeholder.com/'}}" alt="" width="80" height="80"></td>

            <th scope="row"><a href="{{route('users.edit',$user->id)}}">{{$user->name}}</a></th>
            <td>{{$user->email}}</td>
{{--            <td>{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->formatDifference(Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</td>--}}
            <td>{{verta($user->created_at)->formatDifference(Hekmatinasser\Jalali\Jalali::today())}}</td>
            <td>@foreach($user->roles as $role)
            <p>{{$role->name}}</p>
            @endforeach
            </td>
            <td>
            @if($user->status==0)
                    <span class="tag tag-pill tag-danger">غیرفعال</span>
            @else
                    <span class="tag tag-pill tag-success">فعال</span>
            @endif
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col-md-6 offset-md-5">{{$users->links('vendor.pagination.bootstrap-4')}}</div>

@endsection
