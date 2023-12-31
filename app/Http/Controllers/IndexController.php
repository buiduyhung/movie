<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Watch;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();

        $movie_hot = Movie::where('hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();

        $categories_home = Category::with('movies')->where('status', 1)->get();

        return view('pages.home', compact('categories', 'genres', 'countries', 'categories_home', 'movie_hot', 'moviehot_sidebar', 'movie_trailer'));
    }

    // Hàm tìm kiếm
    public function search(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];

            $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
            $genres = Genre::all();
            $countries = Country::all();
            $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
            $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

            $movie = Movie::where('title','LIKE', '%'.$search.'%' )->orderBy('updated_at', 'DESC')->paginate(20);

            return view('pages.search', compact('categories', 'genres', 'countries', 'moviehot_sidebar', 'movie_trailer', 'movie', 'search'));
        }else{
            redirect()->route('home.index');
        }

    }

    // Hàm lọc phim
    public function filterMovie(){
        $sort = $_GET['order'];
        $genre = $_GET['genre'];
        $country = $_GET['country'];
        $year = $_GET['year'];

        if($sort == '' && $genre == '' && $country == '' && $year ==''){
            return redirect()->back();
        }else{
            $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
            $genres = Genre::all();
            $countries = Country::all();
            $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
            $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

            $movies = Movie::withCount('episodes')->orWhere('country_id', $country)->orWhere('genre_id', $genre)->orWhere('year', $year)->orderBy('updated_at', 'DESC')->paginate(20);

            return view('pages.filter', compact('categories', 'genres', 'countries', 'moviehot_sidebar', 'movie_trailer', 'movies'));
        }

    }

    public function category($slug){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

        $category_slug = Category::where('slug', $slug)->first();
        $movie = Movie::where('category_id', $category_slug->id)->withCount('episodes')->orderBy('updated_at', 'DESC')->paginate(20);


        return view('pages.category', compact('categories', 'genres', 'countries', 'category_slug', 'movie', 'moviehot_sidebar', 'movie_trailer'));
    }

    public function year($year){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

        $year = $year;
        $movie = Movie::where('year', $year)->orderBy('updated_at', 'DESC')->paginate(20);

        return view('pages.year', compact('categories', 'genres', 'countries', 'year', 'movie', 'moviehot_sidebar', 'movie_trailer'));
    }

    public function tag($tag){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

        $tag = $tag;
        $movie = Movie::where('tag', 'LIKE', '%'.$tag.'%')->orderBy('updated_at', 'DESC')->paginate(20);

        return view('pages.tag', compact('categories', 'genres', 'countries', 'tag', 'movie', 'moviehot_sidebar', 'movie_trailer'));
    }

    public function genre($slug){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

        $genre_slug = Genre::where('slug', $slug)->first();

        // Nhiều thể loại
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $item){
            $many_genre[] = $item->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->orderBy('updated_at', 'DESC')->paginate(20);

        return view('pages.genre', compact('categories', 'genres', 'countries', 'genre_slug', 'movie', 'moviehot_sidebar', 'movie_trailer'));
    }

    public function country($slug){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

        $country_slug = Country::where('slug', $slug)->first();
        $movie = Movie::where('country_id', $country_slug->id)->orderBy('updated_at', 'DESC')->paginate(20);

        return view('pages.country', compact('categories', 'genres', 'countries', 'country_slug', 'movie', 'moviehot_sidebar', 'movie_trailer'));
    }

    public function movie($slug){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution',[5])->orderBy('updated_at', 'DESC')->take(8)->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

        $movie = Movie::where('slug',$slug)->where('status', 1)->first();
        $related = Movie::where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->inRandomOrder()->get();

        //lấy tập phim đầu
        $episode_first = Episode::where('movie_id', $movie->id)->orderBy('episode', 'ASC')->first();

        //lấy danh sách 3 tập phim mới nhất
        $episodes = Episode::where('movie_id', $movie->id)->orderBy('episode', 'DESC')->take(3)->get();

        //lấy tổng tập phim đã thêm
        $episode_list = Episode::where('movie_id', $movie->id)->get();
        $episode_list_count = $episode_list->count();


        return view('pages.movie', compact('categories', 'genres', 'countries', 'movie', 'related', 'moviehot_sidebar', 'movie_trailer', 'episodes', 'episode_first', 'episode_list_count'));
    }

    public function watch($slug, $tap){
        // Kiểm tra nếu không có giá trị tập phim, mặc định là tập 1
        $episode = isset($tap) ? substr($tap, 4, 20) : 1;

        // Lấy danh sách thể loại, thể loại phim, quốc gia
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();

        // Lấy danh sách phim hot và phim trailer
        $moviehot_sidebar = Movie::where('hot', 1)->where('status', 1)->whereNotIn('resolution', [5])->orderBy('updated_at', 'DESC')->take(8)->get();
        $movie_trailer = Movie::where('hot', 1)->where('status', 1)->where('resolution', 5)->orderBy('updated_at', 'DESC')->take(8)->get();

        // Lấy thông tin phim dựa trên slug
        $movie = Movie::with('episodes')->where('slug', $slug)->where('status', 1)->first();
        $related = Movie::where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->inRandomOrder()->get();

        // Lấy tập phim dựa trên episode
        $episode_movie = Episode::where('movie_id', $movie->id)->where('episode', $episode)->first();

        return view('pages.watch', compact('categories', 'genres', 'countries', 'moviehot_sidebar', 'movie_trailer', 'movie', 'episode_movie', 'episode', 'related'));
    }

    public function episode(){
        $categories = Category::orderBy('position', 'ASC')->where('status', 1)->get();
        $genres = Genre::all();
        $countries = Country::all();

        return view('pages.episode', compact('categories', 'genres', 'countries'));
    }
}
