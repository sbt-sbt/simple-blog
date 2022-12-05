@extends('Admin.Layouts.master')

@section('content')
    @if(session()->has('delete_category'))
        <div class="alert alert-danger">
            <p>{{session()->get('delete_category')}}</p>
        </div>
    @endif

    @if(session()->has('update_category'))
        <div class="alert alert-info">
            <p>{{session()->get('update_category')}}</p>
        </div>
    @endif

    @if(session()->has('create_category'))
        <div class="alert alert-success">
            <p>{{session()->get('create_category')}}</p>
        </div>
    @endif
<h3 class="m-b-2">لیست دسته بندی ها</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th scope="col">عنوان</th>
            <th scope="col"> نامک</th>
            <th scope="col">متا توضیحات</th>
            <th scope="col">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row"><a href="{{route('categories.edit',$category->id)}}">{{$category->title}}</a></th>
                <td>{{$category->slug}}</td>
                <td>{{\Illuminate\Support\Str::limit($category->meta_description,15)}}</td>
                {{--            <td>{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->formatDifference(Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</td>--}}
                <td>{{verta($category->created_at)->formatDifference(Hekmatinasser\Jalali\Jalali::today())}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col-md-6 offset-md-5">{{$categories->links('vendor.pagination.bootstrap-4')}}</div>

@endsection
