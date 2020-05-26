<?php
namespace app\Libraries;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TmdbService{

    private $api_key = "7a093c40ba32d5a12b8109f2984241d3";
    private $method = "GET";

    public function getSearchArray($request)
    {
        $category = $request['category'];
        $query = $request['query'];

        if(isset($request['page'])){
            $page = $request['page'];
        }else{
            $page = 1;
        }

        $url = "https://api.themoviedb.org/3/search/" .$category. "?api_key=" .$this->api_key. "&language=ja-JA&query=" .$query. "&page=" .$page. "&include_adult=false";

        $client = new Client();
        $response = $client->request($this->method, $url);
        $search_array = $response->getBody();
        $search_array = json_decode($search_array, true);

        return $search_array;
    }

    public function getMovieArray($tmdb_movie_id)
    {
        $movie_url = "https://api.themoviedb.org/3/movie/" .$tmdb_movie_id. "?api_key=" .$this->api_key. "&language=ja-JA";

        $client = new Client();
        $response = $client->request($this->method, $movie_url);
        $movie_array = $response->getBody();
        $movie_array = json_decode($movie_array, true);

        return $movie_array;
    }
    
    public function getCreditArray($tmdb_movie_id)
    {
        $credits_url = "https://api.themoviedb.org/3/movie/" .$tmdb_movie_id. "/credits?api_key=" .$this->api_key;

        $client = new Client();
        $response = $client->request($this->method, $credits_url);
        $credits_array = $response->getBody();
        $credits_array = json_decode($credits_array, true);

        return $credits_array;
    }
}