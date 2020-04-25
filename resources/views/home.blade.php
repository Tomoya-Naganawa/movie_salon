@extends('layouts.parent')

@section('main')
<main style="background: radial-gradient(#777777, #333333);">
    <div class="container px-0">
        <div class="row">   
            <div class="col-md-12 p-0 d-flex align-items-center text-light">
                <div class="py-5">
                    <h1 class="font-weight-bold">welcome!</h1>
                    <h4>This defines a flex container; inline or block depending on the given value. It enables a flex context for all its direct children.</h4>
                    <form action="{{ url('/search') }}" method="GET" class="mt-4">
                        <div class="form-row justify-content-end">
                            <div class="flex-grow-1">
                                <input class="form-control bg-light" type="text" name="query" placeholder="タイトル名・俳優名を入力">
                            </div>
                            <div class="col-2">
                                <select class="form-control bg-light" name="category">
                                    <option value="movie">タイトルで探す</option>
                                    <option value="person">人物名で探す</option>
                                </select>
                            </div>
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="bg-light">
    <div class="container px-0">
        <div class="row">
            <div class="col-md-12 p-0 d-flex align-items-center">
                <div class="py-2">
                    <h3 class="font-weight-bold">movie</h3>
                    
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
