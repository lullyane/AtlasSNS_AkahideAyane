@extends('layouts.logout')

@section('content')
{!! Form::open(['url' => '/login']) !!}

<div class="form_wrapper">

<div >
<p class="form_font form_login">AtlasSNSへようこそ</p>
</div>

<div class="form_font form_input">
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
</div>

<div class="form_font form_input">
{{ Form::label('パスワード') }}
{{ Form::password('password',['class' => 'input']) }}
</div>

{{ Form::submit('ログイン') }}

<p><a href="/register" class="form_link">新規ユーザーの方はこちら</a></p>

</div>

{!! Form::close() !!}

@endsection
