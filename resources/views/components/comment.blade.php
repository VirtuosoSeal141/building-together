<div class="comment-list">
    <div class="single-comment justify-content-between d-flex">
        <div class="user justify-content-between d-flex">
        <div class="thumb">
            <img src="/{{review->user->avarar}}" alt="">
        </div>
        <div class="desc">
            <p class="comment">{{review->comment}}</p>
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5>
                    <a href="#">{{review->user->name}}</a>
                    </h5>
                    <p class="date"><i class="fa fa-star"></i> {{review->rating}}</p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>