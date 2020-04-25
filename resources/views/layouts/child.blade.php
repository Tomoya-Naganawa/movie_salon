@extends('layouts.parent')

@section('main')
<main class="py-4">
    <div class="container px-0">
        <div class="row">    
            @yield('content')
        </div>
    </div>
</main>
@endsection