@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
                    @if (session('resent'))
                    <br>
                    <h1><i class="fas fa-shipping-fast"></i></h1><br>
                        <div>
                            {{ __('認証メールを送信しました。受信確認をお願いします。') }}
                        </div>
                    @else
                        <p>{{ __('お手数ですが、メールアドレス認証をお願いいたします。') }}
                        <br><small>{{ __('※認証完了後、キャンセル待ち登録や登録リスト確認ができるようになります。') }}</small>
                        </p>
                    <br>
                      <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                          @csrf
                          <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><i class="far fa-envelope"></i> {{ __('認証メール送信') }}</button>
                      </form>
                    <br>                        
                    @endif
    </div>
</div>
@endsection
