@extends('Admin.Layouts.master')

@section('content')
    <div class="row m-b-1 p-r-2">
        <div class="col-md-11">
            <h3 class="m-b-2">ویرایش نظر</h3>
        </div>

        <div class="col-md-1">
            <form method="POST" action="{{route('comment.destroy',$comment)}}" enctype="multipart/form-data">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">حذف نظر</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('comment.update',$comment)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="description">نظر</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{$comment->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>


@endsection

