<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Favorite;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Review $review, Comment $comment, Favorite $favorite)
    {
        $login_user = auth()->user();
        $reviews = $review->getUserReview($user->id);
        $review_count = $review->getReviewCount($user->id);
        $comments = $comment->getUserComment($user->id);
        $comment_count = $comment->getCommentCount($user->id);
        $favorites = $favorite->getUserFavorite($user->id);

        return view('users.show', [
            'user' => $user,
            'reviews' => $reviews,
            'comments' => $comments,
            'favorites' => $favorites,
            'review_count' => $review_count,
            'comment_count' => $comment_count
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(auth()->user()->id == $user->id){
            return view('users.edit', ['user' => $user]);
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
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'          => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        $validator->validate();

        if(auth()->user()->id == $user->id){
            $user->updateProfile($data);
            return redirect('/top');
        }else{
            abort(403);
        }
    }
}
