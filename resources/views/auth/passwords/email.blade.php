@extends('layouts.child')

@section('content')
<div class="col-md-12 d-flex justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <h4 class="border-bottom">パスワードの再設定</h4>
            <p>パスワードを再設定するためのメールを送信します。</p>
            <div class="form-group row">
                <div class="col-md-12">
                <h6>メールアドレス</h6>
                    <input id="email" type="email" class="form-control @invalid('email')" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @component('components.invalid_feedback', ['name' => 'email'])
                    @endcomponent
                </div>
            </div>
            <div class="d-flex justify-content-end border-top pt-3">
                <button type="submit" class="btn btn-primary">送信</button>
            </div>
        </form>
    </div>
</div>
@endsection
