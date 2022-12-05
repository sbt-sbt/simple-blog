@extends('Admin.Layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="m-b-2">ایجاد دسته بندی جدید</h3>
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
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

