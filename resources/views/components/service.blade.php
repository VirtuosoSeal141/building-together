<div class="col-lg-12 col-md-12">
    <div class="single_jobs white-bg d-flex justify-content-between">
        <div class="jobs_left d-flex align-items-center">
            <div class="thumb">
                <img src="img/svg_icon/1.svg" alt="">
            </div>
            <div class="jobs_conetent">
                <a href="job_details.html"><h4>{{$service->title}}</h4></a>
                <div class="links_locat d-flex align-items-center">
                    <div class="location">
                        <p> <i class="fa fa-bars"></i> {{$service->category->title}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobs_right">
            <div class="apply_now">
                <a class="heart_mark" href="#"> <i class="ti-heart"></i> </a>
                <a href="job_details.html" class="boxed-btn3">Заказать</a>
            </div>
        </div>
    </div>
</div>