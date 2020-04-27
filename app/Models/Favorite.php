<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function isFavorite(Int $user_id, Int $review_id)
    {
        return (boolean) $this->where('user_id', $user_id)->where('review_id', $review_id)->first();
    }

    public function getUserFavorite(Int $user_id)
    {
        return $this->with(['review.user','review.movie'])->where('user_id', $user_id)->get();
    }

    public function setCountSubQuery()
    {
        return $this->selectRaw('review_id, COUNT(id) as favorite_count')->groupBy('review_id');
    }

    public function storeFavorite(Int $user_id, Int $review_id)
    {
        $this->user_id = $user_id;
        $this->review_id = $review_id;
        $this->save();

        return;
    }

    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }
}
