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
</head>
<body>
    <header>
        <div id="app">
        <nav class="navbar navbar-dark shadow-sm bg-dark">
            <a class="navbar-brand font-weight-bold text-light" href="#">Movie salon</a>
            <ul class="nav justify-content-center">
                @auth
                <li class="nav-item">
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm bg-dark" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ auth()->user()->profile_image }}" class="rounded-circle" width="28" height="28">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a href="{{ url('users/' .auth()->user()->id) }}" class="dropdown-item">{{ auth()->user()->name }}</a>
                            <a href="{{ url('users/' .auth()->user()->id. '/edit') }}" class="dropdown-item">プロフィール編集</a>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>                
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link active text-light">ログイン</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link active text-light">アカウントを作成</a>
                </li>
                @endauth
                <li class="nav-item d-flex align-items-center">
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-search"></i>
                    </button>                
                </li>
            </ul>
        </nav>
        <nav class="bg-dark">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="col-md-12 p-2">
                    <form action="{{ url('/search') }}" method="GET">
                        <div class="form-row justify-content-end">
                            <div class="col-8">
                                <input class="form-control" type="text" name="query" placeholder="タイトル名・俳優名を入力">
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
    </header>
    @yield('main')
</body>
</html>