@extends('Admin.Layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="m-b-2">آپلود فایل</h3>
            @include('Admin.partial.errors')
            <form method="POST" action="{{route('media.store')}}" enctype="multipart/form-data" class="dropzone">
                @csrf
            </form>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('js/dropzone.js')}}"></script>
@endsection
