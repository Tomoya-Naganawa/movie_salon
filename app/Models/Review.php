<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'movie_id', 'rating', 'heading', 'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function reviewStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->movie_id = $data['movie_id'];
        $this->rating = $data['rating'];
        $this->heading = $data['heading'];
        $this->text = $data['text'];
        $this->save();

        return;
    }

    
}
