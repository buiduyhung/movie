@extends('layout')

@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{ route('home.category', $movie->category->slug) }}"> {{ $movie->category->title }} </a> » <span><a href="{{ route('home.country', $movie->country->slug) }}"> {{ $movie->country->title }} </a> » <span class="breadcrumb_last" aria-current="page"> {{ $movie->title }} </span></span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section id="content" class="test">
            <div class="clearfix wrap-content">

                <div class="halim-movie-wrapper">
                    <div class="title-block">
                    <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                        <div class="halim-pulse-ring"></div>
                    </div>
                    <div class="title-wrapper" style="font-weight: bold;">
                        Bookmark
                    </div>
                    </div>
                    <div class="movie_info col-xs-12">
                    <div class="movie-poster col-md-3">
                        <img class="movie-thumb" src="{{ $movie->image }}" alt="{{ $movie->slug }}">
                        @if ($movie->resolution!=5)
                            <div class="bwa-content">
                                <div class="loader"></div>
                                @if ($episode_first) <!-- Kiểm tra xem episode_first có tồn tại -->
                                    <a href="{{ url('xem-phim/'.$movie->slug.'/tap-'.$episode_first->episode) }}" class="bwac-btn">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endif
                            </div>
                        @endif

                    </div>
                    <div class="film-poster col-md-9">

                            <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;"> {{ $movie->title }} </h1>
                            <h2 class="movie-title title-2" style="font-size: 12px;"> {{ $movie->title_english }} </h2>
                            <ul class="list-info-group">
                                <li class="list-info-group-item"><span>Trạng Thái</span> :
                                    <span class="quality">
                                        @if ($movie->resolution == 1)
                                            HD
                                        @elseif ($movie->resolution == 2)
                                            SD
                                        @elseif ($movie->resolution == 3)
                                            HDCam
                                        @elseif ($movie->resolution == 4)
                                            Cam
                                        @elseif ($movie->resolution == 5)
                                            Trailer
                                        @else
                                            FullHD
                                        @endif
                                    </span>
                                    @if ($movie->resolution!=5)
                                        <span class="episode">
                                            @if ($movie->sub == 1)
                                                Việt sub
                                            @else
                                                Thuyết minh
                                            @endif
                                        </span>
                                    @endif
                                </li>
                                @if ($movie->episode!=0)
                                    <li class="list-info-group-item"><span>Tập phim</span> : {{$episode_list_count}}/{{$movie->episode}} -
                                        @if ($episode_list_count == $movie->episode)
                                            Hoàn thành
                                        @else
                                            Đang cập nhật
                                        @endif
                                    </li>
                                @endif
                                <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->time}} </li>
                                @if ($movie->season!=0)
                                    <li class="list-info-group-item"><span>Season</span> : {{$movie->season}} </li>
                                @endif
                                <li class="list-info-group-item"><span>Thể loại</span> :
                                    @foreach ($movie->movie_genre as $item)
                                        <a href="{{ route('home.genre', $item->slug) }}" rel="category tag">{{$item->title}} |</a>
                                    @endforeach
                                </li>
                                <li class="list-info-group-item"><span>Danh mục</span> :
                                    <a href="{{ route('home.category', $movie->category->slug) }}" rel="category tag">{{ $movie->category->title }}</a>
                                </li>
                                <li class="list-info-group-item"><span>Quốc gia</span> :
                                    <a href="{{ route('home.country', $movie->country->slug) }}" rel="tag"> {{ $movie->country->title }} </a>
                                </li>

                                <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                                    @if ($episode_list_count > 0)
                                        @if ($movie->belong_category == 'phimbo')
                                            @foreach ($episodes as $item)
                                                <a href="{{ url('xem-phim/'.$item->movie->slug.'/tap-'.$item->episode) }}" rel="tag">Tập {{ $item->episode }} |</a>
                                            @endforeach
                                        @elseif($movie->belong_category == 'phimle')
                                            @foreach ($episodes as $item)
                                                <a href="{{ url('xem-phim/'.$item->movie->slug.'/tap-'.$item->episode) }}" rel="tag">{{ $item->episode }}</a>
                                            @endforeach
                                        @endif
                                    @else
                                        Đang cập nhật
                                    @endif
                                </li>

                            </ul>
                        <div class="movie-trailer hidden"></div>
                    </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div id="halim_trailer"></div>
                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            <p> {!! $movie->description !!} </p>

                            @if ($movie->trailer)
                                <iframe width="100%" height="500px" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            @endif
                        </article>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Tags</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            @if ($movie->tag != NULL)
                                @php
                                    $tags = array();
                                    $tags = explode(',', $movie->tag);
                                @endphp
                                @foreach ($tags as $tag)
                                    <a href="{{route('home.tag', $tag)}}">{{$tag}}</a>
                                @endforeach
                            @else
                                {{$movie->title}}
                            @endif
                        </article>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                    <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                </div>
                {{-- <div class="entry-content htmlwrap clearfix">
                    <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                            <div class="fb-comments" data-href="http://127.0.0.1:8000/phim/ca-map-sieu-bao-chua-2%20-vuc-sau" data-width="" data-numposts="5"></div>
                        </article>
                    </div>
                </div> --}}
            </div>
        </section>
       <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                @foreach ($related as $item)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                        <a class="halim-thumb" href="{{ route('home.movie', $item->slug) }}" title="{{ $item->title }}">
                            <figure><img class="lazy img-responsive" src="{{ $item->image }}" alt="{{ $item->slug }}" title="{{ $item->title }}"></figure>
                            <span class="status">
                                @if ($item->resolution == 1)
                                    HD
                                @elseif ($item->resolution == 2)
                                    SD
                                @elseif ($item->resolution == 3)
                                    HDCam
                                @elseif ($item->resolution == 4)
                                    Cam
                                @else
                                    FullHD
                                @endif
                            </span>
                            <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                @if ($item->sub == 1)
                                    Việt sub
                                @else
                                    Thuyết minh
                                @endif
                            </span>
                            <div class="icon_overlay"></div>
                            <div class="halim-post-title-box">
                                <div class="halim-post-title ">
                                    <p class="entry-title">{{ $item->title }}</p>
                                    <p class="original_title">{{ $item->title_english }}</p>
                                </div>
                            </div>
                        </a>
                        </div>
                    </article>
                @endforeach

             </div>
             <script>
                $(document).ready(function($) {
                var owl = $('#halim_related_movies-2');
                owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
             </script>
          </div>
       </section>
    </main>
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4"></aside>
    @include('pages.sidebar')
 </div>


@endsection
