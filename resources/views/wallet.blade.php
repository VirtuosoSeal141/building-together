@extends('layout')

@section('title', 'Building Together - Кошелёк')

@section('page-content')

<x-page-header title="Кошелёк"></x-page-header>

<section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        @if (Auth::user()->role->title === "Клиент")
          <div class="col-lg-6">
            <form class="form-contact contact_form" action="{{route('plus')}}" method="post">
              @csrf
              <div class="row">
                <div class="col-12">
                  <h2 class="contact-title">Пополнение баланса</h2>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input class="form-control" name="plus" id="plus" type="text" data-mask="money" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Сумма*'" placeholder = 'Сумма*' value="{{old('money')}}">
                    @error('plus')
                      <span class="form__error">Введите сумму</span>
                    @enderror
                    @error('plus_error')
                        <span class="form__error">{{$message}}</span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group mt-3">
                <button type="submit" class="button button-contactForm btn_4 boxed-btn">Пополнить</button>
              </div>
            </form>
          </div>
        @endif
        <div class="col-lg-6">
          <form class="form-contact contact_form" action="{{route('minus')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <h2 class="contact-title">Снятие денег</h2>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="minus" id="minus" type="text" data-mask="money" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Сумма*'" placeholder = 'Сумма*' value="{{old('money')}}">
                  @error('minus')
                    <span class="form__error">Введите сумму</span>
                  @enderror
                  @error('minus_error')
                      <span class="form__error">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm btn_4 boxed-btn">Снять</button>
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