<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\Movie;

class ReviewsController extends Controller
{
    public function show(Review $review)
    {
        $review = $review->getReview($review->id);

        return view('reviews.show', [
            'review' => $review
        ]);
    }

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

        DB::transaction(function() use($user, $data, $review, $movie){
            $review->reviewStore($user->id, $data);
            $movie->ratingAvgUpdate($data['movie_id']);
        });
        
        return redirect( url('/reviews/'.$review->id) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        if (auth()->user()->id == $review->user_id) {
            $review = $review->getEditReview($review->id);
            return view('reviews.edit', [
                'review' => $review
            ]);
        }else{
            abort(403);
        }
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

        if (auth()->user()->id == $review->user_id) {
            DB::transaction(function () use ($data, $review, $movie) {
                $review->updateReview($data);
                $movie->ratingAvgUpdate($review->movie_id);
            });

            return redirect(url('/reviews/'.$review->id));
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review, Movie $movie)
    {
        DB::transaction(function() use($review, $movie){
            $review->destroyReview($review->id);
            $movie->ratingAvgUpdate($review->movie_id);
        });
        
        return redirect( url('/movies/'.$review->movie_id) );
    }
}
