@extends('Admin.Layouts.master')

@section('content')
    @if(session()->has('delete_comment'))
        <div class="alert alert-danger">
            <p>{{session()->get('delete_comment')}}</p>
        </div>
    @endif

    @if(session()->has('update_comment'))
        <div class="alert alert-info">
            <p>{{session()->get('update_comment')}}</p>
        </div>
    @endif

    @if(session()->has('create_comment'))
        <div class="alert alert-success">
            <p>{{session()->get('create_comment')}}</p>
        </div>
    @endif

    @if(session()->has('comment_approved'))
        <div class="alert alert-warning">
            <p>{{session()->get('comment_approved')}}</p>
        </div>
    @endif

    @if(session()->has('comment_rejected'))
        <div class="alert alert-warning">
            <p>{{session()->get('comment_rejected')}}</p>
        </div>
    @endif
<h3 class="m-b-2">لیست نظرات</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th scope="col">شناسه</th>
            <th scope="col">مطلب</th>
            <th scope="col"> متن</th>
            <th scope="col">وضعیت</th>
            <th scope="col">تاریخ ایجاد</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <th scope="row">{{$comment->id}}</th>
                <td>{{$comment->post->title}}</td>
                <td><a href="{{route('comment.edit',$comment->id)}}">{{$comment->description}}</a></td>
                <td>
                    @if($comment->status==0)
                        <span class="tag tag-pill tag-danger">منتشر نشده</span>
                    @else
                        <span class="tag tag-pill tag-success">منتشر شده</span>
                    @endif
                </td>
                {{--            <td>{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->formatDifference(Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</td>--}}
                <td>{{verta($comment->created_at)->formatDifference(Hekmatinasser\Jalali\Jalali::today())}}</td>

                <td>
                    @if($comment->status==0)
                        <form method="POST" action="{{route('comment.active',$comment->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <button type="submit" class="btn btn-success p-x-2" value="approved" name="action">تایید</button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{route('comment.active',$comment->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger rounded" value="rejected" name="action">لغو تایید</button>
                            </div>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col-md-6 offset-md-5">{{$comments->links('vendor.pagination.bootstrap-4')}}</div>

@endsection
