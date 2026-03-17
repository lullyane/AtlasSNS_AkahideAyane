@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/login', 'method' => 'post']) !!}
@csrf

<div class="form_wrapper">
    <div>
        <p class="form_font form_login">AtlasSNSへようこそ</p>
    </div>
    @if ($errors->any())
    <div class="form_font">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>
    @endif
    <div class="form_font">
        {{ Form::label('mail','メールアドレス') }}
        {{ Form::text('mail',null,['class' => 'input']) }}
    </div>
    <div class="form_font">
        {{ Form::label('password','パスワード') }}
        {{ Form::password('password',['class' => 'input']) }}
    </div>
    {{ Form::submit('ログイン') }}
    <p><a href="/register" class="form_link">新規ユーザーの方はこちら</a></p>
</div>
{!! Form::close() !!}

@endsection
