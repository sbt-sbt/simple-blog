@extends('Admin.Layouts.master')

@section('content')
    <div class="row m-b-1 p-r-2">
        <div class="col-md-11">
            <h3 class="m-b-2">ویرایش دسته بندی {{$category->title}}</h3>
        </div>

        <div class="col-md-1">
            <form method="POST" action="{{route('categories.destroy',$category)}}" enctype="multipart/form-data">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">حذف مطلب</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('categories.update',$category)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$category->title}}">
                </div>
                <div class="form-group">
                    <label for="slug">نامک</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}">
                </div>

                <div class="form-group">
                    <label for="meta_description">متا توضیحات</label>
                    <textarea class="form-control" id="meta_description" name="meta_description">{{$category->meta_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="meta_keywords">کلمات کلیدی</label>
                    <textarea class="form-control" id="meta_keywords" name="meta_keywords">{{$category->meta_keywords}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>


@endsection

