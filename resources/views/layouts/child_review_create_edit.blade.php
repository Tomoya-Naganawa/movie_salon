@extends('layouts.parent')

@section('main')
<style>
    .stars{
        display: flex;
        flex-direction: row-reverse;
        background: #f8f9fa;
    } 
    .stars input[type='radio']{
        display: none;
    }
    .stars label:hover,
    .stars label:hover ~ label,
    .stars input[type='radio']:checked ~ label{
        color: #ffcc00;
    }
</style>

<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-4">
                @yield('content')
            <div>
        <div>
    <div>
</main>
@endsection