@extends('layout')

@section('title', 'Building Together - Изменение услуги')

@section('page-content')

<x-page-header title="Изменение услуги"></x-page-header>

<section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Изменение вашей услуги</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="{{route('editservice', ['id' => $service->id])}}" method="post">
            @csrf
            <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input class="form-control" name="title" id="title" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Название услуги*'" placeholder = 'Название услуги*' value="{{$service->title}}">
                @error('title')
                  <span class="form__error">Это поле должно быть заполненно</span>
                @enderror
              </div>
            </div>
            <div class="col-12">
            <div class="form-group">
                <textarea class="form-control w-100" name="description" id="description" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Описание*'" placeholder = 'Описание*'>{{$service->description}}</textarea>
                @error('description')
                    <span class="form__error">Это поле должно быть заполненно</span>
                @enderror
            </div>
          </div>
            <div class="col-6">
              <div class="form-group">
                <input class="form-control" name="price" id="price" type="text" data-mask="money" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Цена*'" placeholder = 'Цена*' value="{{str_replace('.',',', $service->price)}}">
                @error('price')
                    <span class="form__error">Это поле должно быть заполненно</span>
                @enderror
                @error('price_error')
                    <span class="form__error">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                  <select class="form-select form-control" name="unit" id="unit">
                      <option data-display="Единица измерения*" selected disabled>Единица измерения*</option>
                      @foreach($units as $unit)
                          <option value="{{$unit->id}}">{{$unit->measure}}</option>
                      @endforeach
                  </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                  <select class="form-select form-control" name="category" id="category">
                      <option data-display="Категория*" selected disabled>Категория*</option>
                      @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->title}}</option>
                      @endforeach
                  </select>
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
    <script src="/js/imask.js"></script>
@endsection