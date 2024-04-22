@extends('layout')

@section('title', 'Building Together - Изменение новости')

@section('page-content')

<x-page-header title="Изменение новости"></x-page-header>

<section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Изменение вашей новости</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="{{route('editpost', ['id' => $post->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="title" id="title" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Заголовок новости*'" placeholder = 'Заголовок новости*' value="{{$post->title}}">
                  @error('title')
                    <span class="form__error">Это поле должно быть заполненно</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control w-100" name="description" id="description" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Описание*'" placeholder = 'Описание*'>{{$post->description}}</textarea>
                    @error('description')
                        <span class="form__error">Это поле должно быть заполненно</span>
                    @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                <label class="input-file">
                    <input type="file" name="image" id="image">		
                    <span>Изменить картинку</span>
                </label>
                  @error('image')
                    <span class="form__error">Неверный формат</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">Изменить</button>
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