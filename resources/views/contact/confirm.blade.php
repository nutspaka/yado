@extends('layouts.app')

@section('content')
<div class="card-header">{{ __('お問い合わせ 入力確認') }}</div>
<form method="POST" action="{{ route('contact.send') }}">
    @csrf
    <br>
    <label>メールアドレス</label>
    <br>
    <p class="black">{{ $inputs['email'] }}</p>
    <input
        class="unset"
        name="email"
        value="{{ $inputs['email'] }}"
        type="hidden">
    <br>
    <label>タイトル</label>
    <br>
    <p class="black">{{ $inputs['title'] }}</p>
    <input
        class="unset"
        name="title"
        value="{{ $inputs['title'] }}"
        type="hidden">
    <br>
    <label>お問い合わせ内容</label>
    <br>
    <br>
    <p class="black">{!! nl2br(e($inputs['body'])) !!}</p>
    <input
        class="unset"
        name="body"
        value="{{ $inputs['body'] }}"
        type="hidden">
    <br>
    <br>
    <div>
    &nbsp;
    <p class="policy_explanation">
      <a class="policyhref" target="_blank" href="{{ route('terms') }}">利用規約</a>と<a class="policyhref" target="_blank" href="{{ route('policy') }}">プライバシーポリシー</a>に同意の上
    </p>
    <button type="submit" class="btn submit">
        送信する
    </button>
    <br>
    <br>
    <small>
    <a href="{{ route('contact.index') }}">< 修正する</a>
    </small>
  </div>
</form>
@endsection