<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="{{route('main-page')}}">
                                    <img src="/img/logo.png" alt="">
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
                                                <li><a href="{{route('posts-page')}}">Новости <i class="ti-angle-down"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="{{route('myposts-page')}}">Мои новости</a></li>
                                                        <li><a href="{{route('addpost-page')}}">Добавить новость</a></li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="{{route('posts-page')}}">Новости</a></li>
                                            @endif
                                            @if(Auth::user()->role->title == "Подрядчик")
                                                <li><a href="{{route('services-page')}}">Услуги <i class="ti-angle-down"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="{{route('myservices-page')}}">Мои услуги</a></li>
                                                        <li><a href="{{route('addservice-page')}}">Добавить услугу</a></li>
                                                    </ul>
                                                </li>
                                            @elseif(Auth::user()->role->title == "Администратор")
                                                <li><a href="{{route('services-page')}}">Услуги <i class="ti-angle-down"></i></a>
                                                    <ul class="submenu">
                                                        <li><a href="{{route('addcategory-page')}}">Добавить категорию</a></li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="{{route('services-page')}}">Услуги</a></li>
                                            @endif
                                            <li><a href="{{route('contacts-page')}}">Контакты</a></li>
                                            <li><a href="#">Еще <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    @if(Auth::user()->role->title !== "Администратор")
                                                        <li><a href="{{route('orders-page')}}">Заказы</a></li>
                                                    @endif
                                                    @if(Auth::user()->role->title == "Клиент")
                                                        <li><a href="{{route('favourites-page')}}">Избранное</a></li>
                                                    @endif
                                                    @if(Auth::user()->role->title == "Администратор")
                                                        <li><a href="{{route('profiles-page')}}">Пользователи</a></li>
                                                    @endif
                                                    @if(Auth::user()->role->title !== "Администратор")
                                                        <li><a href="{{route('settings-page')}}">Настройки</a></li>
                                                    @endif
                                                    <li><a href="{{route('logout')}}">Выйти</a></li>
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{route('posts-page')}}">Новости</a></li>
                                            <li><a href="{{route('services-page')}}">Услуги</a></li>
                                            <li><a href="{{route('contacts-page')}}">Контакты</a></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @if(!Auth::user())
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{route('login-page')}}">Вход</a></li>
                                            <li><a href="#">Регистрация <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{route('signup-page', [3])}}">Клиент</a></li>
                                                    <li><a href="{{route('signup-page', [2])}}">Подрядчик</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @else
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <!-- <li><i class="fa fa-commenting white"></i> <a href="{{route('chats-page')}}">Мессенджер</a></li> -->
                                            @if (Auth::user()->role->title !== "Администратор")
                                                <li><i class="fa fa-money white"></i> <a href="{{route('wallet-page')}}">{{Auth::user()->balance}} ₽</a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>