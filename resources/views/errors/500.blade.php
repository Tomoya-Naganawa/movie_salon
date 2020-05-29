@extends('layouts.parent')

@section('main')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <i class="fas fa-exclamation-circle fa-3x">500</i>
                <p><strong>Internal Server Error</strong></p>
                <p class="mt-3">サーバーで問題が発生しているためページを表示できません。</p>
                <a href="{{ route('top') }}" class="btn">ホームへ戻る</a>
            </div>
        </div>
    </div>
  </div>
@endsection