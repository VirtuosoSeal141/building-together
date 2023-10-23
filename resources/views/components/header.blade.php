<header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="{{route('main-page')}}">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{route('main-page')}}">Главная</a></li>
                                            @if(Auth::user())
                                                @if(Auth::user()->role->title == "Подрядчик")
                                                    <li><a href="{{route('services-page')}}">Услуги <i class="ti-angle-down"></i></a>
                                                        <ul class="submenu">
                                                            <li><a href="#">Мои услуги</a></li>
                                                            <li><a href="#">Добавить услугу</a></li>
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><a href="{{route('services-page')}}">Услуги</a></li>
                                                @endif
                                                <li><a href="#">Чаты</a></li>
                                                <li><a href="#">Еще <i class="ti-angle-down"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="#">Личный кабинет</a></li>
                                                        <li><a href="#">Настройки</a></li>
                                                        <li><a href="{{route('logout')}}">Выйти</a></li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="{{route('services-page')}}">Услуги</a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    @if(!Auth::user())
                                        <div class="phone_num d-none d-xl-block">
                                            <a href="{{route('login-page')}}">Вход</a>
                                        </div>
                                        <div class="d-none d-lg-block">
                                            <a class="boxed-btn3" href="#">Регистрация</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>