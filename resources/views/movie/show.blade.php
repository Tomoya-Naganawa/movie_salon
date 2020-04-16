@extends('layouts.show')

@section('movie')
<div class="container"> 
    <div class="row mx-0 px-0">
        <div class="col-md-12 mx-0 px-0 d-flex justify-content-center text-white">
            <div class="col-md-4">
                <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$movie->poster_path}}" height="420" width="280">  
            </div>
            <div class="col-md-8 mt-5 mb-2">
                <div class="d-flex mb-4">
                    <h1 class="font-weight-bold">{{ $movie->title }}</h1>       
                    <h4 class="align-self-end ml-1 text-light">({{ $movie->release_date }})</h4>
                </div>
                <div class="d-flex">
                    <h6 class="text-white-50">ジャンル：</h6>
                    @php
                    $glue = '';
                    foreach($movie->genres as $genre)
                    {
                        echo $glue.'<h6 class="text-light">'.config('genre')[$genre->genre_id].'</h6>';
                        $glue = ',　';
                    }
                    @endphp
                </div>
                <div class="d-flex">
                    <h6 class="text-white-50">上映時間：</h6>
                    <h6 class="text-light">{{ $movie->runtime }}分</h6>
                </div>   
                <div class="mt-3">
                    <h6 class="text-white-50">あらすじ：</h6>
                    <h6 class="text-white-50 text-monospace"><i>{{ $movie->tagline }}</i></h6>
                    <h6 class="text-light">{{ $movie->overview }}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-12 px-2 py-4 text-light">
            <h5 class="text-white-50">主な出演者</h5>
            <div class="col-md-12 d-flex justfy-content-center">
            @foreach($movie->actors as $actor)
                <div class="card w-25 mx-1" style="background-color:#333333;">
                    <div class="card-body p-0 d-flex">
                        <img class="rounded-left img-fluid" src="{{'https://image.tmdb.org/t/p/w1280/'.$actor->profile_path }}" height="90" width="60">
                        <div class="align-self-center mx-2">
                            <p>{{ $actor->name }}</p>
                        </div>
                    </div>
                </div>    
            @endforeach
            </div>
        </div>
        <div class="col-md-12 d-flex justfy-content-end text-light">
            <a class="btn btn-primary" href="#">コメントする（仮）</a>
        </div>   
    </div>
</div>
@endsection