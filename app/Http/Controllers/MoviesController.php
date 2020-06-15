<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Actor;
use App\Libraries\TmdbService;
use App\Libraries\RankingModule;

class MoviesController extends Controller
{
    public function store(Request $request, Movie $movie, Genre $genre, Actor $actor, $tmdb_movie_id)
    {
        if (Movie::where('tmdb_id', $tmdb_movie_id)->doesntExist()) {
            $movieService = new TmdbService;
            $movie_array = $movieService->getMovieArray($tmdb_movie_id);
            $credits_array = $movieService->getCreditArray($tmdb_movie_id);
            $movie->storeMovie($movie_array);

            //ジャンルの登録
            foreach ($movie_array['genres'] as $movie_genre) {
                $movie->genres()->create([
                'movie_id' => $movie->id,
                'genre_id' => $movie_genre['id']
                ]);
            }

            //出演俳優4人の登録
            $actors = [];
            for ($i = 0; $i <= 3; $i++) {
                if (empty($credits_array['cast'][$i])) {
                    break;
                }

                $record = $actor->firstOrCreate([
                'name' => $credits_array['cast'][$i]['name'],
                'profile_path' => $credits_array['cast'][$i]['profile_path']
            ]);
                array_push($actors, $record);
            }

            $actors_id = [];
            foreach ($actors as $actor) {
                array_push($actors_id, $actor['id']);
            }
            $movie->actors()->attach($actors_id);
        
            return redirect(url('movies/'.$movie->id));
        }else{
            return redirect(route('top'));
        }
    }

    public function show(Movie $movie)
    {
        //閲覧数のインクリメント
        $ranking = new RankingModule;
        $ranking->incrementViewRanking($movie->id);
        
        $movie->getMovie($movie->id);

        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    public function ranking(Movie $movie)
    {
        $ranking = new RankingModule;
        $results = $ranking->getRankingAll();

        $movie_ranking = $movie->getMovieRanking($results);

        return view('movies.ranking', [
            'movie_ranking' => $movie_ranking
        ]);
    }
}
