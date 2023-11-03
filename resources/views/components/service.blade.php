<div class="col-lg-12 col-md-12">
    <div class="single_jobs white-bg d-flex justify-content-between">
        <div class="jobs_left d-flex align-items-center">
            <img class="mr-4" src="/{{$service->user->avatar}}" style="width: 80px; height: 80px;" alt="">
            <div class="jobs_conetent">
                <a href="job_details.html"><h4>{{$service->title}}</h4></a>
                <div class="links_locat d-flex align-items-center">
                    <div class="location">
                        <p> <i class="fa fa-bars"></i> {{$service->category->title}}</p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-money"></i> {{$service->price}} ₽</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobs_right">
            <div class="apply_now">
                @if (Auth::user() && Auth::user()->role->title === "Клиент")
                    <a class="heart_mark" href="#"> <i class="ti-heart"></i> </a>
                    <a href="#" class="boxed-btn3">Заказать</a>
                @elseif (Auth::user() && $service->user_id == Auth::id() || Auth::user() && Auth::user()->role->title === "Администратор")
                    <a class="editbtn" href="{{route('editservice-page', ['id' => $service->id])}}"> <i class="fa fa-pencil"></i> </a>
                    <a class="delbtn" href="{{route('delservice', ['id' => $service->id])}}"> <i class="fa fa-trash"></i> </a>
                @endif
            </div>
        </div>
    </div>
</div>