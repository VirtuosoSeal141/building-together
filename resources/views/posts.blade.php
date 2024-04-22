@extends('layout')

@section('title', 'Building Together - Новости')

@section('page-content')
    <x-page-header title="Новости"></x-page-header>

    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @if (count($posts) === 0)
                            <div class="row align-items-center">
                                <div class="section_title text-center col-12 p-5">
                                    <h3>Не найдена ни одна новость...</h3>
                                </div>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <x-post :post="$post"></x-post>
                            @endforeach

                            @if ($posts->hasPages())
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pagination_wrap">
                                            <ul>
                                                @if (!$posts->onFirstPage())
                                                    <li><a href="{{ $posts->previousPageUrl() }}"> <i class="ti-angle-left"></i> </a></li>
                                                @endif
                                                <li><p> {{ $posts->currentPage() }} </p></li>
                                                @if (!$posts->onLastPage())
                                                    <li><a href="{{ $posts->nextPageUrl() }}"> <i class="ti-angle-right"></i> </a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="{{route('search')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input name="search" type="text" class="form-control" placeholder='Введите заголовок'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Введите заголовок'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Поиск</button>
                            </form>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection