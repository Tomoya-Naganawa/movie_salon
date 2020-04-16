<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Actor;

class MoviesController extends Controller
{
    public function create(Request $request, Movie $movie, Genre $genre, Actor $actor, $movie_id)
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

        $movie->storeMovie($movie_array);

        foreach($movie_array['genres'] as $movie_genre){
            $movie->genres()->create([
            'movie_id' => $movie->id,    
            'genre_id' => $movie_genre['id']
            ]);
        }

        $actors = [];
        for($i = 0; $i <= 2; $i++){
            if(empty($credits_array['cast'][$i])){
            break;
            }
            $record = $actor->firstOrCreate([
                'name' => $credits_array['cast'][$i]['name'],
                'profile_path' => $credits_array['cast'][$i]['profile_path']
                ]);
            array_push($actors, $record);
        }

        $actors_id = [];
        foreach($actors as $actor){
            array_push($actors_id, $actor['id']);
        }
        $movie->actors()->attach($actors_id);
        
        return redirect('home');
    }
}
