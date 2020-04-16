<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'movie_id', 
        'genre_id'
    ];

    public function storeGenre(Array $genres)
    {
        foreach($genres as $genre){
            $this->movie_id = $movie_array['id'];
            $this->genre_id = $genre;

            $this->save();
        }
        
        return ;
    }
}
