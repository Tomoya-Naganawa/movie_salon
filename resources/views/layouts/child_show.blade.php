@extends('layouts.parent')

<style>
    body {
        background: radial-gradient(#777777 , #222222);
    }

    .review-content {
        background: #f8f9fa;
    }
</style>

@section('main')
<main class="movie-content">
    <div class="container"> 
        <div class="row justify-content-center">
            @yield('movie-content')
        </div>
    </div>    
</main>
<main class="review-content">
    @yield('review-content')
</main>
@endsection