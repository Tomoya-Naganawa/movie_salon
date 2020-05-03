@extends('layouts.child')

@section('content')

<div class="col-md-12 d-flex px-0">
    <div class="col-md-3 px-2">
        <div class="card d-flex w-100">
            <div class="d-flex">
                <div class="col-md-4 p-0">
                    <img class="rounded img-fluid shadow" src="{{'https://image.tmdb.org/t/p/w1280/'.$review->movie->poster_path}}" height="120" width="80">
                </div>
                <div class="col-md-8 p-2">
                    <h6><a href="{{ url('movies/'. $review->movie->id) }}" class="font-weight-bold text-dark">{{ $review->movie->title }}</a></h6>
                    <h6 class="text-dark">({{ $review->movie->release_date }})</h6>
                    <div class="d-flex pt-1">            
                        @php
                        $stars = $review->movie->rating_avg;
                        for($i = 1; $i <= $stars; $i++){ 
                            echo '<i class="fas fa-star fa" style="color:#ffcc00;"></i>' ; 
                            } 
                        @endphp
                        <h6 class="mb-0 ml-2">{{ $review->movie->rating_avg }}</h6>             
                    </div>
                </div>
            </div> 
        </div>
    </div>    
    <div class="col-md-9 px-2">
        <div class="card w-100">
            <div class="card-header bg-white d-flex p-2">
                <img src="{{ $review->user->profile_image }}" class="rounded-circle" width="30" height="30">
                <div class="ml-2 d-flex flex-column">
                    <a href="{{ url('users/'. $review->user->id)}}" class="text-secondary">{{ $review->user->name }}</a>
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
                    @if ($review->user_id === Auth::user()->id)
                    <div class="d-flex justify-content-end flex-grow-1">
                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-fw"></i>
                        </a>
                        <form method="POST" action="{{ url('/reviews/'.$review->id) }}" class="d-flex justify-content-center mb-0">
                            @csrf
                            @method('DELETE')

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" class="d-flex justify-content-center mb-0">
                                <a href="{{ url('/reviews/'.$review->id.'/edit') }}" class="btn btn-sm text-primary p-0 mx-3"><i class="fas fa-edit"></i> 編集</a>
                                <button type="button" class="btn btn-sm btn-link text-danger p-0 mx-3" data-toggle="modal" data-target="#reviewDelModal"><i class="fas fa-trash-alt"></i> 削除</button>
                            </div>
                            <div class="modal fade" id="reviewDelModal" tabindex="-1" role="dialog" aria-labelledby="reviewDelModalLabel" aria-hidden="true">
                            @component('components.del_modal')
                                このレビューを削除しますか
                            @endcomponent
                            </div>
                        </form>
                    </div>
                    @endif    
                </div>
            </div>
        </div>
        <h4 class="border-bottom mt-4">コメント</h4>
        @foreach($review->comments as $comment)
        <div class="card w-100 my-3">
            <div class="card-header bg-white d-flex p-2">
                <img src="{{ $comment->user->profile_image }}" class="rounded-circle" width="30" height="30">
                <div class="ml-2 d-flex flex-column">
                    <a href="#" class="text-secondary">{{ $comment->user->name }}</a>
                </div>
                <div class="d-flex justify-content-end flex-grow-1">
                    <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}に投稿</p>
                </div>
            </div>
            <div class="card-body bg-white p-2">
                <p class="m-0">{{ $comment->text }}</p>
                @if ($comment->user_id === Auth::user()->id)
                <div class="col-md-12 d-flex justify-content-end p-0">
                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-fw"></i>
                    </a>
                    <form method="POST" action="{{ url('/comments/'.$comment->id) }}" class="d-flex justify-content-center mb-0">
                        @csrf
                        @method('DELETE')
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <button type="button" class="btn btn-sm btn-link text-danger p-0 ml-5" data-toggle="modal" data-target="#commentDelModal"><i class="fas fa-trash-alt"></i> 削除</button>
                        </div>
                        <div class="modal fade" id="commentDelModal" tabindex="-1" role="dialog" aria-labelledby="commentDelModalLabel" aria-hidden="true">
                        @component('components.del_modal')
                            このレビューを削除しますか
                        @endcomponent
                        </div>    
                    </form>  
                </div>
                @endif
            </div>              
        </div>
        @endforeach
        <div class="col-md-12 mt-3 px-0">
            <h4 class="border-bottom mt-2"></h4>
            <div class="form-group m-0">
                <form method="POST" action="{{ url('/comments') }}" class="mt-3">
                    @csrf

                    <textarea class="form-control @invalid('text')" name="text" autocomplete="text" rows="5" placeholder="このレビューにコメントします"></textarea>
                    @component('components.invalid_feedback', ['name' => 'text'])
                    @endcomponent
                    <div class="d-flex justify-content-end mt-1">
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection