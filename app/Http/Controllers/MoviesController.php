<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Actor;
use App\Libraries\Tmdb;

class MoviesController extends Controller
{
    public function store(Request $request, Movie $movie, Genre $genre, Actor $actor, $tmdb_movie_id)
    {
        $movie_array = Tmdb::getMovieArray($tmdb_movie_id);
        $credits_array = Tmdb::getCreditArray($tmdb_movie_id);

        $movie->storeMovie($movie_array);

        foreach($movie_array['genres'] as $movie_genre){
            $movie->genres()->create([
            'movie_id' => $movie->id,
            'genre_id' => $movie_genre['id']
            ]);
        }

        $actors = [];
        for($i = 0; $i <= 3; $i++){
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

    public function show(Movie $movie)
    {
        $ranking = new RankingModule;
        $ranking->increment_view_ranking($movie->id);
        
        $movie->getMovie($movie->id);

        return view('movies.show', [
            'movie' => $movie
        ]);
    }
}
