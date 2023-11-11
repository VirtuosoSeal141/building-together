@extends('layout')

@section('title', 'Building Together')

@section('page-content')
    <x-page-header title="Контакты"></x-page-header>

    <section class="contact-section section_padding">
    <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">
            <div id="map" style="height: 480px;"><iframe class="w-100 h-100"
                            src="https://yandex.ru/map-widget/v1/?um=constructor%3A35b0f151e51dc45eb34361941b7c81eeaf0853035e80653a5aa5d062d0bb0c52&amp;source=constructor"
                            frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>

        <div class="row">
            <div class="media contact-info col-6">
                <span class="contact-info__icon"><i class="ti-home"></i></span>
                <div class="media-body">
                    <h3>Варшавское шосее, 21-й километр, с1, офис 424</h3>
                    <p>Пн - Сб, 9:00 - 18:00</p>
                </div>
            </div>
            <div class="media contact-info col-3">
                <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                <div class="media-body">
                    <h3>+7 (917) 553-71-07</h3>
                    <p>Пн - Сб, 9:00 - 21:00</p>
                </div>
            </div>
            <div class="media contact-info col-3">
                <span class="contact-info__icon"><i class="ti-email"></i></span>
                <div class="media-body">
                    <h3>buildtogether@yandex.ru</h3>
                    <p>Отвечаем в любое время!</p>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection