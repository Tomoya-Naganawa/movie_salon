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

}
