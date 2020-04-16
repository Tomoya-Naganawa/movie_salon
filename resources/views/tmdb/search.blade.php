@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    @if(empty($search_array['results']))
        <div class="col-md-12 justify-content-center">
            "{{ $query }}"の検索結果は見つかりませんでした。
        </div>
    @else
            
    @endif
    @if($category == 'person')
    <div class="col-md-12 justify-content-center">
        <h5 class="border-bottom mb-4">人物"{{ $query }}"の検索結果</h5>
    </div>
        @foreach($search_array['results'] as $result)
            @if(($result['known_for_department'] == 'Acting')||($result['known_for_department'] == 'Directing'))
            <div class="card shadow-sm w-100 m-1">
                <div class="card-body d-flex justify-content-start p-0">
                    @if(isset($result['profile_path']))
                    <img class="rounded-left" src="{{'https://image.tmdb.org/t/p/w1280/'.$result['profile_path']}}" height="129" width="86">
                    @else
                    <p>イメージがありません</p>
                    @endif
                    <div class="p-3">
                        <h5 class="font-weight-bold pb-3">{{ $result['name'] }}<h5>
                        <h6 class="text-muted">出演作品</h6>
                        <div class="d-flex justify-content-start">
                        @foreach($result['known_for'] as $known_for)
                            @if(isset($known_for['title']))
                            <a href="{{ url('/search/'.$known_for['id']) }}" class="text-dark">{{ $known_for['title'] }}　</a>
                            @endif
                        @endforeach
                        </div>   
                    </div>    
                </div>
            </div>
            @endif
        @endforeach
    @elseif($category == 'movie')
    <div class="col-md-12 justify-content-center">
        <h5 class="border-bottom mb-4">タイトル"{{ $query }}"の検索結果</h5>
    </div>
        @foreach($search_array['results'] as $result)
        <div class="card shadow-sm w-100 m-1">
            <div class="card-body d-flex justify-content-start p-0">
                @if(isset($result['poster_path']))
                <img class="rounded-left" src="{{'https://image.tmdb.org/t/p/w1280/'.$result['poster_path']}}" height="180" width="120">
                @else
                <p>イメージがありません</p>
                @endif
                <div class="p-3">
                    <a href="{{ url('/search/'.$result['id']) }}" class="text-dark"><h4 class="font-weight-bold">{{ $result['title'] }}</h4></a>
                    @if(isset($result['release_date']))
                        <h6 class="font-weight-light text-muted">{{ $result['release_date'] }}</h6>
                    @else
                        <h6 class="font-weight-light text-muted">公開日情報はありません</h6>
                    @endif
                    @if(isset($result['overview']))
                        <h6 class="mb-0">{{ str_limit($result['overview'], 250) }}</h6>
                    @else
                        <h6>あらすじはありません</h6>
                    @endif
                </div>
            </div>          
        </div>
        @endforeach
    @endif
    @include('components.tmdb_paging')
    </div>
</div>
@endsection
