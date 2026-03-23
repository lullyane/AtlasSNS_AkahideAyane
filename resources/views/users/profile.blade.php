@extends('layouts.login')

@section('content')

<!-- バリデーション エラーメッセージ -->
@if($errors->any())
@foreach($errors->all() as $error)
<p class="profile_error">{{ $error }}</p>
@endforeach
@endif
<!-- edit_wrapperの中央揃え -->
<div class="edit_profile_wrapper">
    <!-- 子要素の横並びと間隔調整 -->
    <div class="edit_profile">
        <div class="user_icon">
            <img
            src="{{ Auth::user()->profile_image_url }}"
            alt="ユーザーアイコン">
        </div>
        {!! Form::open(['url' => '/profile','method' => 'PUT', 'files' => true]) !!}
        @csrf
        <div class="profile_item">
            <div class="row">
                <!-- ↓for属性(省略不可) ↓ラベルに表示される文字 -->
                {{ Form::label('username','ユーザー名',['class' => 'item']) }}
                <!-- ↓name属性(省略不可) ↓初期値 -->
                {{ Form::text('username',old('username',$user->username),['class' => 'input']) }}
            </div>
            <div class="row">
                {{ Form::label('mail','メールアドレス',['class' => 'item']) }}
                {{ Form::text('mail',old('mail',$user->mail),['class' => 'input']) }}
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
                {{ Form::textarea('bio',old('bio',$user->bio),['class' => 'input']) }}
            </div>
            <div class="row file">
                {{ Form::label('images','アイコン画像',['class' => 'item']) }}
                <div class="file_wrapper">
                    <label for="images" class="file_label">ファイルを選択</label>
                    {{ Form::file('images', ['id' => 'images', 'class' => 'file_input']) }}
                </div>
            </div>
            <button type="submit">更新</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
