@extends('layouts.login')

@section('content')
<div class="edit_profile">
  <div class="user_icon">
    @if(Auth::check())
    <img src="{{ asset('storage/images/' . Auth::user()->images) }}" alt="プロフィール画像">
    @endif
  </div>
  {!! Form::open(['url' => '/profile']) !!}
  <div class="profile_item">
    <div class="row">
                <!-- ↓for属性(省略不可) ↓ラベルに表示される文字 -->
      {{ Form::label('username','ユーザー名',['class' => 'item']) }}
                <!-- ↓name属性(省略不可) ↓初期値 -->
      {{ Form::text('username',old('username'),['class' => 'input']) }}
    </div>
    <div class="row">
      {{ Form::label('mail','メールアドレス',['class' => 'item']) }}
      {{ Form::text('mail',old('mail'),['class' => 'input']) }}
    </div>
    <div class="row">
      {{ Form::label('password','パスワード',['class' => 'item']) }}
      {{ Form::password('password',['class' => 'input']) }}
    </div>
    <div class="row">
      {{ Form::label('password_confirmation','パスワード確認',['class' => 'item']) }}
      {{ Form::password('password_confirmation',['class' => 'input']) }}
    </div>
    <div class="row">
      {{ Form::label('bio','自己紹介',['class' => 'item']) }}
      {{ Form::textarea('bio',old('bio'),['class' => 'input']) }}
    </div>
    <div class="row file">
      {{ Form::label('images','アイコン画像',['class' => 'item']) }}
      {{ Form::file('images',['class' => 'input']) }}
      <span class="file-display">ファイルを選択</span>
    </div>
    {{ Form::submit('新規登録') }}
  </div>
  {!! Form::close() !!}
</div>

@endsection
