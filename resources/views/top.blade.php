@extends('layouts.parent')

@section('main')
<main style="background: radial-gradient(#777777, #333333);">
    <div class="container px-0">
        <div class="row">   
            <div class="col-md-12 p-0 d-flex align-items-center text-light">
                <div class="py-4">
                    <h1 class="font-weight-bold">welcome!</h1>
                    <h4>This defines a flex container; inline or block depending on the given value. It enables a flex context for all its direct children.</h4>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-11">
                            <form action="{{ url('/search') }}" method="GET" class="mt-3">
                                <div class="form-row justify-content-end">
                                    <div class="flex-grow-1">
                                        <input class="form-control bg-light" type="text" name="query" placeholder="タイトル名・俳優名を入力">
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control bg-light" name="category">
                                            <option value="movie">タイトルで探す</option>
                                            <option value="person">人物名で探す</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>       
                                </div>                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="bg-light">
    <div class="container px-0">
        <div class="row">
            <div class="col-md-12 py-3">
                <h3 class="font-weight-bold">Movie</h3>
                <div class="col-md-12 d-flex p-0">
                @foreach($movies as $movie)
                <div class="col-md-2 px-1">
                    <div class="card-body p-0">
                        <img class="rounded img-fluid" src="{{'https://image.tmdb.org/t/p/w1280/'.$movie->poster_path}}" width="140" height="210">
                        <div class="d-flex py-1 align-items-baseline">
                        @php
                        $stars = $movie->rating_avg;
                        for($i = 1; $i <= $stars; $i++){ 
                        echo '<i class="fas fa-star fa" style="color:#ffcc00;"></i>' ; 
                        }
                        @endphp
                        <p class="mb-0">{{ $movie->rating_avg }}</p>
                        </div>
                        <p class="font-weight-bold mb-0">{{ $movie->title }}</p>
                        <p class="text-secondary mb-0">{{ $movie->release_date }}</p>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <div class="row">
            <div class="col-md-12 py-3">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                    <h3 class="font-weight-bold">Review</h3>
                    @if(isset($sort))
                    <p class="mb-0 ml-3 align-self-center">{{ $sort }}</p>
                    @endif
                    </div>
                    <form method="GET" action="{{ url('top') }}" class="d-flex">
                        <select class="form-control input-group form-control-sm mb-2" name="sort_order" onChange="this.form.submit()">
                            <option selected disabled>並び替え</option>
                            <option value="desc">投稿の新しい順</option>
                            <option value="asc">投稿の古い順</option>           
                            <option value="favorite_count">いいねの多い順</option>    
                        </select>
                    </form>
                </div>
                    @foreach($reviews as $review)
                        <div class="card shadow mb-2">
                            <div class="card-header bg-white d-flex p-2">
                                <img src="{{ $review->user->profile_image }}" class="rounded-circle" width="25" height="25">
                                <div class="ml-2 d-flex flex-column align-items-center">
                                    <a href="#" class="text-secondary">{{ $review->user->name }}</a>
                                </div>
                                <div class="d-flex justify-content-end align-items-center flex-grow-1">
                                    <p class="mb-0 text-secondary">{{ $review->created_at->format('Y-m-d H:i') }}に投稿</p>
                                </div>
                            </div>    
                            <div class="card-body bg-white p-2">
                                <div class="d-flex align-items-center p-0">
                                    <img class="rounded" src="{{'https://image.tmdb.org/t/p/w1280/'.$review->movie->poster_path}}" height="75" width="50">
                                    <div>
                                        <a href="{{ url('movies/'. $review->movie->id) }}" class="text-secondary mx-3">{{ $review->movie->title.'('.$review->movie->release_date.')' }}</a>
                                        <div class="align-items-center mx-3 my-2">
                                            @php
                                            $stars = $review->rating;
                                            for($i = 1; $i <= $stars; $i++){ 
                                                echo '<i class="fas fa-star fa" style="color:#ffcc00;"></i>' ; 
                                                }
                                            @endphp
                                            <a href="{{ url('/reviews/'.$review->id) }}" class="text-dark ml-2"><strong>{{ $review->heading }}</strong></a>
                                            <p class="mb-0">{{ str_limit($review->text, 140) }}</p>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col-md-12 d-flex p-0">
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
                                </div>   
                            </div>
                        </div>
                    @endforeach
                <div class="my-4 d-flex justify-content-center">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection