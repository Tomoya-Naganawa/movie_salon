@extends('layouts.child_review_create_edit')

@section('content')  
<form method="POST" action="{{ url('/reviews/'.$review->id) }}">
    @csrf
    @method('PUT')

<div class="form-group border-bottom">
    <h4>作品名：{{ $review->movie->title }}</h4>
</div>
<div class="form-group pb-2 border-bottom">
    <h5>総合評価</h5>
    <div class="stars justify-content-end form-control @invalid('rating') bg-light" id="rating" style="border:none;" required>
        <input id="star1" type="radio" name="rating" value=5><label for="star1"><i class="fas fa-star fa-lg"></i></label>
        <input id="star2" type="radio" name="rating" value=4><label for="star2"><i class="fas fa-star fa-lg"></i></label>
        <input id="star3" type="radio" name="rating" value=3><label for="star3"><i class="fas fa-star fa-lg"></i></label>
        <input id="star4" type="radio" name="rating" value=2><label for="star4"><i class="fas fa-star fa-lg"></i></label>                                  
        <input id="star5" type="radio" name="rating" value=1><label for="star5"><i class="fas fa-star fa-lg"></i></label>
    </div>
    @component('components.invalid_feedback', ['name' => 'rating'])
    @endcomponent
</div>
<div class="form-group">
    <h5>レビュータイトル</h5>
    <input class="form-control @invalid('heading')" name="heading" autocomplete="headline" value="{{ old('heading') ? : $review->heading }}" placeholder="あなたがこの映画で最も伝えたいポイントは？" required>
    @component('components.invalid_feedback', ['name' => 'heading'])
    @endcomponent       
</div>
<div class="form-group">
    <h5>本文</h5>
    <textarea class="form-control @invalid('text')" name="text" autocomplete="text" rows="23" placeholder="あなたがこの映画を見て感じたことを自由に書きましょう" required>{{ old('text') ? : $review->text }}</textarea>
    @component('components.invalid_feedback', ['name' => 'text'])
    @endcomponent       
</div>
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">作成</button>   
</div>  
@endsection 