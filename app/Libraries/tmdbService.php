<?php
namespace app\Libraries;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TmdbService{

    public function getSearchArray($request)
    {
        $api_key = "7a093c40ba32d5a12b8109f2984241d3";

        $category = $request['category'];
        $query = $request['query'];

        if(isset($request['page'])){
            $page = $request['page'];
        }else{
            $page = 1;
        }

        $url = "https://api.themoviedb.org/3/search/" .$category. "?api_key=" .$api_key. "&language=ja-JA&query=" .$query. "&page=" .$page. "&include_adult=false";
        $method = "GET";

        $client = new Client();
        $response = $client->request($method, $url);
        $search_array = $response->getBody();
        $search_array = json_decode($search_array, true);

        return $search_array;
    }

    public function getMovieArray($tmdb_movie_id)
    {
        $api_key = "7a093c40ba32d5a12b8109f2984241d3";

        $movie_url = "https://api.themoviedb.org/3/movie/" .$tmdb_movie_id. "?api_key=" .$api_key. "&language=ja-JA";
        $method = "GET";

        $client = new Client();
        $response = $client->request($method, $movie_url);
        $movie_array = $response->getBody();
        $movie_array = json_decode($movie_array, true);

        return $movie_array;
    }
    
    public function getCreditArray($tmdb_movie_id)
    {
        $api_key = "7a093c40ba32d5a12b8109f2984241d3";

        $credits_url = "https://api.themoviedb.org/3/movie/" .$tmdb_movie_id. "/credits?api_key=" .$api_key;
        $method = "GET";

        $client = new Client();
        $response = $client->request($method, $credits_url);
        $credits_array = $response->getBody();
        $credits_array = json_decode($credits_array, true);

        return $credits_array;
    }
}