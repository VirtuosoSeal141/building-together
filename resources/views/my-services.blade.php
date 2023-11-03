@extends('layout')

@section('title', 'Building Together')

@section('page-content')
    <x-page-header title="Ваши услуги"></x-page-header>

    <!-- job_listing_area_start  -->
    <div class="job_listing_area">
        <div class="container">
            @if (count($services) === 0)
                <div class="row align-items-center">
                    <div class="section_title text-center col-12 p-5">
                        <h3>Похоже Вы ещё не добавили ни одну услугу...</h3>
                    </div>
                    <div class="brouse_job text-center col-12">
                        <a href="{{route('addservice-page')}}" class="boxed-btn4">Добавить услугу</a>
                    </div>
                </div>
            @else
                <div class="row align-items-center pt-5">
                    <div class="col-lg-6">
                        <div class="section_title">
                            <h3>Список ваших услуг</h3>
                        </div>
                    </div>
                </div>
                <div class="job_lists">
                    <div class="row">
                        @foreach ($services as $service)
                            <x-service :service="$service"></x-service>
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