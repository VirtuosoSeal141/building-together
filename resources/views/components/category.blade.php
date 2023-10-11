<div class="col-lg-4 col-xl-3 col-md-6">
    <div class="single_catagory">
        <a href="#"><h4>{{$category->title}}</h4></a>
        <p> 
            <span>{{count($category->services)}}</span> 
            @if (count($category->services)==1)
                услуга
            @elseif (count($category->services)==2)
                услуги
            @else
                услуг
            @endif
        </p>
    </div>
</div>