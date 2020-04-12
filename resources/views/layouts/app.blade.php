<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <style>
    body {
        background-color: white;
    }
    </style>
</head>

<body>
    <div id="app">
    <nav class="navbar navbar-dark shadow-sm bg-dark">
        <a class="navbar-brand" href="#">Movie salon</a>
        <button class="navbar-toggler border border-0" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-search"></i>
        </button>    
    </nav>
    <nav class="bg-dark">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="col-md-12 p-2">
            <form action="{{ url('/search') }}" method="GET">
                <div class="form-row justify-content-end">
                    <div class="col-8">
                        <input class="form-control" type="text" name="query">
                    </div>
                    <div class="col-2">
                        <select class="form-control" name="category">
                            <option value="movie">タイトルで探す</option>
                            <option value="person">人物名で探す</option>
                        </select>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>                    
            </form>
        </div>
    </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>