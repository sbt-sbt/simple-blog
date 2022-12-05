@extends('frontPages.layout.master')
@section('meta')
    <meta name="description" content="{{$post->meta_description}}">
    <meta name="keywords" content="{{$post->meta_keywords}}">
    <meta name="author" content="{{$post->user->name}}">
@endsection
@section('navigation')
    @include('Admin.partial.navigation',['categories'=>$categories])
@endsection
@section('content')
    @if(session()->has('add_comment'))
        <div class="alert alert-success mt-3">
            <p>{{session()->get('add_comment')}}</p>
        </div>
    @endif
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
        <img class="img-fluid rounded" src="{{$post->photo ? asset('images/'.$post->photo->path) : 'https://via.placeholder.com/900x300'}}" alt="">
        <hr>
        <!-- Post Content -->

        <p class="text-justify">{{$post->description}}</p>


        <hr>

        <!-- Comments Form -->
        @include('Admin.partial.errors')

        <div class="card my-4">
            <h5 class="card-header">ثبت دیدگاه</h5>
            <div class="card-body">
                <form method="post" action="{{route('front.comment.store',$post->id)}}">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><h6>ثبت</h6></button>
                </form>
            </div>
        </div>

        <!-- Single Comment -->
@include('frontPages.partials.comments',['comments'=>$post->comments,'post'=>$post])


{{--        <div class="media mb-4">--}}
{{--            <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="">--}}
{{--            <div class="media-body">--}}
{{--                <h5 class="mt-0">Commenter Name</h5>--}}
{{--                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}

{{--                <div class="media mt-4">--}}
{{--                    <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="">--}}
{{--                    <div class="media-body">--}}
{{--                        <h5 class="mt-0">Commenter Name</h5>--}}
{{--                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="media mt-4">--}}
{{--                    <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="">--}}
{{--                    <div class="media-body">--}}
{{--                        <h5 class="mt-0">Commenter Name</h5>--}}
{{--                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}


@endsection

@section('sidebar')
    @include('Admin.partial.sidebar',['categories'=>$categories])
@endsection

