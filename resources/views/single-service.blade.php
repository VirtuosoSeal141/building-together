@extends('layout')

@section('title', 'Building Together - Услуга')

@section('page-content')
    <x-page-header title="{{$service->title}}"></x-page-header>

    <div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="@if (Auth::user() && Auth::user()->role->title === 'Клиент')col-lg-8 @else col-lg-12 @endif">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <img class="mr-4" src="/{{$service->user->avatar}}" style="width: 80px; height: 80px; object-fit:cover;" alt="">
                                <div class="jobs_conetent">
                                    <a href="#"><h4>{{$service->title}}</h4></a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-money"></i> <span class="price">{{$service->price}}</span> ₽/{{$service->unit->measure}}</p>
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Описание услуги</h4>
                            <p>{{$service->description}}</p>
                        </div>
                        @if (count($reviews) !== 0)
                            <div class="comments-area">
                                <h4>Отзывы ({{count($reviews)}})</h4>
                                @foreach ($reviews as $review)
                                    <x-comment :review="$review"></x-comment>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    @if (Auth::user() && Auth::user()->role->title === "Клиент" && Auth::user()->checkRev($service->id) && Auth::user()->checkOrder($service->id))
                        <div class="apply_job_form white-bg">
                            <div class="col-12">
                                <h4 class="contact-title">Оставьте свой отзыв</h4>
                            </div>
                            <form class="form-contact contact_form" action="{{route('addcomment', ['id' => $service->id])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Комментарий*'" placeholder = 'Комментарий*'>{{old('comment')}}</textarea>
                                            @error('comment')
                                                <span class="form__error">Введите комментарий</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="rating-area">
                                            <input type="radio" id="star-5" name="rating" value="5">
                                            <label for="star-5" title="Оценка «5»"></label>	
                                            <input type="radio" id="star-4" name="rating" value="4">
                                            <label for="star-4" title="Оценка «4»"></label>    
                                            <input type="radio" id="star-3" name="rating" value="3">
                                            <label for="star-3" title="Оценка «3»"></label>  
                                            <input type="radio" id="star-2" name="rating" value="2">
                                            <label for="star-2" title="Оценка «2»"></label>    
                                            <input type="radio" id="star-1" name="rating" value="1">
                                            <label for="star-1" title="Оценка «1»"></label>
                                        </div>
                                        @error('rating')
                                            <span class="form__error">Выберите оценку</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm btn_4 boxed-btn">Отправить</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                @if (Auth::user() && Auth::user()->role->title === "Клиент")
                    <div class="col-lg-4">
                        <div class="job_sumary">
                            <div class="summery_header">
                                <form action="{{route('addorder', ['id' => $service->id])}}" method="post" class="form-contact contact_form row">
                                    @csrf
                                    <input class="form-control col-8" name="quantity" id="quantity" type="text" data-mask="quantity" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Объем работы ({{$service->unit->measure}})*'" placeholder = 'Объем работы ({{$service->unit->measure}})*' value="{{old('quantity')}}">
                                    <button class="col-4 paybtn" type="submit">Оплатить</button>
                                    @error('quantity')
                                        <span class="form__error">Введите объем работы</span>
                                    @enderror
                                    @error('money')
                                        <span class="form__error">{{$message}}</span>
                                    @enderror
                                </form>
                            </div>
                            <div class="job_content">
                                <ul>
                                    <li>Итого к оплате: <span class="cost">0 ₽</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="share_wrap d-flex">
                            <span>Связаться с нами:</span>
                            <ul>
                                <li><a href="#"> <i class="fa fa-envelope"></i></a> </li>
                            </ul>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
    <script src="/js/imask.js"></script>
    <script>
        const price = parseInt(document.querySelector('.price').innerText);
        const quantity = document.getElementById('quantity');
        const cost = document.querySelector('.cost');

        quantity.oninput = function(){
            cost.innerText = price*quantity.value + " ₽";
        }
    </script>
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