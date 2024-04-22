@extends('layout')

@section('title', 'Building Together - Мои новости')

@section('page-content')
    <x-page-header title="Ваши новости"></x-page-header>

    <!--================Blog Area =================-->
    <section class="section-padding">
        <div class="container">
            @if (count($posts) === 0)
                <div class="row align-items-center">
                    <div class="section_title text-center col-12 p-5">
                        <h3>Похоже Вы ещё не опубликовали ни одну новость...</h3>
                    </div>
                    <div class="brouse_job text-center col-12">
                        <a href="{{route('addpost-page')}}" class="boxed-btn4">Добавить новость</a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12 mb-5 mb-lg-0">
                        @foreach ($posts as $post)
                            <x-post :post="$post"></x-post>
                        @endforeach
                    </div>
                </div>
            @endif
            
            
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection