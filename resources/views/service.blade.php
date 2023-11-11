@extends('layout')

@section('title', 'Building Together')

@section('page-content')
    <x-page-header title="Ваши услуги"></x-page-header>

    <div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <img class="mr-4" src="/{{$service->user->avatar}}" style="width: 80px; height: 80px;" alt="">
                                <div class="jobs_conetent">
                                    <a href="#"><h4>{{$service->title}}</h4></a>
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
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Описание услуги</h4>
                            <p></p>
                        </div>
                        @if (count($reviews) !== 0)
                            <div class="comments-area">
                                <h4>{{count($reviews)}} отзыва</h4>
                                @foreach ($reviews as $review)
                                    <x-comment :review="$review"></x-comment>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    @if (Auth::user() && Auth::user()->role->title === "Клиент")
                        <div class="apply_job_form white-bg">
                            <div class="col-12">
                                <h4 class="contact-title">Оставьте свой отзыв</h4>
                            </div>
                            <form class="form-contact contact_form" action="#" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Комментарий'" placeholder = 'Комментарий'></textarea>
                                            @error('comment')
                                                <span class="form__error">Введите комментарий</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm btn_4 boxed-btn">Отправить</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Published on: <span>12 Nov, 2019</span></li>
                                <li>Vacancy: <span>2 Position</span></li>
                                <li>Salary: <span>50k - 120k/y</span></li>
                                <li>Location: <span>California, USA</span></li>
                                <li>Job Nature: <span> Full-time</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Share at:</span>
                        <ul>
                            <li><a href="#"> <i class="fa fa-facebook"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-google-plus"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-twitter"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-envelope"></i></a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection