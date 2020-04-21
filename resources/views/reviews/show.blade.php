@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row py-4">
        <div class="col-md-12 d-flex">
            <div class="col-md-3 mb-4">
                <div class="card d-flex w-100">
                    <div class="d-flex">
                        <div class="col-md-4 p-0">
                            <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$review->movie->poster_path}}" height="120" width="80">
                        </div>
                        <div class="col-md-8 p-2">
                            <h6 class="font-weight-bold">{{ $review->movie->title }}</h6>
                            <h6 class="text-dark">({{ $review->movie->release_date }})</h6>
                            <div class="d-flex pt-1">                    
                                @php
                                $stars = $review->movie->rating_avg;
                                for($i = 1; $i <= $stars; $i++){ 
                                    echo '<i class="fas fa-star fa" style="color:#ffcc00;"></i>' ; 
                                    } 
                                @endphp
                                <h6 class="mb-0 ml-2">{{ $review->movie->rating_avg }}<small class="text-dark">({{ count($review->movie->reviews) }})</small></h6>             
                            </div>
                        </div>
                    </div> 
                </div>
            </div>    
            <div class="col-md-9">
                <div class="card w-100">
                    <div class="card-header bg-white d-flex p-2">
                        <img src="{{ $review->user->profile_image }}" class="rounded-circle" width="30" height="30">
                        <div class="ml-2 d-flex flex-column">
                            <a href="#" class="text-secondary">{{ $review->user->name }}</a>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $review->user->created_at->format('Y-m-d H:i') }}に投稿</p>
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
                        <p class="mb-0">{{ $review->text }}</p>
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
                <h4 class="pt-4 border-bottom">コメント</h4>
                <div class="card w-100">
                    <div class="card-header bg-white d-flex p-2">
                        <img src="{{ $review->user->profile_image }}" class="rounded-circle" width="30" height="30">
                        <div class="ml-2 d-flex flex-column">
                            <a href="#" class="text-secondary">{{ $review->user->name }}</a>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $review->user->created_at->format('Y-m-d H:i') }}に投稿</p>
                        </div>
                    </div>
                    <div class="card-body bg-white p-2">
                        <p class="m-0">あああああああああああああああああああああああああああああああああああああああああああああああ</p> 
                    </div>              
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection