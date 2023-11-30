<div class="col-lg-12 col-md-12">
    <div class="single_jobs white-bg d-flex justify-content-between">
        <div class="jobs_left d-flex align-items-center">
            <img class="mr-4" src="/{{$order->service->user->avatar}}" style="width: 80px; height: 80px; object-fit:cover;" alt="">
            <div class="jobs_conetent">
                <a href="{{route('service-page', ['id' => $order->service->id])}}"><h4>{{$order->service->title}}</h4></a>
                <div class="links_locat d-flex align-items-center">
                    <div class="location">
                        <p> <i class="fa {{$order->status->icon}}"></i> {{$order->status->title}}</p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-money"></i> {{$order->cost}} ₽</p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-cubes"></i> {{$order->quantity}} {{$order->service->unit->measure}}</p>
                    </div>
                    @if (Auth::user()->role->title !== "Клиент")
                        <div class="location">
                            <p> <a class="userlink" href="#"><i class="fa fa-user"></i> {{$order->client->name}}</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="jobs_right">
            <div class="apply_now">
                @if ($order->status_id === 1)
                    <a class="delbtn" href="{{route('delorder', ['id' => $order->id])}}"> <i class="fa fa-trash"></i> </a>
                @endif
                @if (Auth::user()->role->title !== "Клиент")
                    @if ($order->status_id === 1 || $order->status_id === 3)
                        <a class="favbtn" href="{{route('changestatus', ['id' => $order->id])}}"> <i class="fa fa-exchange"></i> </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>