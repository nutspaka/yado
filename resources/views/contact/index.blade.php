@extends('layouts.app')
 
@section('content')
<div class="card-header">{{ __('お問い合わせ') }}</div>
<form method="POST" action="{{ route('contact.confirm') }}">
    @csrf
    <input
        placeholder="メールアドレス"
        name="email"
        value="{{ old('email') }}"
        type="email" required>
    @if ($errors->has('email'))
        <p class="error-message alert">{{ $errors->first('email') }}</p>
    @endif
    <br>
    <input
        placeholder="タイトル"
        name="title"
        value="{{ old('title') }}"
        type="text" required>
    @if ($errors->has('title'))
        <p class="error-message alert">{{ $errors->first('title') }}</p>
    @endif
    <br>
    <textarea placeholder="お問い合わせ内容" name="body" required>{{ old('body') }}</textarea>
    @if ($errors->has('body'))
        <p class="error-message alert">{{ $errors->first('body') }}</p>
    @endif
<br>
<br>
    <div>
      <button type="submit" class="btn btn-primary">
        入力内容確認
      </button>
    </div>
</form>
@endsection