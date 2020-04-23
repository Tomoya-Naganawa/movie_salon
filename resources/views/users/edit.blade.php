@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">
            <form method="POST" action="{{ url('users/' .$user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h4 class="border-bottom">プロフィール編集</h4>                
                <div class="form-group row py-3">
                    <div class="col-md-6 p-3">
                        <h6>ユーザ名</h6>    
                        <input id="name" type="text" class="form-control @invalid('name')" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                        @component('components.invalid_feedback', ['name' => 'name'])
                        @endcomponent
                    </div>
                    <div class="col-md-6 p-3">
                        <h6>メールアドレス</h6>
                        <input id="email" type="text" class="form-control @invalid('email')" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                        @component('components.invalid_feedback', ['name' => 'email'])
                        @endcomponent
                    </div>
                </div>
                <div class="form-group row border-top pt-3">
                    <div class="col-md-12 d-flex align-items-end">
                        <img src="{{ $user->profile_image }}" class="rounded-circle" width="170" height="170" alt="profile_image">
                        <div class="ml-5 p-2">
                            <h6>プロフィールイメージ</h6>
                            <input type="file" name="profile_image" class="form-control-file @invalid('profile_image')" autocomplete="profile_image">
                            @component('components.invalid_feedback', ['name' => 'profile_image'])
                            @endcomponent
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end border-top pt-3">
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection