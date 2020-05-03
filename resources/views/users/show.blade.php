@extends('layouts.child')

@section('content')

<div class="col-md-4">
    <div class="card shadow">
        <div class="d-flex">
            <div class="p-2 flex-column justify-content-center">
                <div class="d-flex justify-content-center">
                <img src="{{ $user->profile_image }}" class="rounded-circle" width="85" height="85">
                </div>
                <div class="d-flex justify-content-center">
                    <div class="mt-3 d-flex flex-column align-items-center">
                        <p class="mb-0">{{ $user->name }}</p>
                    </div>
                </div>
            </div>
            <div class="p-2 flex-grow-1 d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-center">
                        <div class="p-2 d-flex flex-column align-items-center">
                            <h5>{{ $review_count }}</h5>
                            <small class="text-secondary">レビュー</small>
                        </div>
                        <div class="p-2 d-flex flex-column align-items-center">
                            <h5>{{ $comment_count }}</h5>
                            <small class="text-secondary">コメント</small>
                        </div>
                    </div>
                    <div class="d-flex">
                        @if ($user->id === Auth::user()->id)
                        <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-sm btn-block btn-primary">編集する</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8">
    <nav>
        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="true">レビュー</a>
            <a class="nav-item nav-link" id="nav-comment-tab" data-toggle="tab" href="#nav-comment" role="tab" aria-controls="nav-comment" aria-selected="false">コメント</a>
            <a class="nav-item nav-link" id="nav-favorite-tab" data-toggle="tab" href="#nav-favorite" role="tab" aria-controls="nav-favorite" aria-selected="false">いいねしたレビュー</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
        @if (isset($reviews))
        @foreach ($reviews as $review)
            <div class="card shadow">
                <div class="card-body bg-white p-2">
                    <div class="d-flex align-items-center py-2">
                        <img class="rounded" src="{{'https://image.tmdb.org/t/p/w1280/'.$review->movie->poster_path}}" height="75" width="50">
                        <a href="{{ url('movies/'. $review->movie->id) }}" class="text-dark"><strong class="ml-4">{{ $review->movie->title.'('.$review->movie->release_date.')' }}</strong></a>
                    </div>
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
                    <div class="col-md-12 d-flex px-1">
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
                            <div class="dropdown d-flex align-items-center">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-fw"></i>
                                </a>
                                <form method="POST" action="{{ url('/reviews/'.$review->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">  
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
                        </div>
                        @endif
                    </div>    
                </div>
            </div>
        @endforeach
        @endif
        <div class="my-4 d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
        </div>
        <div class="tab-pane fade" id="nav-comment" role="tabpanel" aria-labelledby="nav-comment-tab">
        @if (isset($comments))
        @foreach ($comments as $comment)
            <div class="card shadow">
                <div class="card-body bg-white p-2">
                    <div class="d-flex align-items-center py-2">
                        <img class="rounded" src="{{'https://image.tmdb.org/t/p/w1280/'.$comment->review->movie->poster_path}}" height="75" width="50">
                        <a href="{{ url('movies/'. $comment->review->movie->id) }}" class="text-dark"><strong class="ml-4">{{ $comment->review->movie->title.'('.$comment->review->movie->release_date.')' }}</strong></a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        @php
                        $stars = $comment->review->rating;
                        for($i = 1; $i <= $stars; $i++){ 
                            echo '<i class="fas fa-star fa" style="color:#ffcc00;"></i>' ; 
                            }
                        @endphp
                        <p class="m-0"><a href="{{ url('/reviews/'.$comment->review->id) }}" class="text-dark"><strong class="ml-2">{{ $comment->review->heading }}</strong></a>へのコメント</p>
                    </div>
                    <p class="m-0">{{ $comment->text }}</p>
                    @if ($comment->user_id === Auth::user()->id)
                    <div class="col-md-12 d-flex justify-content-end p-0">
                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-fw"></i>
                        </a>
                        <form method="POST" action="{{ url('/comments/'.$comment->id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <button type="button" class="btn btn-sm btn-link text-danger p-0 ml-5" data-toggle="modal" data-target="#commentDelModal"><i class="fas fa-trash-alt"></i> 削除</button>
                            </div>
                            <div class="modal fade" id="commentDelModal" tabindex="-1" role="dialog" aria-labelledby="commentDelModalLabel" aria-hidden="true">
                            @component('components.del_modal')
                                このコメントを削除しますか
                            @endcomponent
                            </div>
                        </form>    
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
        @endif        
        </div>
        <div class="tab-pane fade" id="nav-favorite" role="tabpanel" aria-labelledby="nav-favorite-tab">
        @if (isset($favorites))
        @foreach ($favorites as $favorite)
        <div class="card shadow">
            <div class="card-body bg-white p-2">
                <div class="d-flex align-items-center py-2">
                    <img class="rounded" src="{{'https://image.tmdb.org/t/p/w1280/'.$favorite->review->movie->poster_path}}" height="75" width="50">
                    <strong class="ml-4">{{ $favorite->review->movie->title.'('.$favorite->review->movie->release_date.')' }}</strong>
                </div>
                <div class="d-flex align-items-center mb-2">
                    @php
                    $stars = $favorite->review->rating;
                    for($i = 1; $i <= $stars; $i++){ 
                        echo '<i class="fas fa-star fa" style="color:#ffcc00;"></i>' ; 
                        }
                    @endphp
                    <a href="{{ url('/reviews/'.$favorite->review->id) }}" class="text-dark"><strong class="ml-2">{{ $favorite->review->heading }}</strong></a>
                </div>
                <p class="mb-0">{{ str_limit($favorite->review->text, 250) }}</p>
                @if ($favorite->review->user_id === Auth::user()->id) 
                <div class="col-md-12 d-flex px-1">
                    @if (!in_array(Auth::user()->id, array_column($favorite->review->favorites->toArray(), 'user_id'), TRUE))
                        <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                            @csrf

                            <input type="hidden" name="review_id" value="{{ $favorite->review->id }}">
                            <button type="submit" class="btn btn-link p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                        </form>
                    @else
                        <form method="POST" action="{{ url('favorites/' .array_column($favorite->review->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-link p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                        </form>
                    @endif
                    <p class="mb-0 ml-1 text-secondary">{{ count($favorite->review->favorites) }}</p>
                    <a href="{{ url('/reviews/'.$favorite->review->id) }}" class="btn text-primary p-0 ml-3"><i class="far fa-comment"></i></a>
                    <p class="mb-0 ml-1 text-secondary">{{ count($favorite->review->comments) }}</p>
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @endif
        </div>
    </div>
</div>   
@endsection