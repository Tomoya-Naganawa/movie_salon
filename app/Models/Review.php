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

    public function comments()
    {
        return $this->hasmany(Comment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getAllReview()
    {
        return $this->with(['movie', 'user', 'favorites'])->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function getReview(Int $review_id)
    {
        return $this->with(['movie', 'user', 'comments.user', 'favorites'])->where('id', $review_id)->first();
    }

    public function getUserReview(Int $user_id)
    {
        return $this->with('movie')->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(5);
    }

    public function getReviewCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
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

    public function getEditReview(Int $review_id)
    {
        return $this->with('movie')->where('id', $review_id)->first();
    }
    
    public function updateReview(Array $data)
    {
        $this::where('id', $this->id)
                 ->update([
                     'rating' => $data['rating'],
                     'heading' => $data['heading'],
                     'text' => $data['text'],
                 ]);
        return ;         
    }

    public function destroyReview(Int $review_id)
    {
        return $this->where('id', $review_id)->delete();
    }
}
