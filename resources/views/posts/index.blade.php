@extends('layouts.login')

@section('content')
<form action="場所" method="post" onsubmit="return check()" id="content">
    <div class="form">
      <img class="form_icon" src="images/icon1.png">
      <textarea name="form" id="form" placeholder="投稿内容を入力してください"></textarea>
      <div ><img class="post" src="images/post.png"></div>
    </div>
</form>

@endsection
