@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div id="login_input">
                    <div class="card-header">{{ __('ログイン') }}</div>
                    <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="通知先メールアドレス" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input placeholder="パスワード" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        <small>{{ __('ログイン情報を記憶させる') }}</small>
                                    </label>
                                </div>
                                <br>
                                <button type="submit" class="btn">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @if (Route::has('password.request'))
                <a class="btn-link" href="{{ route('password.request') }}">
                        <small>{{ __('パスワードを忘れた方') }}</small>
                </a>
                |
                @endif
                @if (Route::has('register'))
                <a class="btn-link" href="{{ route('register') }}">
                    <small>{{ __('新規登録') }}</small>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
