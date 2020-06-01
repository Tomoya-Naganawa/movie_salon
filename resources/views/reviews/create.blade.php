@extends('layouts.child_review_create_edit')

@section('content')  
<form method="POST" action="{{ route('reviews.store') }}">
    @csrf

<div class="form-group">
    <h4 class="border-bottom">作品名：{{ $movie_title }}</h4>
    <input type="hidden" name="movie_id" value="{{ $movie_id }}">
</div>
<div class="form-group py-2 border-bottom">
    <h6>総合評価</h6>
    <div class="stars justify-content-end form-control @invalid('rating') bg-light" id="rating" style="border:none;">
        <input id="star1" type="radio" name="rating" value=5><label for="star1"><i class="fas fa-star fa-lg"></i></label>
        <input id="star2" type="radio" name="rating" value=4><label for="star2"><i class="fas fa-star fa-lg"></i></label>
        <input id="star3" type="radio" name="rating" value=3><label for="star3"><i class="fas fa-star fa-lg"></i></label>
        <input id="star4" type="radio" name="rating" value=2><label for="star4"><i class="fas fa-star fa-lg"></i></label>                                  
        <input id="star5" type="radio" name="rating" value=1><label for="star5"><i class="fas fa-star fa-lg"></i></label>
    </div>
    @component('components.invalid_feedback', ['name' => 'rating'])
    @endcomponent
</div>
<div class="form-group pb-2">
    <h6>レビュータイトル</h6>
    <input class="form-control @invalid('heading')" name="heading" autocomplete="heading" placeholder="あなたがこの映画で最も伝えたいポイントは？" required>
    @component('components.invalid_feedback', ['name' => 'heading'])
    @endcomponent       
</div>
<div class="form-group">
    <h6>本文</h6>
    <textarea class="form-control @invalid('text')" name="text" autocomplete="text" rows="23" placeholder="あなたがこの映画を見て感じたことを自由に書きましょう" required></textarea>
    @component('components.invalid_feedback', ['name' => 'text'])
    @endcomponent       
</div>
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">投稿</button>   
</div>
@endsection 