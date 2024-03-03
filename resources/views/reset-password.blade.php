@extends('layout')

@section('title', 'Building Together - Восстановление пароля')

@section('page-content')

<x-page-header title="Восстановление пароля"></x-page-header>

<section class="contact-section section_padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Восстановление пароля</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="{{route('resetpassword')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" type="hidden" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Почта*'" placeholder = 'Почта*' value="{{$email}}">
                                <input class="form-control" name="token" id="token" type="hidden" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Токен*'" placeholder = 'Токен*' value="{{$token}}">
                                <input class="form-control" name="password" id="password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Новый пароль*'" placeholder = 'Новый пароль*' value="{{old('password')}}">
                                @error('password')
                                    <span class="form__error">Введите новый пароль</span>
                                @enderror
                            </div>
                        </div>
                        @error('post_error')
                            <span class="form__error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm btn_4 boxed-btn">Сохранить</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>+7 (917) 553-71-07</h3>
                        <p>Пн - Сб, 9:00 - 21:00</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>buildtogether@yandex.ru</h3>
                        <p>Отвечаем в любое время!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection