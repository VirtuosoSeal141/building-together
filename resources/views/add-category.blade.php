@extends('layout')

@section('title', 'Building Together - Добавление категории')

@section('page-content')

<x-page-header title="Добавление категории"></x-page-header>

<section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Добавление категории</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="{{route('addcategory')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="category" id="category" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Название категории*'" placeholder = 'Название категории*' value="{{old('category')}}">
                  @error('category')
                    <span class="form__error">Введите название категории</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">Добавить</button>
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