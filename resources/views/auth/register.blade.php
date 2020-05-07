@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div>通知先の新規登録</div>
                    <br>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
{{-- 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="通知先メールアドレス" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <br>
                                    <span class="alert invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="パスワード（8文字以上）" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="パスワード（確認のため再入力）" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        @error('password')
                            <span class="alert invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="policy_explanation">
                            <a class="policyhref" target="_blank" href="{{ route('terms') }}">利用規約</a>と<a class="policyhref" target="_blank" href="{{ route('policy') }}">プライバシーポリシー</a>に同意の上
                        </p>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-envelope"></i>&nbsp;{{ __('登録する(無料)') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    @if (Route::has('login'))
                    <a class="btn-link" href="{{ route('login') }}">
                        <small>{{ __('すでに登録済みの方はこちら >') }}</small>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
