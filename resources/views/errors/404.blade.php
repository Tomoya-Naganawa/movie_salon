@extends('layouts.parent')

@section('main')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <i class="fas fa-exclamation-circle fa-3x">404</i>
                <p><strong>Not Found</strong></p>
                <p class="mt-3">お探しのページは見つかりませんでした。</p>
                <a href="{{ route('top') }}" class="btn">ホームへ戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection