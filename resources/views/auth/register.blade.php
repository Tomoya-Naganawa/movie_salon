@extends('layouts.child')

@section('content')
<div class="col-md-12 d-flex justify-content-center">
    <div class="col-md-10">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h4 class="border-bottom">新規アカウント作成</h4>
            <div class="form-group row">
                <div class="col-md-8 p-3">
                    <h6>ユーザ名</h6>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-8 p-3">
                    <h6>メールアドレス</h6>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 p-3">
                    <h6>パスワード</h6>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 p-3">
                    <h6>パスワード（確認）</h6>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="d-flex justify-content-end border-top pt-3">
                <button type="submit" class="btn btn-primary">作成</button>
            </div>
        </form>
    </div>
</div>

@endsection
