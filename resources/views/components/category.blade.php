<div class="col-lg-4 col-xl-3 col-md-6">
    <div class="single_catagory">
        <a href="#"><h4>{{$category->title}}</h4></a>
        <p> 
            <span>{{count($category->services)}}</span> 
            @if (count($category->services) == 1)
                услуга
            @elseif (count($category->services) > 1 && count($category->services) < 5)
                услуги
            @elseif (count($category->services) == 0 || count($category->services) > 4)
                услуг
            @endif
        </p>
        <a class="delbtn" href="{{route('delcategory', ['id' => $category->id])}}" style="margin-top: 15px;"> <i class="fa fa-trash"></i> </a>
    </div>
</div>