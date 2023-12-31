@extends('layout')

@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <div id="halim_related_movies-2xx" class="wrap-slider">
        <div class="section-bar clearfix">
           <h3 class="section-title"><span>PHIM HOT</span></h3>
        </div>
        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
            @foreach ($movie_hot as $item)
                <article class="thumb grid-item post-38498">
                    <div class="halim-item">
                        <a class="halim-thumb" href="{{ route('home.movie', $item->slug) }}" title="{{$item->title}}">
                            <figure><img class="lazy img-responsive" src="{{ $item->image }}" alt="{{$item->slug}}" title="{{$item->title}}"></figure>
                            <span class="status">
                                @if ($item->resolution == 1)
                                    HD
                                @elseif ($item->resolution == 2)
                                    SD
                                @elseif ($item->resolution == 3)
                                    HDCam
                                @elseif ($item->resolution == 4)
                                    Cam
                                @elseif ($item->resolution == 5)
                                    Trailer
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
                            @if ($item->season!=0)
                                <span class="season"><i class="fa fa-play" aria-hidden="true"></i>
                                    Season {{$item->season}}
                                </span>
                            @endif
                            {{-- @if ($item->episode!=0)
                                <span class="season"><i class="fa fa-play" aria-hidden="true"></i>
                                    Full {{$item->episode}}/{{$item->episode}}
                                </span>
                            @endif --}}
                            <div class="icon_overlay"></div>
                            <div class="halim-post-title-box">
                            <div class="halim-post-title ">
                                <p class="entry-title">{{$item->title}}</p>
                                <p class="original_title">{{$item->title_english}}</p>
                            </div>
                            </div>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    {{-- <div class="col-xs-12 carausel-sliderWidget">
       <section id="halim-advanced-widget-4">
          <div class="section-heading">
             <a href="danhmuc.php" title="Phim Chiếu Rạp">
             <span class="h-text">Phim Chiếu Rạp</span>
             </a>
             <ul class="heading-nav pull-right hidden-xs">
                <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Chiếu Rạp"></span></li>
             </ul>
          </div>
          <div id="halim-advanced-widget-4-ajax-box" class="halim_box">
             <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">
                <div class="halim-item">
                   <a class="halim-thumb" href="{{ route('home.movie') }}" title="GÓA PHỤ ĐEN">
                      <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                      <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>
                      <div class="icon_overlay"></div>
                      <div class="halim-post-title-box">
                         <div class="halim-post-title ">
                            <p class="entry-title">GÓA PHỤ ĐEN</p>
                            <p class="original_title">Black Widow</p>
                         </div>
                      </div>
                   </a>
                </div>
             </article>
          </div>
       </section>
       <div class="clearfix"></div>
    </div> --}}
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <div class="section-bar clearfix">
            <div class="section-bar clearfix">
                <h3 class="section-title"><span>LỌC PHIM</span></h3>
             </div>
            <div class="row">
                <form action="{{ route('home.filterMovie') }}" method="GET">

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control style-filter" name="order" id="exampleFormControlSelect1">
                                <option value="">-Sắp xếp-</option>
                                <option value="date">Ngày đăng</option>
                                <option value="year_release">Năm sản xuất</option>
                                <option value="name_a_z">Tên phim</option>
                                <option value="views">Lượt xem</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control style-filter" name="genre" id="exampleFormControlSelect1">
                                <option value="">-Thể loại-</option>
                                @foreach ($genres as $item)
                                    <option value="{{$item->id}}"> {{$item->title}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control style-filter" name="country" id="exampleFormControlSelect1">
                                <option value="">-Quốc gia-</option>
                                @foreach ($countries as $item)
                                    <option value="{{$item->id}}"> {{$item->title}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control style-filter" name="year" id="exampleFormControlSelect1">
                                <option value="">-Năm-</option>
                                @for ($year = 2000; $year <= 2023; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-sm btn-default style-filter btn-filter" value="Lọc Phim">
                    </div>
                </form>
            </div>
        </div>


        @foreach ($categories_home as $category_home)
            <section id="halim-advanced-widget-2">
                <div class="section-heading">
                    <a href="#" title="{{ $category_home->title }}">
                    <span class="h-text"> {{ $category_home->title }} </span>
                    </a>
                </div>
                <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                    @foreach ($category_home->movies->take(12) as $item)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{ route('home.movie', $item->slug) }}">
                                    <figure><img class="lazy img-responsive" src="{{$item->image}}" alt="{{ $item->slug }}" title="{{ $item->title }}"></figure>
                                    <span class="status">
                                        @if ($item->resolution == 1)
                                            HD
                                        @elseif ($item->resolution == 2)
                                            SD
                                        @elseif ($item->resolution == 3)
                                            HDCam
                                        @elseif ($item->resolution == 4)
                                            Cam
                                        @elseif ($item->resolution == 5)
                                            Trailer
                                        @else
                                            FullHD
                                        @endif
                                    </span>

                                    <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                        @if ($item->sub == 1)
                                            Việt sub
                                            @if ($item->episode!=0)
                                            - {{$item->episode}}/{{$item->episode}} Tập
                                            @endif
                                        @else
                                            Thuyết minh
                                        @endif
                                    </span>

                                    @if ($item->season!=0)
                                        <span class="season"><i class="fa fa-play" aria-hidden="true"></i>
                                            Season {{$item->season}}
                                        </span>
                                    @endif

                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title"> {{ $item->title }} </p>
                                        <p class="original_title">{{ $item->title_english }}</p>
                                    </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
            <div class="clearfix"></div>
        @endforeach

    </main>

    @include('pages.sidebar')
</div>
@endsection


