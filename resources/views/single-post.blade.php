@extends('layout')

@section('title', 'Building Together - Новость')

@section('page-content')
    <x-page-header title="{{$post->title}}"></x-page-header>

    <!--================Blog Area =================-->
   <div class="single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="@if(count($otherposts) !== 0) col-lg-8 @else col-lg-12 @endif posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" style="height: 410px; object-fit:scale-down;" src="/{{$post->image}}" alt="">
                  </div>
                  <div class="blog_details">
                     <h2>{{$post->title}}</h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        @if (Auth::user() && $post->user_id == Auth::id() || Auth::user() && Auth::user()->role->title == "Администратор")
                            @if (Auth::user()->role->title == "Администратор")
                                <li><a href="#"><i class="fa fa-user"></i> {{$post->user->name}}</a></li>
                            @endif
                            <li><a href="{{route('editpost-page', ['id'=>$post->id])}}"><i class="fa fa-pencil"></i> Изменить</a></li>
                        @else
                            <li><a href="#"><i class="fa fa-user"></i> {{$post->user->name}}</a></li>
                        @endif
                     </ul>
                     <p>{{$post->description}}</p>
                  </div>
               </div>
                @if (count($comments) !== 0)
                    <div class="comments-area">
                        <h4>Комментарии ({{count($comments)}})</h4>
                        @foreach ($comments as $comment)
                            <x-comment :comment="$comment"></x-comment>
                        @endforeach
                    </div>
                @endif

                @if (Auth::user() && Auth::user()->role->title === "Клиент" && Auth::user()->checkCom($post->id))
                    <div class="apply_job_form white-bg">
                        <div class="col-12">
                            <h4 class="contact-title">Оставьте свой комментарий</h4>
                        </div>
                        <form class="form-contact contact_form" action="{{route('addcomment', ['id' => $post->id])}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Комментарий*'" placeholder = 'Комментарий*'>{{old('comment')}}</textarea>
                                        @error('comment')
                                            <span class="form__error">Введите комментарий</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_4 boxed-btn">Отправить</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            @if (count($otherposts) !== 0)
                <div class="col-lg-4">
                    <div class="blog_area blog_right_sidebar">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Другие новости</h3>
                            @foreach ($otherposts as $otherpost)
                                <div class="media post_item">
                                    <img style="width: 80px; height: 80px; object-fit:cover;" src="/{{$otherpost->image}}" alt="post">
                                    <div class="media-body">
                                        <a href="{{route('post-page', ['id'=>$otherpost->id])}}">
                                            <h3>{{Str::limit($otherpost->title, 30)}}</h3>
                                        </a>
                                        <p>{{date('d.m.Y',strtotime($post->publication_date))}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                    </div>
                </div>
            @endif
        </div>
    </div>
   </div>
   <!--================ Blog Area end =================-->
@endsection

@section('script')
    <script src="/js/gijgo.min.js"></script>
@endsection