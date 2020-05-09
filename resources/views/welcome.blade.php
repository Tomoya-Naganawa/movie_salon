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
    html{
        height: 100%;
    }

    body{
        background-color:#343a40;
        height: 100%;
    }

    .container{
        height: 100%;
    }

    .row{
        height: 100%;
    }

    h4{
        color:white; 
    }

    p{
        color:white;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
        <div class="col-md-12 align-self-center">   
            <div class="col-md-12 d-flex align-self-center justify-content-center mb-5">
                <div class="col-md-10">
                    <h4 class="display-3 text-center">Movie salon</h4>
                    <p class="mb-0 text-center">Movie salonは映画好きためのSNS。<br>映画を探そう。レビューを自由に書こう。</p>
                </div>
            </div>
            <div class="col-md-12 d-flex align-self-center justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <p class="mb-0 text-dark">メールアドレス</p>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-control-sm" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <p class="mb-0 text-dark">パスワード</p>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form-control-sm" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 d-flex">   
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        </div>
                                        <p class="mb-0 text-dark">パスワードを記憶</p>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('register') }}" type="submit" class="btn btn-block btn-light align-self-end mb-3">アカウントを作成</a>
                    <a href="login/facebook" type="submit" class="btn btn-block btn-primary align-self-end text-white mb-3"><i class="fab fa-facebook"></i> facebookでログイン</a>
                    <a href="login/google" type="submit" class="btn btn-block btn-danger align-self-end mb-3"><i class="fab fa-google"></i> Googleでログイン</a>
                </div>                     
            </div>
        </div>       
        </div>       
    </div>
</body>
</html>