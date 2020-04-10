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
                <div class="col-md-5">
                    <h4 class="display-4">Theater salon</h4>
                    <p class="mb-0">Theater salonは映画好きためのSNS。<br>あなたが見た映画のコミュニティをつくって、レビューをしてもらおう。</p>
                </div>
            </div>
            <div class="col-md-12 d-flex align-self-center justify-content-center">
                <div class="col-md-5">
                    <a href="{{ route('login') }}" type="submit" class="btn btn-block btn-light align-self-end">ログイン</a>
                    <a href="{{ route('register') }}" type="submit" class="btn btn-block btn-light align-self-end">アカウントを作成</a>
                    <a href="login/facebook" type="submit" class="btn btn-block btn-primary align-self-end text-white"><i class="fab fa-facebook"></i> facebookでログイン</a>
                    <a href="login/google" type="submit" class="btn btn-block btn-danger align-self-end"><i class="fab fa-google"></i> Googleでログイン</a>
                </div>                     
            </div>
        </div>       
        </div>       
    </div>
</body>
</html>