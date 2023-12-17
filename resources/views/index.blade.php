@extends('layout')

@section('title', 'Building Together')

@section('page-content')
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h5 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                                {{count($services)}}
                                @if (count($services) == 1)
                                    услуга
                                @elseif (count($services) > 1 && count($services) < 5)
                                    услуги
                                @elseif (count($services) == 0 || count($services) > 4)
                                    услуг
                                @endif 
                                опубликовано
                            </h5>
                            <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">Найди свою услугу</h3>
                            <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">Мы предоставляем онлайн платформу для поиска услуг и специалистов в строительной сфере</p>
                            <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                                <a href="{{route('services-page')}}" class="boxed-btn3">Найти</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s" data-wow-delay=".2s">
            <img src="img/banner/illustration.png" alt="">
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- popular_catagory_area_start  -->
    <div class="popular_catagory_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title mb-40">
                        <h3>Категории</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    <x-category :category="$category"></x-category>
                @endforeach
            </div>
        </div>
    </div>
    <!-- popular_catagory_area_end  -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section_title">
                        <h3>Рекомендации</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="brouse_job text-right">
                        <a href="{{route('services-page')}}" class="boxed-btn4">Показать ещё</a>
                    </div>
                </div>
            </div>
            <div class="job_lists">
                <div class="row">
                    @foreach ($recomendations as $recomendation)
                        <x-service :service="$recomendation"></x-service>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->
    @if (!Auth::user())
        <!-- job_searcing_wrap  -->
        <div class="job_searcing_wrap overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-6">
                        <div class="searching_text">
                            <h3>Ищете услугу?</h3>
                            <p>В нашем приложении Вы можете найти любую строительную услугу </p>
                            <a href="{{route('services-page')}}" class="boxed-btn3">Найти</a>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 col-md-6">
                        <div class="searching_text">
                            <h3>Хотите опубликовать услугу?</h3>
                            <p>В нашем приложении Вы можете опубликовать услугу любой категории </p>
                            <a href="{{route('signup-page', [2])}}" class="boxed-btn3">Опубликовать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job_searcing_wrap end  -->
    @endif
    
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>

    <script>
        var addFav = function ($id) {
            const btn = document.getElementById('btn'+$id);
            const icon = document.getElementById('icon'+$id);

            var request = new XMLHttpRequest();
            request.responseType = 'json';
            request.open('GET', '/addfavourite/' + $id);
            request.send();
            request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200){
                        btn.setAttribute('onclick', 'delFav('+$id+');');
                        icon.setAttribute('class', 'fa fa-heart');
                    }
            }
        }
        var delFav = function ($id) {
            const btn = document.getElementById('btn'+$id);
            const icon = document.getElementById('icon'+$id);

            var request = new XMLHttpRequest();
            request.responseType = 'json';
            request.open('GET', '/delfavourite/' + $id);
            request.send();
            request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200){
                        btn.setAttribute('onclick', 'addFav('+$id+');');
                        icon.setAttribute('class', 'fa fa-heart-o');
                    }
            }
        }
    </script>
@endsection