<?php

namespace App\Models;

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

    public function ratingAvgUpdate(Int $movie_id)
    {
        $rating_avg = $this->with('reviews')->where('id', $movie_id)->first()->reviews->avg('rating');

        $this::where('id', $movie_id)
             ->update(['rating_avg' => $rating_avg]);
             return ;
    }
}
