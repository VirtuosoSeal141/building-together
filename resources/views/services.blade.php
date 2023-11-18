@extends('layout')

@section('title', 'Building Together - Услуги')

@section('page-content')
    <x-page-header title="Услуги"></x-page-header>

    <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>Фильтр</h3>
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <input type="text" placeholder="Поиск">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide">
                                                <option data-display="Категория">Категория</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="range_wrap">
                            <label for="amount">Цена:</label>
                            <div id="slider-range"></div>
                            <p>
                                <input type="text" id="amount" readonly style="border:0; color:#7A838B; font-size: 14px; font-weight:400;">
                            </p>
                        </div>
                        <div class="reset_btn">
                            <button  class="boxed-btn3 w-100" type="submit">Поиск</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4>Список услуг</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="serch_cat d-flex justify-content-end">
                                        <select>
                                            <option data-display="Популярное">Популярное</option>
                                            <option value="1">По заказам</option>
                                            <option value="2">По оценкам</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">
                            @foreach ($services as $service)
                                <x-service :service="$service"></x-service>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->
@endsection

@section('script')
<script src="/js/range.js"></script>

<script>
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 24600,
            values: [ 750, 24600 ],
            slide: function( event, ui ) {
                $( "#amount" ).val(ui.values[ 0 ] + "₽" + " - " + ui.values[ 1 ] + "₽");
            }
        });
        $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + "₽" +
            " - " + $( "#slider-range" ).slider( "values", 1 ) + "₽");
    } );
</script>

<script>
    var addFav = function ($id) {
        const btn = document.getElementById('btn'+$id);
        const icon = document.getElementById('icon'+$id);

        var request = new XMLHttpRequest();
        request.responseType = 'json';
        request.open('GET', '/addfavourite/' + $id);
        request.send();
        request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200){
                    btn.setAttribute('onclick', 'delFav('+$id+');');
                    icon.setAttribute('class', 'fa fa-heart');
                }
        }
    }
    var delFav = function ($id) {
        const btn = document.getElementById('btn'+$id);
        const icon = document.getElementById('icon'+$id);

        var request = new XMLHttpRequest();
        request.responseType = 'json';
        request.open('GET', '/delfavourite/' + $id);
        request.send();
        request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200){
                    btn.setAttribute('onclick', 'addFav('+$id+');');
                    icon.setAttribute('class', 'fa fa-heart-o');
                }
        }
    }
</script>
@endsection