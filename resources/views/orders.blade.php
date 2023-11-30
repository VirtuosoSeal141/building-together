@extends('layout')

@section('title', 'Building Together - Заказы')

@section('page-content')
    <x-page-header title="Заказы"></x-page-header>

    <!-- job_listing_area_start  -->
    <div class="job_listing_area">
        <div class="container">
            @if (count($orders) === 0)
                <div class="row align-items-center">
                    <div class="section_title text-center col-12 p-5">
                        <h3>Похоже у Вас ещё нет заказов...</h3>
                    </div>
                    <div class="brouse_job text-center col-12">
                        <a href="{{route('services-page')}}" class="boxed-btn4">Услуги</a>
                    </div>
                </div>
            @else
                <div class="row align-items-center pt-5">
                    <div class="col-lg-6">
                        <div class="section_title">
                            <h3>Список заказов</h3>
                        </div>
                    </div>
                </div>
                <div class="job_lists">
                    <div class="row">
                        @foreach ($orders as $order)
                            <x-order :order="$order"></x-order>
                        @endforeach
                    </div>
                </div>
            @endif
            
            
        </div>
    </div>
    <!-- job_listing_area_end  -->
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection