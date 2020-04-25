@extends('layouts.child_show')

@section('movie-content')
<div class="col-md-11 py-4 d-flex justify-content-center text-light">
    <div class="col-md-3 d-flex align-items-center pl-0">
        <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$movie->poster_path}}" height="360" width="240">  
    </div>
    <div class="col-md-9 d-flex align-items-center">
        <div>
            <div class="d-flex mb-4">
                <h1 class="font-weight-bold">{{ $movie->title }}</h1>       
                <h4 class="align-self-end ml-1">({{ $movie->release_date }})</h4>
            </div>
            <div class="d-flex">
                <h6 class="text-white-50">ジャンル：</h6>
                @php
                $glue = '';
                foreach($movie->genres as $genre)
                {
                    echo $glue.'<h6>'.config('genre')[$genre->genre_id].'</h6>';
                    $glue = ',　';
                }
                @endphp
            </div>
            <div class="d-flex">
                <h6 class="text-white-50">上映時間：</h6>
                <h6>{{ $movie->runtime }}分</h6>
            </div>
            <div class="d-flex align-items-end mt-2 mb-4">                           
                @if(isset($movie->rating_avg))
                    @php
                    $stars = $movie->rating_avg;
                    for($i = 1; $i <= $stars; $i++){ 
                        echo '<i class="fas fa-star fa-2x" style="color:#ffcc00;"></i>' ; 
                        } 
                    @endphp
                    <h5 class="mb-0 ml-3">{{ $movie->rating_avg }}<small class="text-white-50">　ユーザーレビュー({{ count($movie->reviews) }})</small></h5>
                @else
                    <h6>まだレビューはありません</h6>
                @endif             
            </div>
            <div class="mt-3">
                <h6 class="text-white-50">あらすじ：</h6>
                <h6 class="text-white-50 text-monospace"><i>{{ $movie->tagline }}</i></h6>
                <h6>{{ $movie->overview }}</h6>
            </div>
        </div>
    </div>
</div>
<div class="col-md-11 px-0 pb-4">
    <h5 class="text-white-50 ml-3">主な出演者</h5>
    <div class="col-md-12 d-flex justfy-content-center">
    @foreach($movie->actors as $actor)
        <div class="card w-25 mx-1" style="background-color:#333333;">
            <div class="card-body p-0 d-flex">
                <img class="rounded-left img-fluid" src="{{'https://image.tmdb.org/t/p/w1280/'.$actor->profile_path }}" height="90" width="60">
                <div class="align-self-center mx-2">
                    <p class="font-weight-bold text-light mb-0">{{ $actor->name }}</p>
                </div>
            </div>
        </div>    
    @endforeach
    </div>
</div>         
@stop
@section('review-content')
<div class="container">
    <div class="row justify-content-center py-4">
        <div class="col-md-11">
            <a class="btn btn-primary mb-4" href="{{ url('/reviews/'.$movie->id.'/create') }}">この映画のレビューを書く</a>
            <h4 class="border-bottom mb-3">ユーザーレビュー({{ count($movie->reviews) }})</h4>
            @foreach($movie->reviews as $review)
            <div class="card mb-2 shadow">
                <div class="card-header bg-white d-flex p-2">
                    <img src="{{ $review->user->profile_image }}" class="rounded-circle" width="30" height="30">
                    <div class="ml-2 d-flex flex-column">
                        <a href="#" class="text-secondary">{{ $review->user->name }}</a>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $review->created_at->format('Y-m-d H:i') }}に投稿</p>
                    </div>
                </div>    
                <div class="card-body bg-white p-2">
                    <div class="d-flex align-items-center mb-2">
                        @php
                        $stars = $review->rating;
                        for($i = 1; $i <= $stars; $i++){ 
                            echo '<i class="fas fa-star fa" style="color:#ffcc00;"></i>' ; 
                            }
                        @endphp
                        <a href="{{ url('/reviews/'.$review->id) }}" class="text-dark"><strong class="ml-2">{{ $review->heading }}</strong></a>
                    </div>
                    <p class="mb-0">{{ str_limit($review->text, 250) }}</p>
                    <div class="col-md-12 d-flex px-1">
                        @if (!in_array(Auth::user()->id, array_column($review->favorites->toArray(), 'user_id'), TRUE))
                            <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                @csrf

                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <button type="submit" class="btn btn-link p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ url('favorites/' .array_column($review->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-link p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                            </form>
                        @endif
                        <p class="mb-0 ml-1 text-secondary">{{ count($review->favorites) }}</p>
                        <a href="{{ url('/reviews/'.$review->id) }}" class="btn text-primary p-0 ml-3"><i class="far fa-comment"></i></a>
                        <p class="mb-0 ml-1 text-secondary">{{ count($review->comments) }}</p>
                        @if ($review->user_id === Auth::user()->id) 
                        <div class="d-flex justify-content-end flex-grow-1">
                            <div class="dropdown d-flex align-items-center">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <form method="POST" action="{{ url('/reviews/'.$review->id) }}" class="d-flex justify-content-center mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ url('/reviews/'.$review->id.'/edit') }}" class="btn btn-sm text-primary p-0 mx-3"><i class="fas fa-edit"></i> 編集</a>
                                        <button type="button" class="btn btn-sm btn-link text-danger p-0 mx-3" data-toggle="modal" data-target="#reviewDelModal"><i class="fas fa-trash-alt"></i> 削除</button>        
                                    </form>
                                </div>
                                <div class="modal fade" id="reviewDelModal" tabindex="-1" role="dialog" aria-labelledby="reviewDelModalLabel" aria-hidden="true">
                                @component('components.del_modal')
                                    このレビューを削除しますか
                                @endcomponent
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>   
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>  
@endsection
