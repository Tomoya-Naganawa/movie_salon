<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'release_date', 'runtime', 'poster_path', 'rating_avg', 'tagline', 'overview'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function genres()
    {
        return $this->hasmany(Genre::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function storeMovie(Array $movie_array)
    {
        $this->tmdb_id = $movie_array['id'];
        $this->title = $movie_array['title'];
        $this->release_date = $movie_array['release_date'];
        $this->runtime = $movie_array['runtime'];
        $this->poster_path = $movie_array['poster_path'];
        $this->tagline = $movie_array['tagline'];
        $this->overview = $movie_array['overview'];

        $this->save();

        return;
    }

    public function getMovie(Int $movie_id)
    {
        return $this->with(['reviews.user', 'reviews.favorites', 'actors', 'genres'])->where('id', $movie_id)->first();
    }

    public function getAllMovie()
    {
        return $this->with('reviews')->orderBy('created_at', 'ASC')->paginate(6);
    }

    public function getMovieTitle(Int $movie_id)
    {
        return $this->where('id', $movie_id)->value('title');
    }

    public function getMovieRanking(Array $results)
    {
        $movie_ids = array_keys($results);
        $ids_order = implode(',', $movie_ids);
        $movie_ranking = $this->with('reviews')
                              ->whereIn('id', $movie_ids)
                              ->orderByRaw(DB::raw("FIELD(id, $ids_order)"))
                              ->paginate(12);
        return $movie_ranking;
    }

    //上位6までの映画を取得
    public function getRankInMovie(Array $results)
    {
        $top_six_movies_id = array_slice(array_keys($results), 0, 6);
        $ids_order = implode(',', $top_six_movies_id);
        $top_six_movies = $this->whereIn('id', $top_six_movies_id)
                               ->orderByRaw(DB::raw("FIELD(id, $ids_order)"))
                               ->get();
        return $top_six_movies;
    }

    //レビューのratingからrating_avgを更新
    public function ratingAvgUpdate(Int $movie_id)
    {
        $rating_avg = $this->with('reviews')->where('id', $movie_id)->first()->reviews->avg('rating');

        $this::where('id', $movie_id)
             ->update(['rating_avg' => $rating_avg]);
             return ;
    }
}
