@extends('layouts.api_movie_show')

@section('movie')
<div class="container"> 
    <div class="row mx-0 px-0">
        <div class="col-md-12 mx-0 px-0 d-flex justify-content-center text-white">
            <div class="col-md-4">
                @if(!empty($movie_array['poster_path']))
                <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$movie_array['poster_path']}}" height="420" width="280">  
                @endif
            </div>
            <div class="col-md-8 mt-5 mb-2">
                <div class="d-flex mb-4">
                    <h1 class="font-weight-bold">{{ $movie_array['title']}}</h1>       
                    <h4 class="align-self-end ml-1 text-light">({{ $movie_array['release_date']}})</h4>
                </div>
                <div class="d-flex">
                @if(!empty($movie_array['genres']))
                    <h6 class="text-white-50">ジャンル：</h6>
                    @php
                    $glue = '';
                    foreach($movie_array['genres'] as $genres)
                    {
                        echo $glue.'<h6 class="text-light">'.$genres['name'].'</h6>';
                        $glue = '、';
                    }
                    @endphp
                @endif    
                </div>
                <div class="d-flex">
                    @if(!empty($movie_array['runtime']))
                    <h6 class="text-white-50">上映時間：</h6>
                    <h6 class="text-light">{{ $movie_array['runtime']}}分</h6>
                    @endif
                </div>   
                <div class="mt-3">
                    @if(!empty($movie_array['tagline']))
                    <h6 class="text-white-50">あらすじ：</h6>
                    <h6 class="text-white-50 text-monospace"><i>{{ $movie_array['tagline']}}</i></h6>
                    @endif
                    @if(!empty($movie_array['overview']))
                    <h6 class="text-light">{{ $movie_array['overview']}}</h6>
                    @endif
                </div>
            </div>
        </div>
        @if(!empty($credits_array['cast']))
        <div class="col-md-12 px-2 py-4 text-light">
            <h5 class="text-white-50">主な出演者</h5>
            <div class="col-md-12 d-flex justfy-content-center">
            @for($i = 0; $i <= 3; $i++)
                @if(empty($credits_array['cast'][$i]))    
                @break
                @endif
                <div class="card w-25 mx-1" style="background-color:#333333;">
                    <div class="card-body p-0 d-flex">
                        @if(!empty($credits_array['cast'][$i]['profile_path']))
                        <img class="rounded-left img-fluid" src="{{'https://image.tmdb.org/t/p/w1280/'.$credits_array['cast'][$i]['profile_path']}}" height="90" width="60">
                        @endif
                        <div class="align-self-center mx-2">
                            <a href="{{ url('search?query='.$credits_array['cast'][$i]['name'].'&category=person') }}" class="text-light font-weight-bold mb-0">{{ $credits_array['cast'][$i]['name'] }}</a>
                            <p>{{ $credits_array['cast'][$i]['character'] }}</p>
                        </div>
                    </div>
                </div>    
            @endfor
            </div>
        </div>
        @endif
        <div class="col-md-12 d-flex justfy-content-end text-light">
            <a class="btn btn-primary" href="{{ url('/movies/'.$movie_array['id'].'/create') }}">コメントする（仮）</a>
        </div>   
    </div>
</div>
@endsection

