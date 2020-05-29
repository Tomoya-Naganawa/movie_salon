@extends('layouts.parent')

@section('main')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <i class="fas fa-exclamation-circle fa-3x">403</i>
                <p><strong>Forbidden</strong></p>
                <p class="mt-3">アクセスしようとしたページは表示できませんでした。</p>
                <a href="{{ route('top') }}" class="btn">ホームへ戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection