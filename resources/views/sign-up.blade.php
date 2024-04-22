@extends('layout')

@section('title', 'Building Together - Регистрация')

@section('page-content')

<x-page-header title="Регистрация"></x-page-header>

<section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Зарегистрироваться как {{$role->title}}</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="{{route('signup', [$role->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '@if ($role->id === 2)Название компании@elseИмя@endif*'" placeholder = '@if ($role->id === 2)Название компании@elseИмя@endif*' value="{{old('name')}}">
                  @error('name')
                    <span class="form__error">Введите @if ($role->title === "Подрядчик")название компании@elseимя@endif</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Почта*'" placeholder = 'Почта*' value="{{old('email')}}">
                  @error('email')
                    <span class="form__error">Введите почту</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="password" id="password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Пароль*'" placeholder = 'Пароль*' value="{{old('password')}}">
                  @error('password')
                      <span class="form__error">Введите пароль</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="telephone" id="telephone" type="text" data-mask="telephone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Телефон*'" placeholder = 'Телефон*' value="{{old('telephone')}}">
                  @error('telephone')
                    <span class="form__error">Введите телефон</span>
                  @enderror
                </div>
              </div>
              @if ($role->id === 2)
                <div class="col-4">
                <div class="form-group">
                  <input class="form-control" name="found" id="found" type="text" data-mask="date" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Дата основания*'" placeholder = 'Дата основания*' value="{{old('found')}}">
                  @error('found')
                    <span class="form__error">Введите дату основания</span>
                  @enderror
                </div>
              </div>
              <div class="col-8">
                <div class="form-group">
                <label class="input-file">
                    <input type="file" name="avatar" id="avatar">		
                    <span>Добавить логотип</span>
                </label>
                  @error('avatar')
                    <span class="form__error">Добавьте логотип</span>
                  @enderror
                </div>
              </div>
              @endif
              
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">Зарегистрироваться</button>
              <a class="dop-btn" href="{{route('login-page')}}">Уже есть аккаунт</a>
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
    <script src="/js/imask.js"></script>
@endsection