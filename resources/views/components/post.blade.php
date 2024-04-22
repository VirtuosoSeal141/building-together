<article class="blog_item">
    <div class="blog_item_img">
        <img class="card-img rounded-0" style="height: 410px; object-fit:scale-down;" src="/{{$post->image}}" alt="">
        <div class="blog_item_date">
            <h3>{{date('d.m.Y',strtotime($post->publication_date))}}</h3>
        </div>
    </div>

    <div class="blog_details">
        <a class="d-inline-block" href="{{route('post-page', ['id'=>$post->id])}}">
            <h2>{{$post->title}}</h2>
        </a>
        <p>{{Str::limit($post->description, 220)}}</p>
        <ul class="blog-info-link">
            @if (Auth::user() && $post->user_id == Auth::id() || Auth::user() && Auth::user()->role->title == "Администратор")
                @if (Auth::user()->role->title == "Администратор")
                    <li><a href="#"><i class="fa fa-user"></i> {{$post->user->name}}</a></li>
                @endif
                <li><a href="{{route('editpost-page', ['id'=>$post->id])}}"><i class="fa fa-pencil"></i> Изменить</a></li>
                <li><a href="{{route('delpost', ['id'=>$post->id])}}"><i class="fa fa-trash"></i> Удалить</a></li>
            @else
                <li><a href="#"><i class="fa fa-user"></i> {{$post->user->name}}</a></li>
            @endif
            <li><a href="{{route('post-page', ['id'=>$post->id])}}"><i class="fa fa-comments"></i> Комментарии ({{count($post->comments)}})</a></li>
        </ul>
    </div>
</article>