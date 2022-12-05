@extends('frontPages.layout.master')
@section('meta')
    <meta name="description" content="صفحه اصلی وبلاگ">
    <meta name="keywords" content="وبلاگ">
    <meta name="author" content="آینا ثابت">
@endsection
@section('navigation')
    @include('Admin.partial.navigation',['categories'=>$categories])
@endsection
@section('content')

    <h1 class="mt-4">نتیجه جستوجو برای {{$query}}</h1>
    @foreach($posts as $post)
        <hr>
        <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>
        <div class="row">
            <!-- Author -->
            <div class="col-md-6 lead">
                ایجاد شده توسط
                <a href="#">{{$post->user->name}}</a>
            </div>


            <!-- Date/Time -->
            <div class="col-md-6 lead text-right">تاریخ ایجاد {{verta($post->created_at)->formatDifference(Hekmatinasser\Jalali\Jalali::today())}}</div>
        </div>



        <hr>

        <!-- Preview Image -->
        {{--        <img class="img-fluid rounded" src="https://via.placeholder.com/900x300" alt="">--}}
        <img class="img-fluid rounded" src="{{$post->photo ? asset('images/'.$post->photo->path) : 'https://via.placeholder.com/900x300'}}" alt="" width="730">
        <hr>
        <!-- Post Content -->
        <p>{{\Illuminate\Support\Str::limit($post->description,100)}}</p>

        <div class="col-md-12 text-right">
            <a href="{{route('front.show.post',$post->slug)}}" class="btn btn-primary">ادامه مطلب</a>
        </div>
        <hr>

    @endforeach

@endsection

@section('sidebar')
    @include('Admin.partial.sidebar',['categories'=>$categories])
@endsection
