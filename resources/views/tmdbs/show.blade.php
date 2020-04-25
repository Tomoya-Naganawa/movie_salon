@extends('layouts.child_show')

@section('movie-content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-11 py-4 d-flex justify-content-center text-light">
            <div class="col-md-3 d-flex align-items-center pl-0">
                @if(!empty($movie_array['poster_path']))
                <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$movie_array['poster_path']}}" height="420" width="280">  
                @endif
            </div>
            <div class="col-md-9 d-flex align-items-center">
                <div>
                    <div class="d-flex mb-4">
                        <h1 class="font-weight-bold">{{ $movie_array['title']}}</h1>       
                        <h4 class="align-self-end ml-1">({{ $movie_array['release_date']}})</h4>
                    </div>
                    <div class="d-flex">
                    @if(!empty($movie_array['genres']))
                        <h6 class="text-white-50">ジャンル：</h6>
                        @php
                        $glue = '';
                        foreach($movie_array['genres'] as $genres)
                        {
                            echo $glue.'<h6>'.$genres['name'].'</h6>';
                            $glue = '、';
                        }
                        @endphp
                    @endif    
                    </div>
                    <div class="d-flex">
                        @if(!empty($movie_array['runtime']))
                        <h6 class="text-white-50">上映時間：</h6>
                        <h6>{{ $movie_array['runtime']}}分</h6>
                        @endif
                    </div>   
                    <div class="mt-3">
                        @if(!empty($movie_array['tagline']))
                        <h6 class="text-white-50">あらすじ：</h6>
                        <h6 class="text-white-50 text-monospace"><i>{{ $movie_array['tagline']}}</i></h6>
                        @endif
                        @if(!empty($movie_array['overview']))
                        <h6>{{ $movie_array['overview']}}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($credits_array['cast']))
        <div class="col-md-11 px-0 pb-4">
            <h5 class="text-white-50 pl-3">主な出演者</h5>
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
                        <div class="align-self-center mx-1">
                            <a href="{{ url('search?query='.$credits_array['cast'][$i]['name'].'&category=person') }}" class="font-weight-bold text-light mb-0">{{ $credits_array['cast'][$i]['name'] }}</a>
                        </div>
                    </div>
                </div>    
            @endfor
            </div>
            @endif
            <div class="d-flex justify-content-end p-3">
                <a class="btn btn-primary" href="{{ url('/movies/'.$movie_array['id']).'/store' }}">コメントする（仮）</a>
            </div>
        </div>   
    </div>
</div>
@endsection

