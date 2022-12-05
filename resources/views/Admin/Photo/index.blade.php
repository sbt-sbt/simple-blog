@extends('Admin.Layouts.master')

@section('content')
    @if(session()->has('delete_photo'))
        <div class="alert alert-danger">
            <p>{{session()->get('delete_photo')}}</p>
        </div>
    @endif

    @if(session()->has('delete_photos'))
        <div class="alert alert-danger">
            <p>{{session()->get('delete_photos')}}</p>
        </div>
    @endif

<h3 class="m-b-2">لیست عکس ها</h3>
    <form action="{{route('delete/photos')}}" method="post">
        @csrf
        @method('delete')
        <div class="form-group">
            <select name="checkboxArray">
                <option value="delete">حذف دسته جمعی</option>
            </select>
            <button type="submit" name="submit" class="btn btn-primary">اعمال</button>
        </div>


    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th scope="col"><input type="checkbox" id="options" onClick="toggle(this)"></th>
            <th scope="col"> تصویر</th>
            <th scope="col">نام</th>
            <th scope="col">شناسه</th>
            <th scope="col">کاربر</th>
            <th scope="col">تاریخ ایجاد</th>
            <th scope="col"> </th>
        </tr>
        </thead>
        <tbody>
        @foreach($photos as $photo)
            <tr>
                <td><input type="checkbox" id="options" name="checkboxArray[]" value="{{$photo->id}}"></td>
                <td>
                    <img src="{{asset('images/'.$photo->path)}}" alt="" class="" width="60">
                </td>
                <td><a href="">{{$photo->id}}</a></td>
                <td><a href="">{{$photo->name}}</a></td>
                <td>{{$photo->user->name}}</td>
                <td>{{verta($photo->created_at)->formatDifference(Hekmatinasser\Jalali\Jalali::today())}}</td>
                <td>
                    <form method="POST" action="{{route('media.destroy',$photo)}}" enctype="multipart/form-data">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">حذف </button>
                    </form></td>

            </tr>
        @endforeach
        </tbody>
    </table>
    </form>
    <div class="col-md-6 offset-md-5">{{$photos->links('vendor.pagination.bootstrap-4')}}</div>

@endsection

@section('scripts')
    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('checkboxArray[]');
            console.log(checkboxes);
            for(var i=0;i<checkboxes.length;i++){
                checkboxes[i].checked = source.checked;
                // checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>
@endsection
