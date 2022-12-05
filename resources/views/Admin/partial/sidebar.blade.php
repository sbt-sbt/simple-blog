<!-- Search Widget -->
<div class="card my-4">
    <h5 class="card-header">جستوجو</h5>
    <div class="card-body">
        <form method="get" action="{{route('front.search.post')}}" enctype="multipart/form-data">

        <div class="input-group">
            <input type="text" class="form-control" placeholder="عبارت مورد جستوجو ..." name="title">
            <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit">برو</button>
                </span>
        </div>
        </form>
    </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
    <h5 class="card-header">دسته بندی ها</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{route('front.show.category.posts',$category->slug)}}">{{$category->title}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Side Widget -->
<div class="card my-4">
    <h5 class="card-header">Side Widget</h5>
    <div class="card-body">
        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
    </div>
</div>
