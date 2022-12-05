@extends('Admin.Layouts.master')
@section('content')

<div class="row">
<div class="col-sm-6 col-lg-3">
<div class="card card-inverse card-primary">
<div class="card-block p-b-0">
<div class="btn-group pull-left">
<button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
</button>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="{{route('posts.create')}}">ایجاد نوشته جدید</a>
</div>
</div>
<h4 class="m-b-0">{{$postCount}}</h4>
<h5><a style="color:white" href="{{route('posts.index')}}">پست ها</a></h5>
</div>
<div class="chart-wrapper p-x-1" style="height:70px;">
<canvas id="card-chart1" class="chart" height="70"></canvas>
</div>
</div>
</div>
<!--/col-->
{{----}}
<div class="col-sm-6 col-lg-3">
<div class="card card-inverse card-info">
<div class="card-block p-b-0">
<button type="button" class="btn btn-transparent active p-a-0 pull-left">
<i class="icon-location-pin"></i>
</button>
<h4 class="m-b-0">{{$categoryCount}}</h4>
<h5><a style="color:white" href="{{route('categories.index')}}">دسته بندی ها</a></h5>
</div>
<div class="chart-wrapper p-x-1" style="height:70px;">
<canvas id="card-chart2" class="chart" height="70"></canvas>
</div>
</div>
</div>
<!--/col-->
{{----}}
<div class="col-sm-6 col-lg-3">
<div class="card card-inverse card-warning">
<div class="card-block p-b-0">
<div class="btn-group pull-left">
<button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-settings"></i>
</button>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
<h4 class="m-b-0">{{$photoCount}}</h4>
<h5><a style="color:white" href="{{route('media.index')}}">تصاویر</a></h5>
</div>
<div class="chart-wrapper" style="height:70px;">
<canvas id="card-chart3" class="chart" height="70"></canvas>
</div>
</div>
</div>
<!--/col-->
{{----}}
<div class="col-sm-6 col-lg-3">
<div class="card card-inverse card-danger">
<div class="card-block p-b-0">
<div class="btn-group pull-left">
<button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-settings"></i>
</button>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
<h4 class="m-b-0">{{$userCount}}</h4>
<h5><a style="color:white" href="{{route('users.index')}}">کاربران</a></h5>
</div>
<div class="chart-wrapper p-x-1" style="height:70px;">
<canvas id="card-chart4" class="chart" height="70"></canvas>
</div>
</div>
</div>
<!--/col-->
{{----}}
</div>
{{--<!--/row-->--}}

    <div class="row m-t-2">
        <div class="col-md-6 p-x-3">
            <h4 class="m-b-2">لیست نوشته ها</h4>
            <table class="table table-hover bg-content">
                <thead>
                <tr>
                    <th scope="col">تصویر</th>
                    <th scope="col">عنوان</th>
                    <th scope="col">دسته بندی</th>

                </tr>
                </thead>
                <tbody>
                @foreach($recentPosts as $post)
                    <tr>
                        <td><img src="{{$post->photo ? asset('images/'.$post->photo->path) : 'https://via.placeholder.com/150/008000C/O https://placeholder.com/'}}" alt="" width="80" height="80"></td>
                        <th scope="row"><a href="{{route('posts.edit',$post->id)}}">{{$post->title}}</a></th>
                        <td>{{$post->category->title}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6 p-x-3">
            <h4 class="m-b-2">لیست کاربران</h4>
            <table class="table table-hover bg-content">
                <thead>
                <tr>
                    <th scope="col">نام</th>
                    <th scope="col">ایمیل</th>
                    <th scope="col">نقش</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentUsers as $user)
                    <tr>
                        <th scope="row"><a href="{{route('users.edit',$user->id)}}">{{$user->name}}</a></th>
                        <td>{{$user->email}}</td>
                        <td>@foreach($user->roles as $role)
                                <p>{{$role->name}}</p>
                            @endforeach
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
