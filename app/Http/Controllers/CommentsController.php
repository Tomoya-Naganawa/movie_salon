<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comment)
    {
        $user = auth()->user();

        $data = $request->all();
        $validator = Validator::make($data, [
            'review_id' => ['required', 'integer'],
            'text'     => ['required', 'string', 'max:2500']
        ]);
        $validator->validate();
        $comment->storeComment($user->id, $data);

        return redirect( url('/reviews/'.$data['review_id']) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        if (auth()->user()->id == $review->user_id) {
            $comment->destroyComment($comment->id);

            return back();
        }else{
            abort(403);
        }
    }
}
