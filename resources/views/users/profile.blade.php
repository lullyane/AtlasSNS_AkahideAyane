@extends('layouts.login')

@section('content')
<form action="" >
  <div class="edit_profile">
  <div class="user_icon">
    <img src="images/icon1.png">
  </div>
  <div class="profile_item">
    <div class="row">
    <p class="item">ユーザー名</p>
    <p class="form"><input type="text"></p>
    </div>
    <div class="row">
    <p class="item">メールアドレス</p>
    <p><input type="text"></p>
    </div>
    <div class="row">
    <p class="item">パスワード</p>
    <p><input type="text"></p>
    </div>
    <div class="row">
    <p class="item">パスワード確認</p>
    <p><input type="text"></p>
    </div>
    <div class="row">
    <p class="item">自己紹介</p>
    <p><input type="text"></p>
    </div>
    <div class="row">
    <p class="item">アイコン画像</p>
    <p><input type="text"></p>
    </div>
    </div>
  </div>
</form>
@endsection
