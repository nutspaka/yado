@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('resent'))
                    <br>
                    <h1><i class="fas fa-shipping-fast"></i></h1><br>
                        <div class="alert alert-success" role="alert">
                            {{ __('認証メールを送信しました。') }}
                            <br>
                            {{ __('受信確認いただき、認証を完了してください。') }}
                        </div>
                    @else
                        <br>{{ __('お手数ですが、メールアドレス認証をお願いいたします。') }}
                        <br><small>{{ __('※認証完了後、監視登録や登録リスト確認ができるようになります。') }}</small>
                        <br>
                    <br>
                      <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                          @csrf
                          <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('認証メール送信') }}</button>
                      </form>
                    <br>                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
