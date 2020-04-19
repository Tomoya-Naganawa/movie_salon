@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">   
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf

            <div class="form-group border-bottom">
                <h4 class="font-weight-bold">作品名：{{ $movie_title }}</h4>
            </div>
            <div class="form-group pb-2 border-bottom">
                <h5 class="font-weight-bold">総合評価</h5>
                <div class="stars justify-content-end form-control @invalid('rating')" id="rating" style="border:none;">
                    <input id="star1" type="radio" name="rating" value=5><label for="star1"><i class="fas fa-star fa-lg"></i></label>
                    <input id="star2" type="radio" name="rating" value=4><label for="star2"><i class="fas fa-star fa-lg"></i></label>
                    <input id="star3" type="radio" name="rating" value=3><label for="star3"><i class="fas fa-star fa-lg"></i></label>
                    <input id="star4" type="radio" name="rating" value=2><label for="star4"><i class="fas fa-star fa-lg"></i></label>                                  
                    <input id="star5" type="radio" name="rating" value=1><label for="star5"><i class="fas fa-star fa-lg"></i></label>
                </div>
                @component('components.invalid_feedback', ['name' => 'rating'])
                @endcomponent
                <style>
                    .stars{
                        display: flex;
                        flex-direction: row-reverse;
                    } 
                    .stars input[type='radio']{
                        display: none;
                    }
                    .stars label:hover,
                    .stars label:hover ~ label,
                    .stars input[type='radio']:checked ~ label{
                        color: #ffcc00;
                    }
                </style>
            </div>
            <div class="form-group">
                <h5 class="font-weight-bold">レビュータイトル</h5>
                <input class="form-control @invalid('headline')" name="headline" autocomplete="headline" placeholder="あなたがこの映画で最も伝えたいポイントは？">
                @component('components.invalid_feedback', ['name' => 'text'])
                @endcomponent       
            </div>
            <div class="form-group">
                <h5 class="font-weight-bold">本文</h5>
                <textarea class="form-control @invalid('text')" name="text" autocomplete="text" rows="20" placeholder="あなたがこの映画を見て感じたことを自由に書きましょう"></textarea>
                @component('components.invalid_feedback', ['name' => 'text'])
                @endcomponent       
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">作成</button>   
            </div>
        </div>
    </div>
</div>    
@endsection 