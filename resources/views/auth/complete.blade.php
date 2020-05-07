@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card-header"><i class="far fa-check-circle"></i></h2>
                <div>{{ __('メールアドレス認証完了') }}</div>
                <br>
                <div class="card-body">
                    お手続ありがとうございました。
                    <br>ホーム画面より、サービスをご利用ください。
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
