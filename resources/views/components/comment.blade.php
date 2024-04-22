<div class="comment-list">
    <div class="single-comment justify-content-between d-flex">
        <div class="user justify-content-between d-flex">
            @if (Auth::user() && Auth::id() == $comment->user_id || Auth::user() && Auth::user()->role->title === "Администратор")
                <a class="delbtn mr-2 mt-3" href="{{route('delcomment', ['id' => $comment->id])}}"> <i class="fa fa-trash"></i> </a>
            @endif
            <div class="thumb">
                <img src="/{{$comment->user->avatar}}" alt="">
            </div>
            <div class="desc">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <h5><a href="#">{{$comment->user->name}}</a></h5>
                    </div>
                </div>
                <p class="comment">{{$comment->comment}}</p>
            </div>
        </div>
    </div>
</div>