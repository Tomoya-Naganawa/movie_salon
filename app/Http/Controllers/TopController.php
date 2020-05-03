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
        $ranking = new RankingModule;
        $results = $ranking->get_ranking_all();
        $top_six_movies = $movie->getRankInMovie($results);

        $favorite_count = $favorite->setCountSubQuery();

        $query = Review::query()
                      ->leftjoinSub($favorite_count, 'favorite_count', function ($join) {
                          $join->on('reviews.id', '=', 'favorite_count.review_id');
                      });

    if ($request->has('sort_order')) {
        if ($request->sort_order == 'asc') {
            $reviews = $query->orderBy('created_at', 'asc')->paginate(10);
            $sort = "投稿の古い順";
        } elseif ($request->sort_order == 'desc') {
            $reviews = $query->orderBy('created_at', 'desc')->paginate(10);
            $sort = "投稿の新しい順";
        } elseif ($request->sort_order == 'favorite_count') {
            $reviews = $query->orderBy('favorite_count', 'desc')->paginate(10);
            $sort = "評価の高い順";
        }
    }else {
        $reviews = $query->orderBy('created_at', 'desc')->paginate(10);
        $sort = "最新のレビュー";
    }    

    return view('top', [
            'reviews' => $reviews,
            'top_six_movies' => $top_six_movies,
            'sort' => $sort
            ]);
    }
}