<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class TmdbController extends Controller
{

    public function search(Request $request)
    {
        $api_key = "7a093c40ba32d5a12b8109f2984241d3";

        $validator = Validator::make($request->all(),[
            'category' => 'in:"movie","person"',
            'query'     => 'required',
        ]);
        $validator->validate();
        
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

        return view('tmdb.search', [
            'search_array' => $search_array,
            'query' => $query,
            'category' => $category,
            'page' => $page
            ]);
    }
    
    public function show($movie_id)
    {
        $api_key = "7a093c40ba32d5a12b8109f2984241d3";

        $movie_url = "https://api.themoviedb.org/3/movie/" .$movie_id. "?api_key=" .$api_key. "&language=ja-JA";
        $method = "GET";

        $client = new Client();
        $response = $client->request($method, $movie_url);
        $movie_array = $response->getBody();
        $movie_array = json_decode($movie_array, true);

        $credits_url = "https://api.themoviedb.org/3/movie/" .$movie_id. "/credits?api_key=" .$api_key;
        $method = "GET";

        $client = new Client();
        $response = $client->request($method, $credits_url);
        $credits_array = $response->getBody();
        $credits_array = json_decode($credits_array, true);

        return view('tmdb.show', [
            'movie_array' => $movie_array,
            'credits_array' => $credits_array
        ]);
    }
}
