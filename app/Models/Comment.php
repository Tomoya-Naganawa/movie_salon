<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function storeComment(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->review_id = $data['review_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }

    public function destroyComment(Int $comment_id)
    {
        return $this->where('id', $comment_id)->delete();
    }
}
