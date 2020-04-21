@extends('layouts.show')

@section('movie')
<div class="container"> 
    <div class="row mx-0 px-0 py-4">
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
                <div class="d-flex align-items-end mt-2 mb-4">                           
                    @if(isset($movie->rating_avg))
                        @php
                        $stars = $movie->rating_avg;
                        for($i = 1; $i <= $stars; $i++){ 
                            echo '<i class="fas fa-star fa-2x" style="color:#ffcc00;"></i>' ; 
                            } 
                        @endphp
                        <h5 class="mb-0 ml-3">{{ $movie->rating_avg }}<small class="text-white-50"> ユーザーレビュー({{ count($movie->reviews) }})</small></h5>
                    @else
                        <h6 class="mb-0 ml-3">まだレビューはありません</h6>
                    @endif             
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
                            <p class="mb-0">{{ $actor->name }}</p>
                        </div>
                    </div>
                </div>    
            @endforeach
            </div>
        </div>
        <div class="col-md-12 d-flex justfy-content-end text-light">
            <a class="btn btn-primary" href="{{ url('/reviews/'.$movie->id.'/create') }}">コメントする（仮）</a>
        </div>   
    </div>
</div>
@stop
@section('review')
<div class="container">
    <div class="row justify-content-center py-4">
        <div class="col-md-11">
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
                    <div class="col-md-12 d-flex justify-content-end">
                        <form method="POST" action="{{ url('/reviews/'.$review->id) }}">
                            @csrf
                            @method('DELETE')

                            <a href="{{ url('/reviews/'.$review->id.'/edit') }}" class="btn btn-sm text-primary p-0"><i class="fas fa-edit"></i> 編集</a>
                            <button type="button" class="btn btn-sm btn-link text-danger p-0 ml-2" data-toggle="modal" data-target="#reviewDelModal"><i class="fas fa-trash-alt"></i> 削除</button>
                            <div class="modal fade" id="reviewDelModal" tabindex="-1" role="dialog" aria-labelledby="reviewDelModalLabel" aria-hidden="true">
                            @component('components.del_modal')
                                このレビューを削除しますか
                            @endcomponent
                            </div>     
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>    
@endsection
