@extends('layouts.logout')

@section('content')
<div class="form_wrapper">

<div class="added_Bold">
  <p>{{ session("username") }} さん</p>
  <p>ようこそ！AtlasSNSへ</p>
</div>

<div class="added_text ">
  <p>ユーザー登録が完了いたしました。</p>
  <p>早速ログインをしてみましょう！</p>
</div>

<p><a href="/login" class="added_button">ログイン画面へ</a></p>

</div>

@endsection
