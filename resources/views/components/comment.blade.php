<div class="comment-list">
    <div class="single-comment justify-content-between d-flex">
        <div class="user justify-content-between d-flex">
            @if (Auth::user() && Auth::id() == $review->user_id || Auth::user() && Auth::user()->role->title === "Администратор")
                <a class="delbtn mr-2 mt-3" href="{{route('delcomment', ['id' => $review->id])}}"> <i class="fa fa-trash"></i> </a>
            @endif
            <div class="thumb">
                <img src="/{{$review->user->avatar}}" alt="">
            </div>
            <div class="desc">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <h5>
                        <a href="#">{{$review->user->name}}</a>
                        </h5>
                        <p class="date"><i class="fa fa-star"></i> {{$review->rating}}</p>
                    </div>
                </div>
                <p class="comment">{{$review->comment}}</p>
            </div>
        </div>
    </div>
</div>