@extends('layouts.logout')

@section('content')
{!! Form::open(['url' => '/register']) !!}

<div class="form_wrapper">

<h2 class="form_font form_register">新規ユーザー登録</h2>

<div class="form_font form_input">
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}
</div>

<div class="form_font">
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
</div>

<div class="form_font">
{{ Form::label('パスワード') }}
{{ Form::password('password', ['class' => 'input']) }}
</div>

<div class="form_font">
{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',['class' => 'input']) }}
</div>

{{ Form::submit('新規登録') }}

<p><a href="/login" class="form_link">ログイン画面へ戻る</a></p>

</div>

{!! Form::close() !!}
</div>

@endsection
