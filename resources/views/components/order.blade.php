<div class="col-lg-12 col-md-12">
    <div class="single_jobs white-bg d-flex justify-content-between">
        <div class="jobs_left d-flex align-items-center">
            <img class="mr-4" src="/{{$order->service->user->avatar}}" style="width: 80px; height: 80px;" alt="">
            <div class="jobs_conetent">
                <a href="{{route('service-page', ['id' => $order->service->id])}}"><h4>{{$order->service->title}}</h4></a>
                <div class="links_locat d-flex align-items-center">
                    <div class="location">
                        <p> <i class="fa fa-spinner fa-pulse"></i> {{$order->status->title}}</p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-money"></i> {{$order->cost}} ₽</p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-cubes"></i> {{$order->quantity}} {{$order->service->unit->measure}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobs_right">
            <div class="apply_now">
                @if (Auth::user() && Auth::user()->role->title === "Клиент")
                    <a class="editbtn" href="#"> <i class="fa fa-pencil"></i> </a>
                    <a class="delbtn" href="#"> <i class="fa fa-trash"></i> </a>
                @elseif (Auth::user() && $service->user_id == Auth::id() || Auth::user() && Auth::user()->role->title === "Администратор")
                    <a class="editbtn" href="#"> <i class="fa fa-pencil"></i> </a>
                    <a class="delbtn" href="#"> <i class="fa fa-trash"></i> </a>
                @endif
            </div>
        </div>
    </div>
</div>