@extends('layouts.parent')

@section('main')
<main style="background: radial-gradient(#777777, #333333);">
    <div class="container px-0">
        <div class="row">
            <div class="col-md-12 p-0 d-flex align-items-center text-light">
                <div class="col-md-12 py-4">
                    <h1 class="font-weight-bold">welcome!</h1>
                    <p>映画に出会える場。映画を探そう。レビューを書こう</p>
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
                <div class="d-flex">
                    <h3 class="font-weight-bold">Movie</h3>
                    <p class="mb-0 ml-3 align-self-center">デイリーアクセスランキング</p>
                </div>
                <div class="col-md-12 d-flex p-0">
                @for($i = 0; $i <= 5; $i++)
                @if(empty($top_six_movies[$i]))
                    @break
                @endif
                <div class="col-md-2 px-1">
                    <div class="card-body p-0">
                        <div class="m-1">
                            <h4 class="m-0 font-weight-bold"><span class="badge badge-pill badge-dark">{{$i + 1}}</span></h4>
                        </div>
                        <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$top_six_movies[$i]->poster_path}}" width="140" height="210">
                        <div class="d-flex py-1 align-items-baseline">
                        {{star_rating($top_six_movies[$i]->rating_avg, 'fa')}}
                        <p class="mb-0">{{ $top_six_movies[$i]->rating_avg}}</p>
                        </div>
                        <a class="text-dark" href="{{ url('movies/'. $top_six_movies[$i]->id) }}"><p class="font-weight-bold mb-0">{{ $top_six_movies[$i]->title }}</p></a>
                        <p class="text-secondary mb-0">{{ $top_six_movies[$i]->release_date }}</p>
                    </div>
                </div>
                @endfor
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
                    <p class="mb-0 ml-3 align-self-center">{{ $str }}</p>
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
                                    <a href="{{ url('users/'. $review->user->id)}}" class="text-secondary">{{ $review->user->name }}</a>
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
                                            {{star_rating($review->rating, 'fa')}}
                                            <a href="{{ url('/reviews/'.$review->id) }}" class="text-dark ml-2"><strong>{{ $review->heading }}</strong></a>
                                            @if(mb_strlen($review->text) >= 135)
                                            <readmore-component text="{{ $review->text }}"></readmore-component>
                                            @else
                                            <p class="mb-0">{{ $review->text }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>    
                                <div class="col-md-12 d-flex p-0">
                                @auth
                                    @if (!in_array(Auth::user()->id, array_column($review->favorites->toArray(), 'user_id'), TRUE))
                                        {!!add_favorite_form($review->id)!!}
                                    @else
                                        {!!delete_favorite_form(url('favorites/' .array_column($review->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]))!!}
                                    @endif
                                @else  
                                    <a href="{{ route('login') }}" class="btn text-primary p-0"><i class="far fa-heart fa-fw"></i></a>
                                @endauth 
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
