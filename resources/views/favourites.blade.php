@extends('layout')

@section('title', 'Building Together - Избранное')

@section('page-content')
    <x-page-header title="Избранное"></x-page-header>

    <!-- job_listing_area_start  -->
    <div class="job_listing_area">
        <div class="container">
            @if (count($favourites) === 0)
                <div class="row align-items-center">
                    <div class="section_title text-center col-12 p-5">
                        <h3>Похоже Вы ещё не добавили в избранное ни одну услугу...</h3>
                    </div>
                    <div class="brouse_job text-center col-12">
                        <a href="{{route('services-page')}}" class="boxed-btn4">Услуги</a>
                    </div>
                </div>
            @else
                <div class="row align-items-center pt-5">
                    <div class="col-lg-6">
                        <div class="section_title">
                            <h3>Список избранных услуг</h3>
                        </div>
                    </div>
                </div>
                <div class="job_lists">
                    <div class="row">
                        @foreach ($favourites as $favourite)
                            <x-service :service="$favourite->service"></x-service>
                        @endforeach
                    </div>
                </div>
            @endif
            
            
        </div>
    </div>
    <!-- job_listing_area_end  -->
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