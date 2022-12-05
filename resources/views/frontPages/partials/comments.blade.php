@foreach($comments as $comment)
    <div class="media mb-4">
        <img class="d-flex mr-1 rounded-circle" src="https://via.placeholder.com/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">مهمان</h5>
            <div class="row">
                <div class="col-10">{{$comment->description}}</div>
                <div class="col-2">
                    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="{{'#'.$comment->id}}" aria-expanded="false" aria-controls="{{$comment->id}}">
                        پاسخ
                    </button></div>
            </div>
            <div class="row my-4">
                <div class="collapse col-12" id="{{$comment->id}}">
                        <div class="card my-4">
                            <h5 class="card-header">ثبت پاسخ</h5>
                            <div class="card-body">
                                <form method="post" action="{{route('front.comment.reply',$post->id)}}" class="">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <textarea class="form-control" rows="3" name="description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><h6>ثبت</h6></button>
                                </form>

                            </div>
                        </div>
                </div>
            </div>
            @include('frontPages.partials.comments',['comments'=> $comment->replies,'post'=>$post])
        </div>

    </div>

@endforeach
