@extends('layout')

@section('title', 'Building Together - Подрядчики')

@section('page-content')
    <x-page-header title="Подрядчики"></x-page-header>

    <!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            @if (count($users) === 0)
                <div class="row align-items-center">
                    <div class="section_title text-center col-12 p-5">
                        <h3>Похоже ещё нет ни одного подрядчика...</h3>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach ($users as $user)
                        <div class="col-md-6 col-lg-3">
                            <div class="single_candidates text-center">
                                <img src="/{{$user->avatar}}" style="width: 100px; height: 100px; object-fit:cover;" alt="">
                                <a href="{{route('profile-page',['id' => $user->id])}}"><h4>{{$user->name}}</h4></a>
                                <p>{{$user->email}}</p>
                                <p>{{$user->telephone}}</p>
                                <a class="delbtn" href="{{route('delprofile',['id' => $user->id])}}"> <i class="fa fa-trash"></i> </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- featured_candidates_area_end  -->
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection