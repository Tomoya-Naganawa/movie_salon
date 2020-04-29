<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Movie;
use App\Models\Favorite;

class TopController extends Controller
{
    public function index(Request $request, Movie $movie, Review $review, Favorite $favorite)
    {
        $movies = $movie->getAllMovie();

        $favorite_count = $favorite->setCountSubQuery();

        $query = Review::query()
                      ->leftjoinSub($favorite_count, 'favorite_count', function ($join) {
                          $join->on('reviews.id', '=', 'favorite_count.review_id');
                      });

    if ($request->has('sort_order')) {
        if ($request->sort_order == 'asc') {
            $reviews = $query->orderBy('created_at', 'asc')->paginate(10);
            $sort = "";
        } elseif ($request->sort_order == 'desc') {
            $reviews = $query->orderBy('created_at', 'desc')->paginate(10);
            $sort = "";
        } elseif ($request->sort_order == 'favorite_count') {
            $reviews = $query->orderBy('favorite_count', 'desc')->paginate(10);
            $sort = "";
        }
    }else {
        $reviews = $query->orderBy('created_at', 'desc')->paginate(10);
        $sort = "最新のレビュー";
    }    

        return view('top', [
            'reviews' => $reviews,
            'movies' => $movies,
            'sort' => $sort
            ]);
    }
}