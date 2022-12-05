@extends('Admin.Layouts.master')

@section('content')
    <div class="row m-b-1 p-r-2">
        <div class="col-md-11">
            <h3 class="m-b-2">ویرایش پست {{$post->title}}</h3>
        </div>

        <div class="col-md-1">
            <form method="POST" action="{{route('posts.destroy',$post)}}" enctype="multipart/form-data">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">حذف مطلب</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 p-l-3">
            <img src="{{$post->photo ? asset('images/'.$post->photo->path) : 'https://via.placeholder.com/300C/O https://placeholder.com/'}}" alt="" class="img-fluid p-t-2">
        </div>
        <div class="col-md-7">
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('posts.update',$post)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="slug">نامک</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{$post->slug}}">
                </div>
                <div class="form-group">
                    <label for="categories">دسته بندی</label>
                    <select multiple class="form-control" id="categories" name="category">
                        @foreach($categories as $id=>$title)
                            <option value="{{$id}}" @if($id==$post->category_id)selected @endif>{{$title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control" id="description" name="description">{{$post->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">وضعیت</label>
                    <select class="form-control" id="status" aria-describedby="emailHelp" name="status">
                        <option value="0" @if($post->status==0)selected @endif>غیر فعال</option>
                        <option value="1" @if($post->status==1)selected @endif>فعال</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">تصویر</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/gif, image/jpeg" >
                </div>

                <div class="form-group">
                    <label for="meta_description">متا توضیحات</label>
                    <textarea class="form-control" id="meta_description" name="meta_description">{{$post->meta_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="meta_keywords">کلمات کلیدی</label>
                    <textarea class="form-control" id="meta_keywords" name="meta_keywords">{{$post->meta_keywords}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>


@endsection

