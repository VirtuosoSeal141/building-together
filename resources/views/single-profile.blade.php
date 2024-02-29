@extends('layout')

@section('title', 'Building Together - Настройки подрядчика')

@section('page-content')

<x-page-header title="Настройки {{$user->name}}"></x-page-header>

<section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <form class="form-contact contact_form" action="{{route('profilesettings',['id' => $user->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Личные данные</h2>
            </div>
            <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Название компании*'" placeholder = 'Название компании*' value="{{$user->name}}">
                  @error('name')
                    <span class="form__error">Это поле должно быть заполненно</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Почта*'" placeholder = 'Почта*' value="{{$user->email}}">
                  @error('email')
                    <span class="form__error">Это поле должно быть заполненно</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="telephone" id="telephone" type="text" data-mask="telephone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Телефон*'" placeholder = 'Телефон*' value="{{$user->telephone}}">
                  @error('telephone')
                    <span class="form__error">Это поле должно быть заполненно</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                <label class="input-file ">
                    <input type="file" name="avatar" id="avatar">
                    <span>Изменить логотип</span>
                </label>
                  @error('avatar')
                    <span class="form__error">Неверный формат</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">Сохарнить</button>
            </div>
          </form>
        </div>

        <div class="col-lg-6">
          <form class="form-contact contact_form" action="{{route('passwordprofile',['id' => $user->id])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Сменить пароль</h2>
                </div>
                <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="newpassword" id="newpassword" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Новый пароль*'" placeholder = 'Новый пароль*' value="{{old('newpassword')}}">
                  @error('newpassword')
                      <span class="form__error">Введите новый пароль</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="repeatpassword" id="repeatpassword" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Повторите новый пароль*'" placeholder = 'Повторите новый пароль*' value="{{old('repeatpassword')}}">
                  @error('repeatpassword')
                      <span class="form__error">Повторите новый пароль</span>
                  @enderror
                  @error('password_error')
                      <span class="form__error">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">Сохарнить</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
    <script src="/js/imask.js"></script>
@endsection