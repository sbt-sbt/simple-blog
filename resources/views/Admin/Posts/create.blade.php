@extends('Admin.Layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h3 class="m-b-2">ایجاد پست جدید</h3>
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="slug">نامک</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div>
                <div class="form-group">
                    <label for="categories">دسته بندی</label>
                    <select multiple class="form-control" id="categories" name="category">
                        @foreach($categories as $id=>$title)
                            <option value="{{$id}}" @if($title=='کاربر')selected @endif>{{$title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="status">وضعیت</label>
                    <select class="form-control" id="status" aria-describedby="emailHelp" name="status">
                        <option value="0">غیر فعال</option>
                        <option value="1">فعال</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">تصویر</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/gif, image/jpeg" >
                </div>

                <div class="form-group">
                    <label for="meta_description">متا توضیحات</label>
                    <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
                </div>
                <div class="form-group">
                    <label for="meta_keywords">کلمات کلیدی</label>
                    <textarea class="form-control" id="meta_keywords" name="meta_keywords"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>


@endsection

