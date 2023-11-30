<div class="col-lg-12 col-md-12">
    <div class="single_jobs white-bg d-flex justify-content-between">
        <div class="jobs_left d-flex align-items-center">
            <img class="mr-4" src="/{{$service->user->avatar}}" style="width: 80px; height: 80px; object-fit:cover;" alt="">
            <div class="jobs_conetent">
                <a href="{{route('service-page', ['id' => $service->id])}}"><h4>{{$service->title}}</h4></a>
                <div class="links_locat d-flex align-items-center">
                    <div class="location">
                        <p> <i class="fa fa-bars"></i> {{$service->category->title}}</p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-money"></i> {{$service->price}} ₽/{{$service->unit->measure}}</p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-star"></i> {{$service->rating()}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobs_right">
            <div class="apply_now">
                @if (Auth::user() && Auth::user()->role->title === "Клиент")
                    @if (Auth::user()->checkFav($service->id))
                        <button id="btn{{$service->id}}" class="favbtn" onclick="addFav({{$service->id}})"><i id="icon{{$service->id}}" class="fa fa-heart-o"></i></button>
                    @else
                        <button id="btn{{$service->id}}" class="favbtn" onclick="delFav({{$service->id}})"><i id="icon{{$service->id}}" class="fa fa-heart"></i></button>
                    @endif
                @elseif (Auth::user() && $service->user_id == Auth::id() || Auth::user() && Auth::user()->role->title === "Администратор")
                    <a class="editbtn" href="{{route('editservice-page', ['id' => $service->id])}}"> <i class="fa fa-pencil"></i> </a>
                    <a class="delbtn" href="{{route('delservice', ['id' => $service->id])}}"> <i class="fa fa-trash"></i> </a>
                @endif
            </div>
        </div>
    </div>
</div>