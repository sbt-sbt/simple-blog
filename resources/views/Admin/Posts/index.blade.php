@extends('Admin.Layouts.master')

@section('content')
    @if(session()->has('delete_post'))
        <div class="alert alert-danger">
            <p>{{session()->get('delete_post')}}</p>
        </div>
    @endif

    @if(session()->has('update_post'))
        <div class="alert alert-info">
            <p>{{session()->get('update_post')}}</p>
        </div>
    @endif

    @if(session()->has('create_post'))
        <div class="alert alert-success">
            <p>{{session()->get('create_post')}}</p>
        </div>
    @endif
<h3 class="m-b-2">لیست مقالات</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th scope="col">تصویر</th>
            <th scope="col">عنوان</th>
            <th scope="col">نویسنده</th>
            <th scope="col">توضیحات</th>
            <th scope="col">دسته بندی</th>
            <th scope="col">تاریخ ایجاد</th>
            <th scope="col">وضعیت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><img src="{{$post->photo ? asset('images/'.$post->photo->path) : 'https://via.placeholder.com/150/008000C/O https://placeholder.com/'}}" alt="" width="80" height="80"></td>

                <th scope="row"><a href="{{route('posts.edit',$post->id)}}">{{$post->title}}</a></th>
                <td>{{$post->user->name}}</td>
                <td>{{\Illuminate\Support\Str::limit($post->description,15)}}</td>
                <td>{{$post->category->title}}</td>
                {{--            <td>{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->formatDifference(Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</td>--}}
                <td>{{verta($post->created_at)->formatDifference(Hekmatinasser\Jalali\Jalali::today())}}</td>
                <td>
                    @if($post->status==0)
                        <span class="tag tag-pill tag-danger">غیرفعال</span>
                    @else
                        <span class="tag tag-pill tag-success">فعال</span>
                    @endif
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col-md-6 offset-md-5">{{$posts->links('vendor.pagination.bootstrap-4')}}</div>

@endsection
