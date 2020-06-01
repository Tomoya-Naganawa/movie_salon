@extends('layouts.parent')

@section('main')
<div class="container px-0">
    <div class="row">
        <div class="col-md-12 py-3">
            <div class="d-flex">
                <h3 class="font-weight-bold">Movie</h3>
                <p class="mb-0 ml-3 align-self-center">デイリーアクセスランキング  <strong>{{ $movie_ranking->firstItem() }}位~{{ $movie_ranking->firstItem() + $movie_ranking->count() - 1}}位</strong></p>
            </div>
            <div class="row d-flex p-0">
            @for($i = 0; $i <= (count($movie_ranking) - 1); $i++)
                <div class="col-md-4 px-1 py-2">
                <div class="card">
                    <div class="card-body p-0 d-flex">
                        <div>
                            <h4 class="m-0 font-weight-bold"><span class="badge badge-pill badge-dark border border-success" style="position:absolute;">{{$movie_ranking->firstItem() + $i}}</span></h4>
                            <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$movie_ranking[$i]->poster_path}}" width="140" height="210">
                        </div>
                        <div class="p-3">
                            <div>
                                <a class="text-dark" href="{{ url('movies/'. $movie_ranking[$i]->id) }}"><h5 class="font-weight-bold mb-0">{{ $movie_ranking[$i]->title }}</h5></a>
                                <p class="text-secondary mb-0">{{ $movie_ranking[$i]->release_date }}</p>
                            </div>
                            <div class="d-flex py-1 align-items-baseline">
                                {{star_rating($movie_ranking[$i]->rating_avg, 'fa')}}
                                <p class="mb-0">{{ $movie_ranking[$i]->rating_avg }}</p>
                            </div>
                            <div>
                                <a class="text-secondary" href="{{url('/movies/' .$movie_ranking[$i]->id. '#user_reviews')}}"><i class="fas fa-newspaper">  ユーザレビュー({{ count($movie_ranking[$i]->reviews) }})</i></a>
                            </div>
                        </div>
                    </div>
                </div>    
                </div>
            @endfor
            </div>
            <div class="my-4 d-flex justify-content-center">
                {{ $movie_ranking->links() }}
            </div>
        </div>
    </div>
</div>
@endsection