@extends('layouts.child')

@section('content')

@if($category == 'person')
<div class="col-md-12 justify-content-center">
    <h5 class="border-bottom mb-4">人物"<strong>{{ $query }}</strong>"の検索結果</h5>
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
                        <a href="{{ url('/search/'.$known_for['id']) }}" class="text-dark mr-3">{{ $known_for['title'] }}</a>
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
    <h5 class="border-bottom mb-4">タイトル"<strong>{{ $query }}</strong>"の検索結果</h5>
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

@if(empty($search_array['results']))
<div class="col-md-12 justify-content-center">
    "{{ $query }}"に一致する情報は見つかりませんでした。<br><br>
    検索のヒント<br>
    ・日本語で検索する場合「・」が必要な場合があります。例（×「ハリーポッター」〇「ハリー・ポッター」、×「ジムキャリー」〇「ジム・キャリー」）<br>
    ・日本語で見つからない場合、英語で検索してみましょう。<br>
    ・部分一致検索も可能です。
</div>
@endif
@include('components.tmdb_paging')
    
@endsection
