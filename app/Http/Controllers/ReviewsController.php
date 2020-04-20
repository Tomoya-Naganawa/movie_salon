<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\Movie;

class ReviewsController extends Controller
{
    public function create($movie_id, Movie $movie)
    {
        $movie_title = $movie->getMovieTitle($movie_id);

        return view('reviews.create', [
            'movie_id' => $movie_id,
            'movie_title' => $movie_title
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie, Review $review)
    {
        $user = auth()->user();

        $data = $request->all();
        $validator = Validator::make($data, [
            'movie_id' => ['required', 'integer'],
            'rating'   => ['required', 'integer', 'in:1,2,3,4,5'],
            'heading'  => ['required', 'string', 'max:100'],
            'text'     => ['required', 'string', 'max:2500']
        ]);
        $validator->validate();
        $review->reviewStore($user->id, $data);
        $movie->ratingAvgUpdate($data['movie_id']);

        return redirect( url('/movies/'.$data['movie_id']) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $user = auth()->user();
        $review = $review->getEditReview($review->id);

        return view('reviews.edit', [
            'review' => $review
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review, Movie $movie)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'rating'   => ['required', 'integer', 'in:1,2,3,4,5'],
            'heading'  => ['required', 'string', 'max:100'],
            'text'     => ['required', 'string', 'max:2500']
        ]);
        $validator->validate();
        $review->updateReview($data);
        $movie->ratingAvgUpdate($review->movie_id);

        return redirect( url('/movies/'.$review->movie_id) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review, Movie $movie)
    {
        $review->destroyReview($review->id);
        $movie->ratingAvgUpdate($review->movie_id);

        return back();
    }
}
