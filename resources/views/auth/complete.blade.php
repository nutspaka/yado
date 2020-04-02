@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card-header">{{ __('メールアドレス認証完了') }}</h2>
                <br>
                <div class="card-body">
                    認証のお手続きをしていただき、誠にありがとうございました。
                    <br>
                    ホーム画面より、サービスをご利用くださいませ。
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
